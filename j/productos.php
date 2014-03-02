<?php require_once('../Connections/get.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_get, $get);
$query_productos = "SELECT * FROM producto WHERE n_estado = 1 ORDER BY n_orden, c_nombre_producto ASC";
$productos = mysql_query($query_productos, $get) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);
do {
	$s_imagen ="<img src='img/tn-".$row_productos['id'].".png' alt='Imagen'>";
//echo "<li>".$s_imagen.$row_productos['c_nombre_producto']."</li>";
echo "<li><a href='productos.php?c_nombre=".$row_productos['c_nombre_producto']."' title='Ver la ".$row_productos['c_nombre_producto']."' >".$s_imagen.'<br>'.$row_productos['c_nombre_producto']."</a></li>";
}while ($row_productos = mysql_fetch_assoc($productos));
mysql_free_result($productos);
?>
