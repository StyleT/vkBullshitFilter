<?php

echo "Hello world!";

$mysqli = new mysqli( '/tmp/mysql/santos.sock',  'jacqueline',
                      'E2U35tk0', 'santos' );
if (!$mysqli) {
    die('Could not connect mysqli: ' . mysql_error());
}
echo 'Connected successfully mysqli';

$link = mysql_connect('localhost:/tmp/mysql/santos.sock', 'jacqueline', 'E2U35tk0');
if (!$link) {
    die('Could not connect mysql: ' . mysql_error());
}
echo 'Connected successfully mysql';
mysql_close($link);
?>
