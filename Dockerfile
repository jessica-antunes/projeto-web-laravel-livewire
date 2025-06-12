# Imagem base com PHP 8.1 e Apache
FROM php:8.1-apache

# Instalar extensões necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql zip

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar todos os arquivos do projeto para o container
COPY . .

# Instalar dependências do Laravel via Composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Ajustar permissões para storage e bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expor a porta 80
EXPOSE 80

# Comando para rodar o Apache em foreground
CMD ["apache2-foreground"]
