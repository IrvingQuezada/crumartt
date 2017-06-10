<?php
	
	require 'funcs/conexion.php';
	require 'funcs/funcs.php';
	
	$errors = array();
	
	if(!empty($_POST))
	{
		$nombre = $mysqli->real_escape_string($_POST['nombre']);	
		$usuario = $mysqli->real_escape_string($_POST['usuario']);	
		$password = $mysqli->real_escape_string($_POST['password']);	
		$con_password = $mysqli->real_escape_string($_POST['con_password']);	
		$email = $mysqli->real_escape_string($_POST['email']);	
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
		
		$activo = 0;
		$tipo_usuario = 2;
		$secret = '6Lda4RkUAAAAAP3ftSTy9-PoqoOw7ANhh6ttGa6Z';
		
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}
		
		if(isNull($nombre, $usuario, $password, $con_password, $email))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		if(!isEmail($email))
		{
			$errors[] = "Dirección de correo inválida";
		}
		
		if(!validaPassword($password, $con_password))
		{
			$errors[] = "Las contraseñas no coinciden";
		}
		
		if(usuarioExiste($usuario))
		{
			$errors[] = "El nombre de usuario $usuario ya existe";
		}
		
		if(emailExiste($email))
		{
			$errors[] = "El correo electronico $email ya existe";
		}
		
		if(count($errors) == 0)
		{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
			
			if($arr['success'])
			{
				
				$pass_hash = hashPassword($password);
				$token = generateToken();
				
				$registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);
				
				if($registro > 0 )
				{
					
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/crumartt/activar.php?id='.$registro.'&val='.$token;
					
					$asunto = 'Activar Cuenta - Sistema de Usuarios';
					$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, es indispensable de click en la siguiente liga <a href='$url'>Activar Cuenta</a>";
					
					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
					
					echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: $email";
					
					echo "<br><a href='index.php' >Iniciar Sesion</a>";
					exit;
					
					} else {
						  echo '<script type="text/javascript">';
                                                    echo 'setTimeout(function () { swal({
                                                    title: "ERROR",
                                                    text: "!Error al enviar email¡",
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
					
					} else {
					  echo '<script type="text/javascript">';
                                            echo 'setTimeout(function () { swal({
                                            title: "ERROR",
                                            text: "!Error al registrar",
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
				
				} else {
				  echo '<script type="text/javascript">';
                                    echo 'setTimeout(function () { swal({
                                    title: "ERROR",
                                    text: "!Error al comprobar captcha",
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
		
	}
	
?>

	<head>
		<title>Registro</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

</html>	
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
	
    <title>About</title>
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
 class="active" title="About" href="#" >Registro</a>
                                
                                    
                            
                            
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
			<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Reg&iacute;strate</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>  
					
					<div class="panel-body" >
						
						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>
							
							<div class="form-group">
								<label for="nombre" class="col-md-3 control-label">Nombre:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
								</div>
							</div>
							
							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuario</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha col-md-9" data-sitekey="6Lda4RkUAAAAABSh1YUsQsl911ERHzuvGDYjarIE"></div>
							</div>
							
							<div class="form-group">                                      
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>
						</form>
						<?php echo resultBlock($errors); ?>
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