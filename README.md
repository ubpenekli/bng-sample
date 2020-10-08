# bng-sample
Project for Bynogame Job Application

This project made by Uğur Batuhan Penekli for ByNoGame Job Application.

The project includes GET and POST methods for stocks database table.

You must import sql file to your database and change the connection variables from the line 15 on stocks.php to run the files. Or you can directly access live project on my website ubpenekli.com/bng and you can use the /stocks route methods GET and POST.

For routing, I used .htaccess file because of make it on the most basic way. But when it needed, I can use different routing systems.

You do not need any parameter to use GET method of /stocks route. It will give you a simple list of stocks table data.

Yo need to use 4 required parameters to use POST method.

1. product_id (required): you must use it as a unique value and must be integer.
2. name (required): you can use it as a string value and you do not have an expression rule.
3. stock (required): it must must be integer.
4. create_date (required): it must be formatted as "YYYY-MM-DD HH:MM:SS".
