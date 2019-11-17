# Whitby

## Instructions for local environment setup:

1. Fork and Clone the Repo
2. [Spin up an instance of the DB](https://www.a2hosting.com/kb/developer-corner/mysql/managing-mysql-databases-and-users-from-the-command-line)

```
mysql -u root -p
GRANT ALL PRIVILEGES ON *.* TO 'tnf'@'localhost' IDENTIFIED BY 'tnfTeam7';
mysql -u tnf -p tnf_whitby < tnf_whitby.sql
```
3. Launch dev environment

`php -S localhost:8080`
 	add.php 	inserts into line_of_contact client has been failing	
	delete.php 	deletes a client from deceased table
	edr.php  coming soon not implemented yet
	functions.php 	export files to views
	functions_clients.php 	function newclient function hospicecall function getactiveclient
	functions_display.php 	makes components html for displaying client(s)/report information go over
	functions_forms.php 	makes components html for displaying forms
	functions_init.php 	has globals connects to db and defines head and tail of html page so browser know to render it as html page also has sidebar
	functions_notes.php   interacts with deceased notes table and displays a form and a table
	functions_poc.php   renders point of contact display
	functions_sql.php 	sql queries
	functions_staff.php 	get staff drom db and displays it
	globals.php 	90% of the global variables
	index.php 	homepage and lets the app know it's running
	mail.php 	auto generated to send an email from the server
	menu.php 	the container that runs the different functions
	new.php 	has functions newseceased newcircumstance newpointofcontact 
	test.php 	auto generated
	tnf_whitby.sql 	database startup script everytime you add a new person it auto increments
	update.php the view for updating any table
