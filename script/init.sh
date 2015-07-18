#!/bin/bash
sudo apt-get update
sudo apt-get install -y git wget apache2 libapache2-mod-php5
sudo a2enmod php5
sudo service apache2 restart

cd /var/www/html
sudo rm *

sudo git clone https://github.com/EnioAbrantes/Atividade-AWS.git 
sudo mv ./Atividade-AWS/* ./
