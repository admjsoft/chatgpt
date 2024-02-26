# Ainet bot made by Aidar Kadyr

This is a ChatGPT-like advanced chatbot that uses the ChatGPT API and uses information from database to infer knowledge. 

## Quick Start

1. Add your OpenAI API key to `settings.php` (see `settings.sample.php`)
2. Update 'connect_db.php' to include information about the database and tables
3. Start a server

```console
$ php -S localhost:8080
```

4. Go to http://localhost:8080

## Database

The chatbot uses PHP sessions to store the conversations by default. You can also use an SQL database. There is a SQLite dump and a MySQL dump in the `db` folder. You can install the SQLite version by running the `install_sqlite.php` script.

Database config has to be put into `settings.php` (see `settings.sample.php`). You need to also change `storage_type` to `sql` in the settings in order to use a database.

## API key

You will need an API key from OpenAI to use the code. The API key must be added to the `settings.sample.php` file, which you will need to rename to `settings.php`.

## Modify to your liking

You can change the system message in the settings to make the chatbot do what you want.

## Support

If you like this code or use it in some useful way, consider buying me a coffee: https://www.buymeacoffee.com/unconv
