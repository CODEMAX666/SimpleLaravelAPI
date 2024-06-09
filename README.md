# Simple Laravel API with Job Queue, Database, and Event Handling

## Setup Instructions

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Copy `.env.example` to `.env` and configure your database settings.
4. Run `php artisan migrate` to create the necessary database tables.
5. Run `php artisan serve` to start the development server.
5. Run `php artisan quework` to start the queue server.

## Testing the API

Use the following cURL command to test the `/submit` endpoint:

```sh
curl -X POST http://127.0.0.1:8000/api/submit ^
    -H "Content-Type: application/json" ^
    -d "{\"name\": \"John Doe\", \"email\": \"john.doe@example.com\", \"message\": \"This is a test message.\"}"

