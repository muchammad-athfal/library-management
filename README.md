# Library Management System API

This is a simple RESTful API built using Laravel for managing a library system. It handles both books and authors, allowing for CRUD operations and association management between books and authors.

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Running the Application](#running-the-application)
-   [Running Tests](#running-tests)
-   [Database Schema](#database-schema)
-   [Design Choices](#design-choices)
-   [Performance Tuning](#performance-tuning)
-   [API Documentation](#api-documentation)

## Requirements

-   PHP 8.3+
-   Composer
-   MySQL or MariaDB
-   Laravel 11.x

## Installation

1. Clone the repository:
   `git clone https://github.com/muchammad-athfal/library-management`  
   `cd library-management`

2. Install the dependencies:
   `composer install`

3. Copy the `.env.example` file to `.env`:
   `cp .env.example .env`

4. Set up your environment variables in the `.env` file, especially the database configuration:

-   `DB_HOST=127.0.0.1`
-   `DB_PORT=3306`
-   `DB_DATABASE=library_management_system`
-   `DB_USERNAME=root`
-   `DB_PASSWORD=`

5. Generate the application key:

`php artisan key:generate`

6. Run database migrations:

`php artisan migrate`

7. To set the API key in the `.env` file, run the following command:

`php artisan generate:api-key`

## Running the Application

1. Start the Laravel development server:

`php artisan serve`

2. Access the API at `http://localhost:8000`.

## Running Tests

The application includes unit tests to verify the main functionalities. To run the tests:

`php artisan test`

Ensure that your environment is properly configured before running the tests.

## Database Schema

The database schema consists of two main tables:

-   **authors**: Stores information about the authors, including their name, bio, and birthdate.
-   **books**: Stores information about the books, including the title, description, publication date, and the author relationship.

Example schema fields:

-   **authors**
-   `id` (UUID)
-   `name` (string)
-   `bio` (text)
-   `birth_date` (date)

-   **books**
-   `id` (UUID)
-   `title` (string)
-   `description` (text)
-   `publish_date` (date)
-   `author_id` (UUID, foreign key)

## Design Choices

-   **Repository Pattern**: This API uses the repository pattern to separate data logic from the controller layer, promoting maintainable and clean code.
-   **Service Layer**: A service layer is used for handling business logic, ensuring that the controllers remain thin.
-   **Pagination**: For list-based requests, pagination has been implemented to enhance performance and handle large datasets efficiently.

## Performance Tuning

To ensure the API is optimized for performance, the following techniques were applied:

-   **Query Optimization**: Eager loading was used to reduce the number of database queries and avoid the N+1 problem when retrieving related data (e.g., authors with their books).

As the library grows to millions of records, further improvements could include:

-   **Indexing**: Adding indexes on frequently queried columns such as `author_id` and `publish_date` to improve query performance.
-   **Database Partitioning**: Partitioning large tables could help in managing performance when querying large datasets.

## API Documentation

For detailed information about the API endpoints, request/response formats, and usage, please refer to the full API documentation:

[View API Documentation](https://documenter.getpostman.com/view/16905857/2sAXxJiaSE)

---

Thank you for using the Library Management System API!
