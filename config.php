<?php
$dbhost = getenv('DB_HOST');
if ($dbhost === false) {
    $dbhost = 'localhost';
}

$dbname = getenv('DB_NAME');
if ($dbname === false) {
    $dbname = 'soma';
}

$dbuser = getenv('DB_USER');
if ($dbuser === false) {
    $dbuser = 'postgres';
}

$dbpass = getenv('DB_PASSWORD');
if ($dbpass === false) {
    $dbpass = '';
}

$db = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
if( !$db ){
    echo "Disconnect";
}
?>
