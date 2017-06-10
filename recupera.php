<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<?php
require 'funcs/conexion.php';
include 'funcs/funcs.php';
session_start();
if(isset($_SESSION["id_usuario"])){
header("Location: welcome.php");
}
$errors = array();
if(!empty($_POST))
{
$email = $mysqli->real_escape_string($_POST['email']);
if(!isEmail($email))
{
     echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  title: "ERROR",
  text: "!Error, correo inválido¡",
  type: "error",
  showCancelButton: false,
  confirmButtonColor: "#00CCCC",
  confirmButtonText: "OK",
  closeOnConfirm: false
},
function(){
  window.location.href="recupera.php";
});';
  echo '}, 0);</script>';
}
if(emailExiste($email))
{			
$user_id = getValor('id', 'correo', $email);
$nombre = getValor('nombre', 'correo', $email);
$token = generaTokenPass($user_id);
$url = 'http://'.$_SERVER["SERVER_NAME"].'/crumartt/cambia_pass.php?user_id='.$user_id.'&token='.$token;
$asunto = 'Recuperar Password - Sistema de Usuarios';
$cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";
if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
echo "Hemos enviado un correo electronico a las direcion $email para restablecer tu password.<br />";
echo "<a href='index.php' >Iniciar Sesion</a>";
exit;
}
} else {

    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  title: "ERROR",
  text: "!Error, correo inválido¡",
  type: "error",
  showCancelButton: false,
  confirmButtonColor: "#00CCCC",
  confirmButtonText: "OK",
  closeOnConfirm: false
},
function(){
  window.location.href="recupera.php";
});';
  echo '}, 0);</script>';
}
}
?>

	

<!DOCTYPE html>
<html dir="ltr">
<head>
    
	<script>
    var themeHasJQuery = !!window.jQuery;
</script>
<script type="text/javascript" src="./assets/js/jquery.js?1.0.651"></script>
<script>
    window._$ = jQuery.noConflict(themeHasJQuery);
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./assets/css/bootstrap.css?1.0.651" media="screen" />
<script type="text/javascript" src="./assets/js/bootstrap.min.js?1.0.651"></script>
<!--[if lte IE 9]>
<link rel="stylesheet" href="./assets/css/layout.ie.css?1.0.651">
<script src="./assets/js/layout.ie.js?1.0.651"></script>
<![endif]-->
<link class="" href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic&subset=latin' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="./assets/js/layout.core.js"></script>
<script src="./assets/js/CloudZoom.js?1.0.651"></script>
<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
	
 <title>Recuperar Password</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="./assets/css/style.css?1.0.651">
	<script src="./assets/js/script.js?1.0.651"></script>
    <meta charset="utf-8">
    
    
    
    
</head>
<body class="bd-body-7  bootstrap bd-pagebackground">
    <header class=" bd-headerarea-1">
        <div data-affix
     data-offset=""
     data-fix-at-screen="top"
     data-clip-at-control="top"
     
 data-enable-lg
     
 data-enable-md
     
 data-enable-sm
     
     class=" bd-affix-7"><section class=" bd-section-4 bd-background-width bd-tagstyles  bd-aligncontent bd-aligncontent-13 " data-aligncontent-size="page" id="section3" data-section-title="Top White with Three Containers">
    <div class="bd-section-inner">
        <div class="bd-section-align-wrapper">
            <div class=" bd-layoutbox-13 clearfix">
    <div class="bd-container-inner">
        <div class=" bd-layoutbox-17 clearfix">
    <div class="bd-container-inner">
        
    
    <nav class=" bd-hmenu-1" data-responsive-menu="true" data-responsive-levels="">
        
            <div class=" bd-responsivemenu-11 collapse-button">
    <div class="bd-container-inner">
        <div class=" bd-menuitem-4">
            <a  data-toggle="collapse"
                data-target=".bd-hmenu-1 .collapse-button + .navbar-collapse"
                href="#" onclick="return false;">
                    <span>MENU</span>
            </a>
        </div>
    </div>
</div>
            <div class="navbar-collapse collapse">
            
            <div class=" bd-horizontalmenu-1 clearfix">
                <div class="bd-container-inner">
                    
                    <ul class=" bd-menu-1 nav nav-pills navbar-left">
                        
                        
                        
                        
                            
                            <li class=" bd-menuitem-2 ">
                                <a  title="Home Page" href="./home.html" >Inicio</a>
                                
                                    
                            
                            
                            </li>
                            
                            <li class=" bd-menuitem-2 ">
                                <a 
 class="active" title="About" href="#" >Recupera la contraseña</a>
                                
                                    
                            
                            
                            </li>
                            
                            <li class=" bd-menuitem-2 ">
                                <a  title="Contacts" href="./citas.php" >Citas</a>
                                
                                    
                            
                            
                            </li>
                    </ul>
                    
                </div>
            </div>
            
        
            </div>
    </nav>
    </div>
</div>
	
		<div class=" bd-layoutbox-40 clearfix">
    <div class="bd-container-inner">
        <h1 class=" bd-textblock-78 bd-content-element">
    CRUMART
</h1>
    </div>
</div>
	
		<div class=" bd-layoutbox-42 clearfix">
    <div class="bd-container-inner">
        <div class=" bd-socialicons-7">
    
        <a target="_blank" data-social-url data-path-to-root="." class=" bd-socialicon-71 bd-socialicon"
   href="//www.facebook.com/sharer.php?u=">
    <span class="bd-icon"></span><span></span>
</a>
    
        <a target="_blank" data-social-url data-path-to-root="." class=" bd-socialicon-72 bd-socialicon"
   href="//twitter.com/share?url=&amp;text=">
    <span class="bd-icon"></span><span></span>
</a>
    
    
    
    
    
    
    
    
</div>
    </div>
</div>
    </div>
</div>
        </div>
    </div>
</section></div>
</header>
	
		<div class=" bd-stretchtobottom-2 bd-stretch-to-bottom" data-control-selector=".bd-content-12"><div class=" bd-content-12 ">
    <div class="bd-container-inner">
        
            <div class=" bd-htmlcontent-8" 
 data-page-id="page.12">
    <div class="bd-containereffect-7 container "><section class=" bd-section-8 bd-tagstyles  bd-aligncontent bd-aligncontent-11" data-aligncontent-size="page" id="section2" data-section-title="Centered Text With Button">
    <div class="bd-section-inner">
        <div class="bd-section-align-wrapper">
            <div class=" bd-layoutbox-22 clearfix">
    <div class="bd-container-inner">
       
	<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>                                        
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Enviar</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
									</div>
								</div>
							</div>    
						</form>
					</div>                     
				</div>  
			</div>
		</div>
    </div>
</div>
        </div>
    </div>
</section></div>
</div>
    </div>
</div></div>
	
		<footer class=" bd-footerarea-1">
        <div class=" bd-parallaxbackground-3 bd-parallax-bg-effect" data-control-selector=".bd-section-2"><section class=" bd-section-2 bd-tagstyles bd-textureoverlay bd-textureoverlay-8  bd-aligncontent bd-aligncontent-22" data-aligncontent-size="page" id="section4" data-section-title="Map Two Columns">
    <div class="bd-section-inner">
        <div class="bd-section-align-wrapper">
            <div class="bd-containereffect-9 container "><div class=" bd-layoutcontainer-14  bd-columns">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row 
 bd-row-flex 
 bd-row-align-middle">
                <div class=" bd-columnwrapper-36 
 col-sm-6">
    <div class="bd-layoutcolumn-36 bd-column" ><div class="bd-vertical-align-wrapper"><h1 class=" bd-textblock-81 bd-content-element">
    Contacto
</h1>
	
		<p class=" bd-textblock-83 bd-content-element">
    Estamos a tus ordenes por los siguientes medios
</p>
	
		<div class=" bd-spacer-38 clearfix"></div>
	
		<span class="bd-iconlink-2 bd-icon-43 bd-icon "></span>
	
		<p class=" bd-textblock-93 bd-content-element">
    Colonia San Mateo Tecalco, Calle Francisco Villa Mz.3 Lt.28
</p>
	
		<div class=" bd-spacer-41 clearfix"></div>
	
		<span class="bd-iconlink-5 bd-icon-46 bd-icon "></span>
	
		<p class=" bd-textblock-95 bd-content-element">
    crumartmontacargas@hotmail.com
</p>
	
		<div class=" bd-spacer-43 clearfix"></div>
	
		<span class="bd-iconlink-7 bd-icon-48 bd-icon "></span>
	
		<p class=" bd-textblock-97 bd-content-element">
    55-84-32-45-22
</p></div></div>
</div>
	
		<div class=" bd-columnwrapper-38 
 col-sm-6">
    <div class="bd-layoutcolumn-38 bd-column" ><div class="bd-vertical-align-wrapper"><div class="bd-googlemap-6 bd-imagestyles-20 ">
    <div class="embed-responsive" style="height: 100%; width: 100%;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15026.768892495442!2d-98.97422389999998!3d19.6831319!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1489640437160" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div></div></div>
</div>
            </div>
        </div>
    </div>
</div></div>
        </div>
    </div>
</section></div>
</footer>
	
		<div data-smooth-scroll data-animation-time="250" class=" bd-smoothscroll-3"><a href="#" class=" bd-backtotop-1 ">
    <span class="bd-icon-67 bd-icon "></span>
</a></div>
</body>
</html>