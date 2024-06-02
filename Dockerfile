# Use the official PHP image as the base image
FROM php:8.0-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Install MySQLi extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy all files from the current directory to the container
COPY . .

# Expose port 80 for Apache
EXPOSE 80
