# Use uma imagem base do PHP com Apache ou FPM
FROM php:8.0-apache

# Instala as dependências do sistema e a extensão pdo_mysql
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copia seu código para o diretório padrão do Apache
COPY . /var/www/html/

# Define o diretório de trabalho
WORKDIR /var/www/html

# Expondo a porta 80
EXPOSE 40

# Comando padrão
CMD ["apache2-foreground"]
