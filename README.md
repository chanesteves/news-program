# PHP test

## 1. Installation

- Create an empty database named `phptest`" on your MySQL server.
- Import the dbdump.sql in the `phptest` database.
- Copy `.env.dist` file to `.env` and put your MySQL server credentials in it.
- Install the packages: `composer install`.
- You can run the script in your shell: `composer start` or `php src/index.php`.
- You can run the test in your shell: `composer test` or `vendor/bin/phpunit --testdox`.

## 2. Expectations

This simple application works, but initially built with very old-style monolithic codebase, so did the following improvements:

- Autoloading with `composer.json`:
  - Eliminated the need for manual `require` statements.
  - Automatic loading of classes when they are needed.
- Separation of Concerns: Moved business logic to a controller class `NewsController` and kept `index.php` as a thin controller.
- Abstraction of Data Access Layer: Created `CommentRepository` and `NewsRepository`.
- Object Creation: Used factory pattern for creating `Comment` and `News` objects to encapsulate the instantiation logic.
- Dependency Injection: Decoupled classes from the database layer for easier dependency management and testing.
- Exception Handling
  - Handled exceptions and error gracefully
  - Added error logging
- Documentation and Type Hinting: Added PHPDoc comments and type hinting for better readability and IDE support.
- Secured Configurations/Credentials: Moved database credentials to `.env` file.
- Tests: Added unit tests (deferred integration tests as it will probably need setting up and tearing down of test data).
- Custom Commands: Created custom commands for running and testing of the script.
