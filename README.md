# Snapshooter service

Snapshooter service based on DO API

## How to configure

1. Create personal access token from your digital ocean account. 

<p align="center">
  <img src="https://i.imgur.com/MvpH5Py.png"/>
  <br/>
</p>

2. Copy `.env.sample` to `.env` (i.e. `cp .env.sample .env`) and update values of all parameters. 
3. Import [SQLDump](https://github.com/kamal250/snapshooter/blob/master/sql/initialdump.sql) to your database.
4. From root directory of the project, execute `composer install` command.

## How to use

1. To store all droplet references within your database, visit - `http://example.com/fetch_all_droplets.php`.
2. To create snapshot of all droplet references, visit - `http://example.com/create_snapshots.php` and check within Images->Snapshots in DO. [Note: It is recommended to execute this URL when you've less traffic on your droplet.]
