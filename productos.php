<?php require_once('Connections/get.php'); ?>
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

$colname_consulta_productos = "-1";
if (isset($_GET['c_nombre'])) {
  $colname_consulta_productos = $_GET['c_nombre'];
}
mysql_select_db($database_get, $get);
$query_consulta_productos = sprintf("SELECT * FROM producto WHERE c_nombre_producto = %s", GetSQLValueString($colname_consulta_productos, "text"));
$consulta_productos = mysql_query($query_consulta_productos, $get) or die(mysql_error());
$row_consulta_productos = mysql_fetch_assoc($consulta_productos);
$totalRows_consulta_productos = mysql_num_rows($consulta_productos);

mysql_select_db($database_get, $get);
$query_consulta_descripcion = sprintf("SELECT * FROM caracteristicas WHERE id_producto = %s", GetSQLValueString($row_consulta_productos['id'], "text"));
$consulta_descripcion = mysql_query($query_consulta_descripcion, $get) or die(mysql_error());
$row_consulta_descripcion = mysql_fetch_assoc($consulta_descripcion);
$totalRows_consulta_descripcion = mysql_num_rows($consulta_descripcion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset='utf-8' />
	<title><?php echo $_GET['c_nombre']; ?> || Equipos de Impresión Grupo Get</title>
	<link rel="stylesheet" type="text/css" href="stylos/estilos.css">
	<link href="stylos/normalize.css" rel="stylesheet" type="text/css">
	<link href='//fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="j/prefixfree.min.js"></script>
	<script src="j/functions.js"></script>
</head>
<body>
	<section id='fondo'>
		<img id='img-producto' src="img/<?php echo $row_consulta_productos['id']; ?>.png" title='<?php echo $_GET['c_nombre']; ?>'>
	</section>
	<section id='fondo1'>
		<img src="img/fondo-1.png">
	</section>
	<section id='contenedor'>
		<h1><?php echo $_GET['c_nombre']; ?></h1>
		<article>
			<p><?php echo utf8_encode($row_consulta_productos['c_descripcion']); ?></p>
			<ul>
				<?php do{ ?>
				<li>
					<div class="titulo"><?php echo utf8_encode($row_consulta_descripcion['c_caracteristica']); ?></div>
					<div><?php echo utf8_encode($row_consulta_descripcion['c_descripcion']); ?></div>
				</li>
				<?php }while ($row_consulta_descripcion = mysql_fetch_assoc($consulta_descripcion)); ?>
			</ul>
		</article>
	</section>
	<nav>
		<a href="mantenimiento.html">
			<li id='serTecnico'></li>
		</a>
		<a href="">
			<li id='catalogo'></li>
		</a>
		<a href="#" id='link-equipos'>
			<li id='equipos'></li>
		</a>
	</nav>
	<ul id='bton1'>
		<li id='home' title='Volver al Inicio'>
			<a href="index.php">
				<img id='imagen-objetivos' src="img/home-off.png">
			</a>
		</li>
	</ul>
	<div id='redes'></div>
</body>
</html>
<?php
mysql_free_result($consulta_productos);
?>
