<?php

require_once 'src/ChatGPT.php';
require_once 'connect_db.php';

header("Cache-Control: no-cache");
if (ob_get_level()) ob_end_clean();

$settings = require(__DIR__ . "/settings.php");
require(__DIR__ . "/database.php");
require(__DIR__ . "/autoload.php");

$db = get_db();
$conversation_class = get_conversation_class($db);

$chat_id = intval($_REQUEST['chat_id']);
$conversation = $conversation_class->find($chat_id, $db);

if (!$conversation) {
    $conversation = new $conversation_class($db);
    $conversation->set_title("Untitled chat");
    $conversation->save();
}

$context = $conversation->get_messages();

$chatgpt = new ChatGPT($settings['api_key'], null, $settings);

if (empty($context) && !empty($settings['system_message'])) {
    $system_message = ["role" => "system", "content" => $settings['system_message']];
    $context[] = $system_message;
    $conversation->add_message($system_message);
}

if (isset($_POST['message'])) {
    $userMessage = $_POST['message'];
    $message = ["role" => "user", "content" => $userMessage];
    $responseString = $chatgpt->db_analysis($userMessage);
    $chatgpt->umessage($userMessage, $responseString);
    $conversation->add_message($message);
    echo $conversation->get_id();
    exit;
}

header("Content-type: text/event-stream");
$error = null;

try {
    foreach ($context as $message) {
        switch ($message['role']) {
            case "user":
                $chatgpt->umessage($message['content']);
                break;
            case "assistant":
                $chatgpt->amessage($message['content']);
                break;
            case "system":
                $chatgpt->smessage($message['content']);
                break;
        }
    }

    $response_text = $chatgpt->stream(StreamType::Event)->content;
} catch (Exception $e) {
    $error = "Sorry, there was an unknown error in the OpenAI request";
}

if ($error !== null) {
    $response_text = $error;
    echo "data: " . json_encode(["content" => $error]) . "\n\n";
    flush();
}

$assistant_message = ["role" => "assistant", "content" => $response_text];
$conversation->add_message($assistant_message);

echo "event: stop\n";
echo "data: stopped\n\n";

