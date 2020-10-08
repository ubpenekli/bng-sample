<p>This project made by Uğur Batuhan Penekli for ByNoGame Job Application.</p>

<p>The project includes GET and POST methods for stocks database table.</p>

<p>You must import sql file to your database and change the connection variables from the line 15 on stocks.php to run the files. Or you can directly access live project on my website
  <a href="http://ubpenekli.com/bng">ubpenekli.com/bng</a> and you can use the /stocks route methods GET and POST.
</p>

<p>You do not need any parameter to use GET method of /stocks route. It will give you a simple list of stocks table data.</p>

<p>Yo need to use 4 required parameters to use POST method.</p>

<ul>
  <ol><strong>product_id</strong> <em>(required)</em>: you must use it as a unique value and must be integer.</ol>
  <ol><strong>name</strong> <em>(required)</em>: you can use it as a string value and you do not have an expression rule.</ol>
  <ol><strong>stock</strong> <em>(required)</em>: it must must be integer.</ol>
  <ol><strong>create_date</strong> <em>(required)</em>: it must be formatted as "YYYY-MM-DD HH:MM:SS".</ol>
</ul>
