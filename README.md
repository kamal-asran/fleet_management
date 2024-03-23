# Fleet Management System (Bus Booking System)

This project is a Fleet Management System (Bus Booking System) implemented using the Laravel Framework.

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP (>= 8.2)
- Composer
- Docker
- Git

### Installing

1. Clone the repository to your local machine:

git clone https://github.com/kamal-asran/fleet_management.git
cd fleet_management

# Fleet Management System (Bus Booking System)

This project is a Fleet Management System (Bus Booking System) implemented using the Laravel Framework.

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP (>= 7.4)
- Composer
- Docker
- Git

### Installing

1. Clone the repository to your local machine:

git clone https://github.com/kamal-asran/fleet_management.git
cd fleet_management

2. Install project dependencies using Composer:
composer instal

3. Create a copy of the .env.example file and rename it to .env

4. Generate an application key:
php artisan key:generate


### Setting Up Docker Environment

1. Start Docker services:
docker-compose up -d

2. Run the database migrations to create the necessary tables:
docker-compose exec app php artisan migrate

3. Seed the database with sample data:
docker-compose exec app php artisan db:seed

### Usage

Now, you can access the application by navigating to http://127.0.0.1:8000 in your web browser.

### Running Unit Tests
I have included some unit tests to ensure the reliability and functionality of the system. You can run the tests using the following command:

docker-compose exec app php artisan test

### Additional Notes

The docker-compose.yml file is configured to run the Laravel application, MySQL database, and Nginx server.

Ensure that ports 8000 and 3306 are not being used by other services on your machine.

You can modify the .env file to configure database credentials and other settings as needed.


### Authors
Kamal Asran