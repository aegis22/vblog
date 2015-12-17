#!/bin/bash
# Update server
apt-get update
apt-get upgrade -y 
# Install essentials
apt-get -y install build-essential binutils-doc git -y
# Install Apache
apt-get install apache2 -y
#Install PHP
apt-get install php5 libapache2-mod-php5 php5-cli php5-mysql -y
# Install MySQL
echo "mysql-server mysql-server/root_password password 0000" | sudo debconf-set-selections
echo "mysql-server mysql-server/root_password_again password 0000" | sudo debconf-set-selections
apt-get install mysql-client mysql-server -y
# Install PhpMyAdmin
echo 'phpmyadmin phpmyadmin/dbconfig-install boolean true' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/app-password-confirm password 0000' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/admin-pass password 0000' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/app-pass password 0000' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | debconf-set-selections
apt-get install phpmyadmin -y
# Enabling mod-rewrite
a2enmod rewrite
# Allowing Apache override to all
cat > /etc/apache2/sites-enabled/000-default.conf <<EOF
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html
    <Directory /var/www/html>
        AllowOverride All
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF
# Restart Apache service
service apache2 restart
# Creating database settings
echo "CREATE DATABASE db_blog" | mysql -u root -p0000
echo "CREATE TABLE db_blog.blog_admin (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, username VARCHAR(20) UNIQUE, passcode VARCHAR(40), numberposts INT UNSIGNED NOT NULL)" | mysql -u root -p0000
echo "CREATE TABLE db_blog.blog_posts (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, autor VARCHAR(20), texto TEXT(200))" | mysql -u root -p0000
