# Use the base PHP image (with necessary PHP version)
FROM systemsdk/docker-nginx-php-laravel:latest
# FROM php:8.2

# Ensure package lists are updated and dependencies are installed
RUN apt-get update -y && \
    apt-get install -y --no-install-recommends \
    openssl zip unzip git libonig-dev libgd-dev libcurl4-openssl-dev \
    libxml2-dev libzip-dev default-mysql-client && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip pdo mbstring gd curl xml && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js (make sure to use the version compatible with your setup)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
apt-get install -y nodejs

# Increase Git buffer size and force HTTP/1.1 for GitHub clone
RUN git config --global http.postBuffer 524288000
RUN git config --global http.version HTTP/1.1

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory inside the container
WORKDIR /var/www/

# Copy the application files into the container
COPY . .

# Clear Composer cache and retry on failure
RUN composer install --no-dev --optimize-autoloader && \
    composer clear-cache

    # Install Node.js dependencies
RUN npm install

# Build Vite assets
# RUN npm run build
RUN npm run build

# RUN php artisan migrate --seed

# Expose the port to access the app
EXPOSE 8000

# Run the Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
