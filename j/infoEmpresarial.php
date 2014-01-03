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

$colname_informacionEmp = "-1";
if (isset($_GET['n_tipo'])) {
  $colname_informacionEmp = $_GET['n_tipo'];
}
mysql_select_db($database_get, $get);
$query_informacionEmp = sprintf("SELECT * FROM empresarial WHERE id = %s", GetSQLValueString($colname_informacionEmp, "int"));
$informacionEmp = mysql_query($query_informacionEmp, $get) or die(mysql_error());
$row_informacionEmp = mysql_fetch_assoc($informacionEmp);
$totalRows_informacionEmp = mysql_num_rows($informacionEmp);
echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>";
echo "<div id='cerrar'>Cerrar X</div><h2>".utf8_encode($row_informacionEmp['c_nombreInf'])."</h2>";

echo '<article>'.utf8_encode($row_informacionEmp['c_descripcion']).'</article>';
echo "<script>  $('#cerrar').on('click', function(){
    $('#infoEmpresarial').css('height','0px');
    setTimeout(function(){
      $('#infoEmpresarial').remove();
    },600);
  });</script>";
mysql_free_result($informacionEmp);
?>
