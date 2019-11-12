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
