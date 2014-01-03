<?php require_once('Connections/oac.php'); ?>
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

mysql_select_db($database_oac, $oac);
$query_noticias = "SELECT * FROM noticias WHERE n_estado = 1";
$noticias = mysql_query($query_noticias, $oac) or die(mysql_error());
$row_noticias = mysql_fetch_assoc($noticias);
$totalRows_noticias = mysql_num_rows($noticias);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['c_usuario'])) {
  $loginUsername=$_POST['c_usuario'];
  $password=$_POST['c_contrasena'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin/menu.php";
  $MM_redirectLoginFailed = "administrador.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_oac, $oac);
  
  $LoginRS__query=sprintf("SELECT c_usuarios, c_contrasena FROM v_usuarios WHERE c_usuarios=%s AND c_contrasena=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $oac) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>O.A.C. Consultores</title>
<meta name='title' content='oac-consultores'/>
<meta name='description' content='oac consutores es una compañia de asesoria contable y empresarial en colombia'/>
<meta name='keywords' content='asesoria, asesoria contable, asesoria empresarial, asesoria para crear empresa, zipaquira, contabilidad, manejo helisa, asesoria contable en zipaquira'/>
<meta name='author' content='dered-diseño y sistemas de informacion'/>
<meta name='language' content='spanish'/>
<meta name='robots' content='index,follow'/>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="layout.css" rel="stylesheet" type="text/css" />
<script src="maxheight.js" type="text/javascript"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<link rel="shortcut icon" href="../images/icono.ico" />
</head>

<body id="index" onload="new ElementMaxHeight();">

<div class="mundotext">
  <h1>O.A.C Consultores</h1> <br />
  Un mundo completo de Soluciones contables para su negocio.
</div>
<div id="header_tall">
<div id="main">
			<!--header -->
			<div id="header">
				<div class="h_logo">
						<div class="left">
						<img alt="" src="images/logo.jpg" /><br />
				  </div>
					<div class="right">
						<a href="#">RSS</a>				</div>
					<div class="clear"></div>
			  </div>
				<div id="menu">
					<div class="rightbg">
						<div class="leftbg">
							<div class="padding">
								<ul>
									<li><span>Inicio</span></li>
									<li><a href="servicios.php">Servicios</a></li>
									<li><a href="calendario.php">Calendarios</a></li>
									<li><a href="clientes.php">Clientes</a></li>
									<li class="last"><a href="contacto.php">Contacto</a></li>
								</ul>
								<br class="clear" />
							</div>
						</div>
					</div>
				</div>
				<div class="content">
				  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="738" height="250">
				    <param name="movie" value="images/planeta.swf" />
				    <param name="quality" value="high" />
				    <param name="wmode" value="opaque" />
				    <param name="swfversion" value="6.0.65.0" />
				    <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
				    <param name="expressinstall" value="Scripts/expressInstall.swf" />
				    <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
				    <!--[if !IE]>-->
				    <object type="application/x-shockwave-flash" data="images/planeta.swf" width="738" height="250">
				      <!--<![endif]-->
				      <param name="quality" value="high" />
				      <param name="wmode" value="opaque" />
				      <param name="swfversion" value="6.0.65.0" />
				      <param name="expressinstall" value="Scripts/expressInstall.swf" />
				      <!-- El navegador muestra el siguiente contenido alternativo para usuarios con Flash Player 6.0 o versiones anteriores. -->
				      <div>
				        <h4>El contenido de esta página requiere una versión más reciente de Adobe Flash Player.</h4>
				        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" width="112" height="33" /></a></p>
			          </div>
				      <!--[if !IE]>-->
			        </object>
				    <!--<![endif]-->
			      </object>
				 <div class="text">
				   
</div><!--<div class="clear"></div>-->
			  </div>
	</div>
			<!--header end-->
			<div id="middle">
				<div class="indent">
					<div class="columns1">
						<div class="column1">
							<div class="border">
								<div class="btall">
									<div class="ltall">
										<div class="rtall">
											<div class="tleft">
												<div class="tright">
													<div class="bleft">
														<div class="bright">
														  <div class="ind">
																<div class="h_text">
																	<img alt="" src="images/1-t1.jpg" /><br />
															  </div>
															  <div class="padding">
															    <p>&nbsp;</p>
															    <p>&nbsp;</p>
															    <p>&nbsp;</p>
															    <p>&nbsp;</p>
															    <p>&nbsp; </p>
															    <p>&nbsp;</p>
															<p>&nbsp;</p>  
															<p>
														    <p>&nbsp;</p></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="indent_column">&nbsp;</div>
						<div class="column2">
							<div class="border">
						  <div class="btall">
									<div class="ltall">
										<div class="rtall">
											<div class="tleft">
												<div class="tright">
													<div class="bleft">
														<div class="bright">
														  <div class="ind">
																<div class="h_text">
																	<img alt="" src="images/1-t2.jpg" /><br />
																</div>
														    <div class="padding"><strong class="b_text">Ingreso</strong><br /><br />
																	<form id="form1" method="POST" action="<?php echo $loginFormAction; ?>">
																	  <table width="95%" align="center" cellspacing="0">
																	    <tr>
																	      <td align="center" valign="middle"><label for="c_usuario">Usuario:</label></td>
																        </tr>
																	    <tr>
																	      <td align="center" valign="middle"><input type="text" name="c_usuario" id="c_usuario" /></td>
																        </tr>
																	    <tr>
																	      <td align="center" valign="middle"><label for="c_contrasena">Contraseña:</label></td>
																        </tr>
																	    <tr>
																	      <td align="center" valign="middle"><input type="password" name="c_contrasena" id="c_contrasena" /></td>
																        </tr>
																	    <tr>
																	      <td align="center" valign="middle">&nbsp;</td>
																        </tr>
																	    <tr>
																	      <td align="center" valign="middle"><input type="image" src="images/click_here.gif" /></td>
																        </tr>
																      </table>
															  </form>
														    </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="indent_column">&nbsp;</div>
						<div class="column3">
							<div class="border">
								<div class="btall">
									<div class="ltall">
										<div class="rtall">
											<div class="tleft">
												<div class="tright">
													<div class="bleft">
														<div class="bright">
															<div class="ind">
																<div class="h_text">
																	<img alt="" src="images/1-t3.jpg" /><br />
																</div>
															  <div class="padding"><br /><br />
																  <p>
														      <p>&nbsp;</p>
														      <p>&nbsp;</p>
														      <p>&nbsp;</p>
														      <p>&nbsp;</p>
														      <p>&nbsp;</p>
														      <p>&nbsp;</p>
															  </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="columns2">
						<div class="ver_line">
					    <div class="column2"><br />
					    </div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<!--footer -->
			<div id="footer">
				<div class="indent">
					&copy;2011 - <a href="http://www.dered.com.co/" target="_blank">dered</a>- Diseño y Sistemas de Información &bull;</div>
			</div>
			<!--footer end-->
</div>
</div>
<script type="text/javascript">
swfobject.registerObject("FlashID");
swfobject.registerObject("FlashID");
</script>
</body>
</html>
<?php
mysql_free_result($noticias);
?>
