README
======

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.




Repositório github
==================
Estrutura de diretórios ideal: path-to-localhost/ieb/admin/files-from-git-clone

Link do projeto
https://github.com/rogersdk/ieb/

Comando básico de checkout
git clone https://github.com/rogersdk/ieb.git . (da o checkout da aplicação, no diretório atual)



Setting up .htaccess
====================
RewriteEngine On
RewriteBase /ieb/admin/
RewriteCond %{REQUEST_FILENAME} -s [OR]
RewriteCond %{REQUEST_FILENAME} -l [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^.*$ - [NC,L]
RewriteRule ^.*$ index.php [NC,L]


Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "/var/www/ieb/admin
   ServerName iebzend.local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   <Directory "/var/www/ieb/admin">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>

</VirtualHost>
