CODEIGNITER PERSONAL CHECKLIST:
=================================

-Change base_url() in config appropriately
-create parallel .htaccess files; one in base folder and one in application folder
-base folder .htaccess:

RewriteEngine On
RewriteBase /CodeIgniter-3.1.0/		<---replace with base folder name
RewriteCond %{REQUEST_URI} ^system.*
RewriteRule ^(.*)$ /index.php/$1 [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

-application folder .htaccess:

<IfModule authz_core_module>
    Require all denied
</IfModule>
<IfModule !authz_core_module>
    Deny from all
</IfModule>

RewriteEngine On
RewriteBase /CodeIgniter/
RewriteCond %{REQUEST_URI} ^system.*
RewriteRule ^(.*)$ /index.php/$1 [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]