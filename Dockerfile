FROM php:8.2-apache

# Salin semua file dari repositori ke web root Apache
COPY . /var/www/html/

# Pastikan permission file sesuai
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
