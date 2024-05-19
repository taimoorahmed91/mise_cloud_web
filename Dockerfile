FROM php:7.4-apache

# Enable SSL and required Apache modules, and install Docker CLI
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    docker.io && \
    docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli && \
    a2enmod ssl rewrite && \
    a2ensite default-ssl && \
    a2ensite 000-default


# Ensure docker is in the PATH
ENV PATH="/usr/bin:${PATH}"

# Create docker group with GID 988 and add www-data to it
RUN groupadd -g 988 docker || true && \
    usermod -aG docker www-data

# Copy the self-signed certificate and Apache configuration
COPY ./certs/selfsigned.crt /etc/ssl/certs/selfsigned.crt
COPY ./certs/selfsigned.key /etc/ssl/private/selfsigned.key
COPY ./default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy the application files
COPY mise /var/www/html/mise

# Change the ownership of the copied files to www-data
RUN chown -R www-data:www-data /var/www/html

# Copy the startup script
COPY startup.sh /usr/local/bin/startup.sh
RUN chmod +x /usr/local/bin/startup.sh

# Use the startup script as the container entrypoint
ENTRYPOINT ["/usr/local/bin/startup.sh"]

