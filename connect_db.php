<?php
// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erp_latest_new";

// Table names and descriptions
// Here you should provide as much details about your tables. What kind of information does it include? What rows and columns? More description means better accuracy

$tables = [
    'gtg_product_cat' => 'This table stores product category numbers (id), name of the category (title) and extra',
    'gtg_products' => 'This table stores product ids, product category numbers (id), barcode numbers, product names, expiry dates, product codes, code types, product prices, taxrates and quantities',
    // 'gtg_customers' => 'This table stores information about customers, their ids, names, phone numbers, addresses, roc, incharge, city, region, country, email, company, balance',
    // 'gtg_employees' => 'This table stores information about employees, their ids, username, email, nname, address, city, region, country, postbox, phone, salary, passport',
    // 'asset_categories' => 'This table stores asset categories with fields for unique IDs, names, descriptions, creation dates, and last updated timestamps',
    // 'asset_comments' => 'This table stores asset comments with fields for unique IDs, associated asset IDs, comments, comment authors, creation dates, and last updated timestamps.',
    // 'asset_history' => 'This table stores asset history, with fields for unique IDs, associated asset IDs, employee names who were assigned the asset, employee IDs, actions performed, notes about the history, creation dates, and last updated dates.',
    // 'asset_management' => 'This table manages assets and includes fields for unique IDs, asset IDs, barcodes, asset model numbers, names, descriptions, unit prices, asset statuses, dates of purchase, categories, subcategories, suppliers, departments, sub-departments, dates of manufacture, years of valuation, warranty months, depreciation months, locations, image URLs, notes, employee IDs assigned to the asset, creation dates, and last updated timestamps.',
    // 'asset_status' => 'This table stores asset statuses with fields for unique IDs, names, descriptions, and creation dates.',
    
    //'table5' => 'No_information',
    // Add more tables as needed
];

// Create PDO connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to get all table descriptions
function getAllTableDescriptions() {
    global $tables;
    $output = '';
    foreach ($tables as $tableName => $description) {
        $output .= "Table name: '$tableName' Table description: '$description'; ";
    }
    return $output;
}

?>



