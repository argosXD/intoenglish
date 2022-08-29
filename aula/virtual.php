<?php 
  
  require($_SERVER['DOCUMENT_ROOT']."/box/const/const.lib.php");
  require($_SERVER['DOCUMENT_ROOT']."/box/base/base.lib.php");

  session_start();




  if(!isset($_SESSION["id_usuario"])){

      header('location: '."https://www.intoenglish.com.mx/iniciar-sesion.html?error=1"); 

  }


?>

<!DOCTYPE html>

<html lang="esp">

<head>
    <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aula virtual |Into English </title>
    <link rel="shortcut icon" href="../img/logointo.png" />
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.6/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.6/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<script>
	$(function () {

		$("#menu_toggle").css("display","none");
		

		$(".perfil").click(function(){


			window.location.href = 'https://www.intoenglish.com.mx/aula/virtual.php';



		});

        $(".LanzadorP").click(function(){

            Swal.fire({
              title: 'Plataforma',
              text: 'Hola querido usuario, te preguntas que vas a poder realizar en esta sección, ¿verdad? pronto verás habilitada, para tu beneficio y progreso, ejercicios dinámicos para consolidar; gramática (GRAMMAR), comprensión auditiva (LISTENING), lectura, ¡(READING) y hasta desarrollar tu SPEAKING! Desde básico hasta Avanzado.',
              imageUrl: '../img/cons1.jpg',
              imageWidth: '100%',
              imageHeight: 300,
              imageAlt: 'algo',

            });

            $(".swal2-html-container").addClass("text-justify");

            $(".swal2-image").css("margin-top","0px");





        });


        $(".LanzadorPa").click(function(){

            Swal.fire({
              title: 'Pagos',
              text:'Hola, agradecemos tu interés, en esta sección podrás realizar los pagos, así como domiciliar tu tarjeta. ¡Podrás escoger la modalidad que más te interese y gozar de los beneficios que nuestros paquetes puedan ofrecer!',
              imageUrl: '../img/cons2.jpg',
              imageWidth: '100%',
              imageHeight: 300,
              imageAlt: 'algo',

            });

            $(".swal2-html-container").addClass("text-justify");

            $(".swal2-image").css("margin-top","0px");

        });

        $(".LanzadorPro").click(function(){

            Swal.fire({
              title: 'Progreso',
              text: 'Aquí podrás descargar tu boleta y verás tus avances, así como la retroalimentación que necesitas para avanzar.',
              imageUrl: '../img/cons1.jpg',
              imageWidth: '100%',
              imageHeight: 300,
              imageAlt: 'algo',

            });

            $(".swal2-html-container").addClass("text-justify");

            $(".swal2-image").css("margin-top","0px");

        });







	})
</script>

<style type="text/css">
    .circular--portrait {
      position: relative;
      width: 100px;
      height: 100px;
      overflow: hidden;
      border-radius: 50%;
    }

    .circular--portrait img {
      width: 100%;
      height: auto;
    }

    .imagenie{

        border-radius: 0;
        width: 50px !important;
        height: 50px !important;
        margin-left: 5px; 


    }

</style>

<body class=" nav-md">
    <input id="id_usuario" type="hidden" name="" value="<?php echo $_SESSION["id_usuario"]; ?>">


    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col" style="background-color:#012060;">
                <div class="left_col scroll-view" style="background-color:#012060;">
                    <!--             <div class="navbar nav_title" style="border: 0; background-color:#012060;">
             
                 
            </div> -->
                    <div class="clearfix"></div>
                    <img src="../img/logo_blanco.png" alt="..." style="width:90%;display: inline-block;padding-top: 5%;margin-left: 3px;">
                    <!-- <p style="color: white; margin-bottom: 0px; margin-left: 3px;"> IntoEnglish</p> -->
                    <!-- menu profile quick info -->
                    <div class="profile clearfix" style="margin: 10px;">

                        <div class="circular--portrait" style=" display: block; float: left; ">
                            <img  src="<?php echo " ../usuarios/".$_SESSION['usuario_ruta_foto']; ?>" class=""> 
                            
                        </div>
                       
                        <div class="profile_info" style="width: 50%; float: right; padding-top: 10px;">
                            <span>Bienvenido</span>
                            <h2>
                                <?php echo $_SESSION["usuario_nombre"]?>
                            </h2> 
                            
                        </div>
                        
                    </div>
                    <!-- /menu profile quick info -->
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                            	<li class="perfil"><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Mi perfil"><div class="circular--portrait imagenie" style="">
                            <?php

                            if($_SESSION['usuario_ruta_foto']=="predeterminado.jpg"){
                                echo '<img  src="../usuarios/'."predeterminadoMenu.jpg".'" class="" style=" height: 100% !important;">';
                            }else{
                                echo '<img  src="../usuarios/'.$_SESSION['usuario_ruta_foto'].'" class="circuloI" style=" height: 100% !important;">';
                            }

                            ?>


                            
                        </div> <!-- Usuarios --> <span class="fa fa-chevron-down"></span></a>
                                    
                                </li>

                              
                                <?php

                   if( $_SESSION["id_tipo_usuario"]=="3"){


                  ?>
                                <li><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Usuarios"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/usuarios.svg" class="iconoie" style=""> 
                            
                        </div><!-- Usuarios --> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="?modulo=3">Administración de Usuarios </a></li>
                                        <li><a href="?modulo=10">Administración de Maestros </a></li>
                                    </ul>
                                </li>

                                  
                                <?php

                   }

                  ?>

                    <?php

                   if($_SESSION["id_tipo_usuario"]=="2" || $_SESSION["id_tipo_usuario"]=="3"){


                  ?>
                                <li><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Grading"> <div class="circular--portrait imagenie" style="">
                            <img  src="../img/GRADING.svg" class="iconoie" style="padding-bottom: 10px;"> 
                            
                        </div><!-- Material de apoyo  --><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="?modulo=6">Administración de grupos </a></li>
                                        <li><a href="?modulo=7">Mis Grupos </a></li>
                                    </ul>
                                </li>

                                                                <li><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Feed Back"> <div class="circular--portrait imagenie" style="">
                            <img  src="../img/feedback.svg" class="iconoie" style="padding-bottom: 10px;"> 
                            
                        </div><!-- Material de apoyo  --><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="?modulo=30">Un sub menu</a></li>
                                    </ul>
                                </li>
                                <?php

                      }

                  ?>




                    
                              
                                <?php

                   if($_SESSION["id_tipo_usuario"]=="2" || $_SESSION["id_tipo_usuario"]=="3"){


                  ?>
                    

                                <li class="LanzadorP"><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Plataforma"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/plataforma.svg" class="iconoie" style="padding-bottom: 10px;"> 
                            
                        </div>  <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        
                                    </ul>
                                </li>

                                            <li><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Social"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/social.svg" class="iconoie" style="padding-bottom: 10px;"> 
                            
                        </div> <!-- Examenes --> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="?modulo=3">Examen 1 </a></li>
                                    </ul>
                                </li>

                                <?php

                   if($_SESSION["id_tipo_usuario"]=="3"){


                  ?>

                                 <li><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Estadisticas"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/estadisticas.svg" class="iconoie" style="height: 100% !important;"> 
                            
                        </div><!-- Usuarios --> <span class="fa fa-chevron-down"></span></a>
                                    
                                </li>

                                <?php

                            }




                            ?>

                          


                            

                            ?>
                                <?php

                   }

                  ?>


                      <?php

                   if($_SESSION["id_tipo_usuario"]=="1"){


                  ?>

                                 <li class="LanzadorPro"><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Progreso"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/progreso.png" class="iconoie" style="height: 100% !important;"> 
                            
                        </div>  <span class="fa fa-chevron-down"></span></a>
                                    
                                </li>

                                <li class="LanzadorP"><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Plataforma"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/plataforma.svg" class="iconoie" style="padding-bottom: 10px;"> 
                            
                        </div>  <span class="fa fa-chevron-down"></span></a>
                                   
                                </li>

                                                                            <li><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Social"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/social.png" class="iconoie" style="padding-bottom: 10px;"> 
                            
                        </div> <!-- Examenes --> <span class="fa fa-chevron-down"></span></a>
                                   
                                </li>

                        <li class="LanzadorPa"><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Pagos"><div class="circular--portrait imagenie" style="">
                            <img  src="../img/PAGOS.png" class="iconoie" style="padding-bottom: 10px;"> 
                            
                        </div> <!-- Examenes --> <span class="fa fa-chevron-down"></span></a>
                                    
                                </li>

                                <?php

                            }

                            ?>

                     



                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small" style="background-color:#012060;">
                        <a data-toggle="tooltip" data-placement="top" title="Settings" style="background-color:#012060;">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen" style="background-color:#012060;">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock" style="background-color:#012060;">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="../iniciar-sesion.html" id="cerrar" style="background-color:#012060;">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="production/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo " ../usuarios/".$_SESSION['usuario_ruta_foto']; ?>" alt="">
                                    <?php echo $_SESSION["usuario_nombre"]?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="production/javascript:;"> Profile</a>
                                    <a class="dropdown-item" href="production/javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                    <a class="dropdown-item" href="production/javascript:;">Help</a>
                                    <a class="dropdown-item" href="../iniciar-sesion.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                            <li role="presentation" class="nav-item dropdown open">
                                <a href="production/javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">0</span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                                    <li class="nav-item">
                                        <div class="text-center">
                                            <a class="dropdown-item">
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main" style="height: auto !important;">
                <div class="">
                    <div class="page-title">
                        <div class="title_left" style="width: 100% !important; background-color: #f7f7f7;">
                            <h3> <?php echo $_SESSION["usuario_nombre"]?></h3>
                        </div>
                        <div class="title_right">
                        </div>
                    </div>
                    <?php

                if(isset($_GET["modulo"])){

                    if($_GET["modulo"]==3){
                    
                      require(ROOT_PATH."/usuarios/usuarios.php");

                    }elseif ($_GET["modulo"]==6) {
                       require(ROOT_PATH."/grupos/grupos.php");
                    }elseif($_GET["modulo"]==7){
                       require(ROOT_PATH."/grupos/misgrupos.php");
                    }elseif($_GET["modulo"]=="10"){
                      require(ROOT_PATH."/usuarios/maestros.php");

                    }

                }else{
                    require(ROOT_PATH."/usuarios/perfil.php");
                }
            ?>
                </div>
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Into English | © Todos los derechos reservados
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>


    <script >
        
        $(function () {

         $(".circuloI").parent().css("border-radius","50%");

            $(".tab_content").hide(); //Hide all content
            $("ul.tabs li:first").addClass("active").show(); //Activate first tab
            $(".tab_content:first").show(); //Show first tab content

            //On Click Event
            $("ul.tabs li").click(function() {

              $("ul.tabs li").removeClass("active"); //Remove any "active" class
              $(this).addClass("active"); //Add "active" class to selected tab
              $(".tab_content").hide(); //Hide all tab content

              var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to  identify the active tab + content
                         
              $(activeTab).fadeIn(); //Fade in the active ID content
              return false;
            });


        });
    </script>



<div class="modal fade" id="SBoletas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Consulta de boletas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Seleccione una unidad </h5>
         <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Unidad</label>
              <div class="col-md-9 col-sm-9">
                <select class="form-control" id="UnidadB"></select>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="VBoleta">Ver boleta</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editarUsdu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Usuario </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="tabs">
             <li><a href="#tab1">Datos Personales</a></li>
             <li><a href="#tab2">Foto de Perfil</a></li>
        </ul>

        <div class="tab_container">
            <div class="tab_content" id="tab1">
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre(s)  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formEu" id="nombreeu">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Apellido Paterno  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formEu" id="apeu">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Apellido Materno  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formEu" id="ameu">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Correo  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formEu" id="correoeu">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Telefono  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formEu" id="telefonoeu">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Contraseña  </label>
              <div class="col-md-9 col-sm-9">
                <input type="password" class="form-control " id="psweu" placeholder="">
                <input type="password" class="form-control " id="psw2eu" placeholder="Repetir Contraseña">
            </div>
          </div>
            </div>
            <div class="tab_content text-center" id="tab2">
             
                        <p style="color:black;">
                         Seleccione una foto de perfil
                        </p>

                        <span class="nuestroinput1u" style="">
                         <input id="nuestroinput1u" name="nuestroinput1u" type="file"  accept="image/*"   >
                       </span>
                       <label for="nuestroinput1u">
                           <span> <i class="fa fa-upload"></i>  &nbsp;  seleccionar  </span>
                       </label>

                       <div class="divImgu" ><img  style="width: 200px; height: 200px;" id="imgTitulou" src="" alt=""></div>
            </div>
        </div>
 
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="eusuario">Guardar</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>