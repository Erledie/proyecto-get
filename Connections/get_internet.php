<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_get = "localhost";
$database_get = "deredcom_get";
$username_get = "deredcom";
$password_get = "+?zKtaI4[IzW";
$get = mysql_pconnect($hostname_get, $username_get, $password_get) or trigger_error(mysql_error(),E_USER_ERROR); 
?>