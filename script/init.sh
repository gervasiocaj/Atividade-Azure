#!/bin/bash
sudo apt-get update
sudo apt-get install -y wget apache2 libapache2-mod-php5
sudo a2enmod php5
sudo service apache2 restart

cd /var/www
sudo rm index.html
sudo wget https://raw.githubusercontent.com/EnioAbrantes/Atividade-AWS/master/html/index.html
sudo wget https://raw.githubusercontent.com/EnioAbrantes/Atividade-AWS/master/html/style.css
