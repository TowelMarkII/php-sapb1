# taken from 
# https://lisovskiy.medium.com/how-to-launch-a-php-project-in-vs-code-dev-container-4896fd55663
sudo chmod a+x "$(pwd)/src"
sudo rm -rf /var/www/html
sudo ln -s "$(pwd)/src" /var/www/html
sudo ln -s "$(pwd)/dist" /var/www/dist
sudo a2enmod rewrite
echo 'error_reporting=0' | sudo tee /usr/local/etc/php/conf.d/no-warn.ini
echo 'phar.readonly=0' | sudo tee /usr/local/etc/php/conf.d/no-warn.ini
echo "ServerName localhost" | sudo tee /etc/apache2/conf-available/fqdn.conf 
sudo a2enconf fqdn
sudo -E apache2ctl start