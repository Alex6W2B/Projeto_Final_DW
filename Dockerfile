FROM php:8.2-apache

# Instalar a extensão PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Habilitar módulos adicionais do Apache, se necessário
RUN a2enmod rewrite

# Copiar arquivos do projeto (opcional, se não usar volume)
COPY ./src /var/www/html