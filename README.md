# Simple Laravel API with Job Queue, Database, and Event Handling

## Setup Instructions

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Copy `.env.example` to `.env` and configure your database settings.
4. Run `php artisan migrate` to create the necessary database tables.
5. Run `php artisan serve` to start the development server.
5. Run `php artisan queue:work` to start the queue server.

## Testing the API

Use the following cURL command to test the `/submit` endpoint:

```sh
curl -X POST http://127.0.0.1:8000/api/submit ^
    -H "Content-Type: application/json" ^
    -d "{\"name\": \"John Doe\", \"email\": \"john.doe@example.com\", \"message\": \"This is a test message.\"}"



## Feedback from client

#### SubmissionController not meet SOLID principles
#### SubmissionController not using DI
#### Not using DTO for request
#### Not using resource for response
#### Not using service layer
#### Not using repository pattern
#### Project setup not included any static analysis tools and/or make commands
####For requirement "Documentation" project does not have any Postman/Swagger setup
#### For requirement "Unit test" project does not have any unit test cases
#### For requirement "Error Handling" project does not have any custom error handling and render handling
#### Designing and coding standards are not followed
#### Designing endpoint are not meet REST standards
#### Code style on Junior level
#### Job not using DI
#### Migration does not have correct data types and constraints
#### Average code quality is basic Middle- level