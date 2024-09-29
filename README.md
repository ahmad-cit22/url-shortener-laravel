# URL Shortener

A simple URL shortener application built with Laravel and Modern JavaScript. It allows users to shorten long URLs and manage them, including viewing details, tracking click counts, editing, and deletion.

---

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

---

## Introduction

The URL Shortener is a web application designed to generate shortened URLs from long URLs. Users can manage their URLs by viewing details, editing, or deleting them. This project uses Laravel for backend functionality and JavaScript for frontend interactions, providing a smooth and efficient user experience.

---

## Features

- **Shorten Long URLs**: Convert long URLs into short, easily shareable links.
- **View URL Details**: View the original URL, shortened URL, and the click count.
- **Edit URLs**: Update the original URL associated with a shortened URL.
- **Delete URLs**: Remove shortened URLs from the system.
- **Click Tracking**: Track the number of clicks for each shortened URL.

---

## Requirements

Ensure your environment meets the following minimum requirements:

- **PHP**: 7.4 or higher
- **Laravel**: 8.x or higher
- **MySQL**: 5.7 or higher
- **Node.js**: 14.x or higher
- **npm**: 6.x or higher

---

## Installation

Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/url-shortener.git

2. Navigate to the project directory:

    ```bash
    cd url-shortener
    
3. Install backend dependencies:

    ```bash
    composer install
    
4. Install frontend dependencies:

    ```bash
    npm install
    
5. Create a MySQL database for the project and update the .env file with your database credentials:

    ```.env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

6. Run database migrations to create the necessary tables:

    ```bash
    php artisan migrate

7. Start the development server:

    ```bash
    php artisan serve

---
    
## Usage

After the installation, follow these steps to use the application:

- Open your browser and navigate to http://localhost:8000.
- Click "Shorten URL" to generate a shortened version of a long URL.
- To store & manage your URLs, you need to register.
- After registration & login, use the "Dashboard" navigation button to view & manage your URLs.
- Click "View" button to view the original URL, shortened URL, and click statistics.
- Click "Edit" button to modify an existing shortened URL.
- Click "Delete" to remove a shortened URL from the system.

---

## Testing

This project includes a suite of automated tests to ensure the application functions correctly. You can run the tests using the following command:

    ```bash
    php artisan test


## Test Cases

The following test cases are included in the project:

1. **Any User Can Shorten URL:** Validates that any user can shorten a valid URL.
2. **Authenticated User Can See Dashboard:** Checks access to the dashboard for authenticated users.
3. **Authenticated User Can Delete URL:** Verifies that users can delete their own URLs.
4. **Unauthorized User Cannot Delete URL:** Ensures users cannot delete URLs that don't belong to them.
5. **Short URL Redirects to Original URL:** Tests that a shortened URL redirects to the original.
6. **Invalid URL Cannot Be Shortened:** Ensures invalid URLs are not accepted.

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository.
2. Create a new feature branch (git checkout -b feature-branch).
3. Commit your changes (git commit -m 'Add a feature').
4. Push the branch (git push origin feature-branch).
5. Open a Pull Request.

Please make sure your code follows the project's coding standards and is thoroughly tested.

---

## License

This project is licensed under the MIT License.
