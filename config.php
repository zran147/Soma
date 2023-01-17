<?php
// $db  = pg_connect('localhost','root','','soma');
$db = pg_connect('host=localhost dbname=soma user=postgres password=********');
if( !$db ){
    echo "Disconnect";
}
?>
