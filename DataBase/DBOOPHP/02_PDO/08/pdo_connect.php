<?php

$dsn = 'mysql:host=localhost;dbName=oophp';
//$dsn = 'sqlite:/Applications/MAMP/htdocs/DBOOP_PHP/sqlite/oophp.db';

$db = new PDO($dsn, 'root', 'root');