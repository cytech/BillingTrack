Requirements
---

---

BillingTrack is web-based software, so to install and use it, you must
have a server environment of some sort. Please review the minimum
requirements below to determine whether or not you will be able to
install and use the software. .

-   A web server of some sort - Apache, nginx, etc.
-   PHP &gt;= 7.3 or &gt;= 8.0
-   MySQL or MariaDB
-   A modern and updated web browser
-   BCMath PHP Extension
-   Ctype PHP Extension
-   Fileinfo PHP extension
-   JSON PHP Extension
-   Mbstring PHP Extension
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
------------
PHP Extension list from "composer check-platform-reqs"
 
-   ext-ctype       
-   ext-curl        
-   ext-dom         
-   ext-fileinfo    
-   ext-filter      
-   ext-gd          
-   ext-iconv       
-   ext-json        
-   ext-libxml      
-   ext-mbstring    
-   ext-openssl     
-   ext-pcre        
-   ext-PDO         
-   ext-Phar        
-   ext-SimpleXML   
-   ext-tokenizer   
-   ext-xml         
-   ext-xmlreader   
-   ext-xmlwriter   
-   ext-zip         
-   ext-zlib        
-   lib-pcre        


**Composer installed**

Here is a good link with composer installation instructions for Ubuntu 18.04:
[Composer Install instructions](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-18-04)

**Sample Apache2 virtual host conf:**

BillingTrack.conf

	<VirtualHost *:80>
		ServerAdmin webmaster@localhost

		DocumentRoot /var/www/BillingTrack/public
		ServerName BillingTrack
		ServerAlias BillingTrack
		<Directory />
			Options FollowSymLinks
			AllowOverride All
		</Directory>
		<Directory /var/www/BillingTrack/public/>
			Options Indexes FollowSymLinks MultiViews
			AllowOverride All
			Order allow,deny
			allow from all
		</Directory>

		ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
		<Directory "/usr/lib/cgi-bin">
			AllowOverride None
			Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
			Order allow,deny
			Allow from all
		</Directory>

		ErrorLog ${APACHE_LOG_DIR}/error.log

		# Possible values include: debug, info, notice, warn, error, crit,
		# alert, emerg.
		LogLevel warn

		CustomLog ${APACHE_LOG_DIR}/access.log combined

	    Alias /doc/ "/usr/share/doc/"
	    <Directory "/usr/share/doc/">
		Options Indexes MultiViews FollowSymLinks
		AllowOverride None
		Order deny,allow
		Deny from all
		Allow from 127.0.0.0/255.0.0.0 ::1/128
	    </Directory>


	</VirtualHost>
