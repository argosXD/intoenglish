<?php

  require($_SERVER['DOCUMENT_ROOT']."/box/const/const.lib.php");
  require($_SERVER['DOCUMENT_ROOT']."/box/base/base.lib.php");


        $query1 = "SELECT grupos.id_grupo,  grupos.id_usuario as 'maestro', grupos.grupo_tipo_curso as 'grupo', grupos.grupo_descripcion as 'descripcion', niveles.nivel_descripcion as 'nivel' FROM `alumnos` INNER join grupos on alumnos.id_grupo = grupos.id_grupo INNER join niveles on niveles.id_nivel = grupos.id_nivel where alumnos.id_usuario = ".$_SESSION["id_usuario"];
        $user1 = pullQuery($query1);




  

?>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



<?php 
if($_SESSION["tipo_usuaro"]=="Alumno"){



?>



<style type="text/css">
    
    ul.tabs {
    margin: 0;
    padding: 0;
    float: left;
    list-style: none;
    height: 32px; /*--Set height of tabs--*/
    border-bottom: 1px solid #999;
    border-left: 1px solid #999;
    width: 100%;
  }
  ul.tabs li {
    float: left;
    margin: 0;
    padding: 0;
    height: 31px; /*--Subtract 1px from the height of the unordered list--*/
    line-height: 31px; /*--Vertically aligns the text within the tab--*/
    border: 1px solid #999;
    border-left: none;
    margin-bottom: -1px; /*--Pull the list item down 1px--*/
    overflow: hidden;
    position: relative;
    background: #e0e0e0;
  }
  ul.tabs li a {
    text-decoration: none;
    color: #000;
    display: block;
    font-size: 1.2em;
    padding: 0 20px;
    border: 1px solid #fff; /*--Gives the bevel look with a 1px white border inside the list item--*/
    outline: none;
  }
  ul.tabs li a:hover {
    background: #ccc;
  }
  html ul.tabs li.active, html ul.tabs li.active a:hover  { /*--Makes sure that the active tab does not
          listen to the hover properties--*/
    background: #fff;
    border-bottom: 1px solid #fff; /*--Makes the active tab look like it's connected with
          its content--*/
  }

  .tab_container {
  border: 1px solid #999;
  border-top: none;
  overflow: hidden;
  clear: both;
  float: left; width: 100%;
  background: #fff;
}
.tab_content {
  padding: 20px;
  font-size: 1.2em;
}

  .activo{
    background-color: #52c652;
    text-align: center;
    color: white;
    font-weight: 700;
    margin-bottom: 0px;

  }

  .desactivo{
    background-color: red;
    text-align: center;
    color: white;
    font-weight: 700;
    margin-bottom: 0px;

  }

    table#tablaArticulos .btn{
    box-shadow: 5px 6px 0px -1px rgba(0,0,0,0.75);
  -webkit-box-shadow: 5px 6px 0px -1px rgba(0,0,0,0.75);
  -moz-box-shadow: 5px 6px 0px -1px rgba(0,0,0,0.75);
  border-radius: 40px;
  }

  td{
    text-align: center;

  }

   input[type="file"]#nuestroinput1u {
                    width: 0.1px;
                    height: 0.1px;
                    opacity: 0;
                    overflow: hidden;
                    position: absolute;
                    z-index: -1;
                 }

    label[for="nuestroinput1u"] {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            background-color: #73879C;
            display: inline-block;
            transition: all .5s;
            cursor: pointer;
            padding: 5px 15px !important;
            text-transform: uppercase;
            width: fit-content;
            text-align: center;
            }

</style>



<style type="text/css">
    
    .highcharts-figure, .highcharts-data-table table {
      min-width: 320px; 
      max-width: 800px;
      margin: 1em auto;
    }

    #container {
      height: 450px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
      padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
      padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }

 /*   li::marker {
      content: "😁"
    }

    li::marker {
      content: attr(data-emoji);
    }

    li:hover::marker {
      content: "🤯";
    }*/

    .list{
        font-size: 30px;
    }

/*    .containerCaja{

        border-radius: 14px 14px 14px 14px;
        -moz-border-radius: 14px 14px 14px 14px;
        -webkit-border-radius: 14px 14px 14px 14px;
        border: 0px solid #000000;
                
        -webkit-box-shadow: 2px 3px 11px 3px rgba(0,0,0,0.75);
        -moz-box-shadow: 2px 3px 11px 3px rgba(0,0,0,0.75);
        box-shadow: 2px 3px 11px 3px rgba(0,0,0,0.75);

    }*/


</style>

<script type="text/javascript">

    function boletas(id){
        

        $.ajax({
              method: "POST",
              url: "../servicios/servicios.php",
              data: {
                  SSID: "boletas",
                 id_usuario: $("#id_usuario").val(),
                 id_grupo: id
              },
              success: function (response) {
                  response = JSON.parse(response);
                  console.log(response);
                  datos = response.datos;

                  if(response.status=="100"){

                    $("#UnidadB").html(response.cadena);

                    $("#SBoletas").appendTo("body").modal('show');

                    $("#VBoleta").click(function(){

                        if($("#UnidadB").val()!=null){
                            window.open( "../documentos/boleta.php?alumno="+$('#UnidadB option:selected').attr("data-id")+"&boleta="+$("#UnidadB").val(), '_blank');
                          }else{
                            swal("Atención","Debe Seleccionar una unidad","warning");
                          }


                    });

                  }else{
                        Swal.fire({
                                      title: 'Sin calificaciones registradas',
                                      text: 'Tus maestros aun no suben tus Califiaciones te avisaremos cuando ya esten registradas',
                                      imageUrl: '../img/calificaciones.png',
                                      imageWidth: '100%',
                                      imageHeight: 300,
                                      imageAlt: 'algo',

                                    });
                  }



              },
              error: function (a) {
                  console.log(a );
              }
        });
       
    }


 $( function() {

    // $.extend( true, $.fn.dataTable.defaults, {
    //   "language": {
    //       "decimal": ",",
    //       "thousands": ".",
    //       "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    //       "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    //       "infoPostFix": "",
    //       "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    //       "loadingRecords": "Cargando...",
    //       "lengthMenu": "Mostrar _MENU_ registros",
    //       "paginate": {
    //           "first": "Primero",
    //           "last": "Último",
    //           "next": "Siguiente",
    //           "previous": "Anterior"
    //       },
    //       "processing": "Procesando...",
    //       "search": "Buscar:",
    //       "searchPlaceholder": "Término de búsqueda",
    //       "zeroRecords": "No se encontraron resultados",
    //       "emptyTable": "Ningún dato disponible en esta tabla",
    //       "aria": {
    //           "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
    //           "sortDescending": ": Activar para ordenar la columna de manera descendente"
    //       },
    //       //only works for built-in buttons, not for custom buttons
    //       "buttons": {
    //           "create": "Nuevo",
    //           "edit": "Cambiar",
    //           "remove": "Borrar",
    //           "copy": "Copiar",
    //           "csv": "fichero CSV",
    //           "excel": "tabla Excel",
    //           "pdf": "documento PDF",
    //           "print": "Imprimir",
    //           "colvis": "Visibilidad columnas",
    //           "collection": "Colección",
    //           "upload": "Seleccione fichero...."
    //       },
    //       "select": {
    //           "rows": {
    //               _: '%d filas seleccionadas',
    //               0: 'clic fila para seleccionar',
    //               1: 'una fila seleccionada'
    //           }
    //       }
    //   }
    //  } );


    // $("#tablaArticulos").DataTable( {

    //     "scrollX": true,
    //     responsive: true

    //    } );

    $("#grupoCambio").change(function(){

         $.ajax({
              method: "POST",
              url: "../servicios/servicios.php",
              data: {
                  SSID: "GraficaGruposAlumno",
                 id_usuario: $("#id_usuario").val(),
                 id_grupo: $(this).val()
              },
              success: function (response) {
                  response = JSON.parse(response);
                  console.log(response);

                      Highcharts.chart('container', {
                          chart: {
                            type: 'area',
                                options3d: {
                                    enabled: true,
                                    alpha: 15,
                                    beta: 30,
                                    depth: 200
                                }
                          },
                          accessibility: {
                            description: ""
                          },
                          title: {
                            text: 'Califiaciones de las unidades'
                          },
                          subtitle: {
                            text: response.subtitle
                          },
                          xAxis: {

                            categories: ['','Reading', 'Writing', 'listening','Speaking',''],
                           title: {
                              text: 'SKILLS'
                            },
                          },
                          yAxis: {
                            title: {
                              text: 'SCORE'
                            },
                              min: 0,
                               max: 100,
                          },
                          tooltip: {
                            pointFormat: 'En la  {series.name} obtuviste  un  <b>{point.y:,.0f}</b><br/>de calificacion '
                          },
                          plotOptions: {
                          
                          },
                          series: response.datos
                        });

                }
          });

          $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                SSID: "obtenerUnidades",
                id_grupo: $("#grupoCambio").val(),
                id_usuario:$("#id_usuario").val()
            },
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $("#UnidadBol").html(response.cadena);
                $("#UnidadBol").change();

              }
          });
    });

    $("#UnidadBol").change(function(){

          $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                SSID: "boletasDatos",
                id_boleta: $(this).val()
            },
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $("#reading").html(response.reading);
                $("#writing").html(response.writing);
                $("#listening").html(response.listening);
                $("#spk").html(response.speaking);

                 $('[data-toggle="tooltip"]').tooltip();

              }
          });

            $.ajax({
                    method: "POST",
                    url: "../servicios/servicios.php",
                    data: {
                        SSID: "ObjetivosDatos",
                        id_grupo: $("#grupoCambio").val(),
                        numero: parseInt($("#UnidadBol option:selected").text())
                    },
                    success: function (response) {
                        response = JSON.parse(response);
                        console.log(response);
                        $("#objetivosAlumno").html(response.cadena);
                        

                      }
         });
    });

    $.ajax({
              method: "POST",
              url: "../servicios/servicios.php",
              data: {
                  SSID: "GraficaGruposAlumno",
                 id_usuario: $("#id_usuario").val(),
                 id_grupo: $("#grupoMayor").val()
              },
              success: function (response) {
                  response = JSON.parse(response);
                  console.log(response);


                      Highcharts.chart('container', {
                          chart: {
                            type: 'area',
                                options3d: {
                                    enabled: true,
                                    alpha: 15,
                                    beta: 30,
                                    depth: 200
                                }
                          },
                          accessibility: {
                            description: ""
                          },
                          title: {
                            text: 'Califiaciones de las unidades'
                          },
                          subtitle: {
                            text: response.subtitle
                          },
                          xAxis: {

                            categories: ['','Reading', 'Writing', 'listening','Speaking',''],
                           title: {
                              text: 'SKILLS'
                            },
                          },
                          yAxis: {
                            title: {
                              text: 'SCORE'
                            },
                               min: 0,
                               max: 100,
                          },
                          tooltip: {
                            pointFormat: 'En la  {series.name} obtuviste  un  <b>{point.y:,.0f}</b><br/>de calificacion '
                          },
                          plotOptions: {
                          
                          },
                          series: response.datos
                        });



                }
    });

    $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                SSID: "boletasDatos",
                id_boleta: $("#UnidadBol").val()
            },
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $("#reading").html(response.reading);
                $("#writing").html(response.writing);
                $("#listening").html(response.listening);

                $("#spk").html(response.speaking);
                 $('[data-toggle="tooltip"]').tooltip()

              }
    });

    $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                SSID: "ObjetivosDatos",
                id_grupo: $("#grupoMayor").val(),
                numero: parseInt($("#UnidadBol option:selected").text())
            },
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $("#objetivosAlumno").html(response.cadena);
                

              }
    });
 







    $('input[type=file]#nuestroinput1u').change(function(e){
            var archivos = $("#nuestroinput1u")[0].files.length;
            var filename = $(this).val().split('\\').pop();
            var idname = $(this).attr('id');
            console.log($(this));
            console.log(filename);
            console.log(idname);

            if(archivos == 0){
              $('span.'+idname).next().find('span').html("No se selecciono la imagen");
            }else{
              $('span.'+idname).next().find('span').html(filename);
            }

    });

    var datos;
   document.getElementById("nuestroinput1u").addEventListener("change", readFile);

   function readFile() {

      if (this.files && this.files[0]) {

        var FR= new FileReader();

        FR.addEventListener("load", function(e) {

          $("#datos").val(e.target.result);

          $("#imgTitulou").attr("src",e.target.result);

        });

        FR.readAsDataURL( this.files[0] );
      }

   }







    $("#EditarPeUs").click(function(){

    
             $.ajax({
              method: "POST",
              url: "../servicios/servicios.php",
              data: {
                  SSID: "datosUsuario",
                 id_usuario: $("#id_usuario").val(),
              },
              success: function (response) {
                  response = JSON.parse(response);
                  console.log(response);
                  datos = response.datos;

                  if(response.status=="100"){

                    
                    $("#correoeu").val(datos[0]["usuario_correo"]);
                    $("#nombreeu").val(datos[0]["usuario_nombre"]);
                    $("#apeu").val(datos[0]["usuario_ap_paterno"]);
                    $("#ameu").val(datos[0]["usuario_ap_materno"]);
                    $("#telefonoeu").val(datos[0]["usuario_telefono"]);
                    $("#imgTitulou").attr("src","../usuarios/"+datos[0]["usuario_ruta_foto"]);
                    $("#psweu").val("validado");
                    $("#psw2eu").val("validado");

                    $("#editarUsdu").appendTo("body").modal('show');

                  }



              },
              error: function (a) {
                  console.log(a );
              }
        });

    });

        $("#eusuario").click(function(){
        

          validar = 0;

          $(".formEu").each(function(){

              if($(this).val()==""){
                validar =1;

                $(this).css("border","1px solid red");

              }
          });

          if($("#psweu").val() != $("#psw2eu").val() ){
            validar = 2;
            $("#psw2eu").css("border","1px solid red");


           }

          if(validar==0){

             var formData = new FormData();
              var files = $('#nuestroinput1u')[0].files[0];
              formData.append('file',files);
              formData.append('SSID',"EUsuarioS");
              formData.append('usuario_telefono',$("#telefonoeu").val());
              formData.append('usuario_correo',$("#correoeu").val());
              formData.append('usuario_nombre',$("#nombreeu").val());
              formData.append('usuario_ap_paterno',$("#apeu").val());
              formData.append('usuario_ap_materno',$("#ameu").val());
              formData.append('usuario_password',$("#psweu").val());
              formData.append('id_usuario',$("#id_usuario").val());


              $.ajax({
                          method: "POST",
                          url: "../servicios/servicios.php",
                          data: formData,
                          processData:false,
                          contentType:false,
                          success: function (response) {
                              response = JSON.parse(response);
                              console.log(response);

                              if(response.status=="100"){

                                 swal("Atención", response.message, "success");
                                  setTimeout(function(){
                                    location.reload(true);
                                  }, 3000);


                              }else{
                                swal("Atención", response.message, "error");
                              }



                          },
                          error: function (a) {
                              console.log(a );
                          }
                    });

          }else if(validar == 2){
            swal("Atención", "Las Contraseñas deben ser identicas", "warning");
          }else if(validar == 1){
            swal("Atención", "Debe Ingresar todos los datos", "warning");
          }

        });

        



 });
</script>


 

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>User Report <small>Activity report</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left">
                <div class="profile_img">
                    <div id="crop-avatar">
                        <img style ="width: 100%; max-width: 100%;" class="img-responsive avatar-view" src="<?php echo " ../usuarios/".$_SESSION['usuario_ruta_foto']; ?>"alt="Avatar" title="Change the avatar">


                    </div>
                </div>
                <h3> <?php echo $_SESSION["usuario_nombre"]?></h3>
                <ul class="list-unstyled user_data">
                    <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $_SESSION["usuario_telefono"]?>
                    </li>
                    <li>
                        <i class="fa fa-envelope user-profile-icon"></i> <?php echo $_SESSION["usuario_correo"]?>
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-building user-profile-icon"></i> Alumno
                        
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-users user-profile-icon"></i> Grupo: Sabatino
                        
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-users user-profile-icon"></i> Curso: Basico-Intermedio
                        
                    </li>
                     <li class="m-top-xs">
                        <i class="fa fa-calendar user-profile-icon"></i> Fecha de inicio: 01/07/2021
                        
                    </li>

                </ul>
                <a id="EditarPeUs" class="btn btn-success" style="color: white;"><i class="fa fa-edit m-right-xs"></i>Editar Perfil </a>
                <br>
                <h4>Skills</h4>
                 <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Unidad</label>
                      <div class="col-md-8 col-sm-8">
                        <select class="form-control" id="UnidadBol">
                          <?php
                            $querybol = "SELECT boletas.boleta_id as 'boleta', boletas.boleta_unidad as 'unidad' FROM boletas INNER JOIN alumnos on boletas.boleta_id_alumno = alumnos.id_alumno WHERE alumnos.id_usuario =". $_SESSION['id_usuario']." and alumnos.id_grupo = ".$user1[0]["id_grupo"]." order by unidad";
                            $datosbol = pullQuery($querybol);

                            $aux = 0;

                            foreach ($datosbol as  $value) {
                              
                              if($aux == 0 ){
                              echo "<option selected value='".$value["boleta"]."'> ".$value["unidad"]." </option>";
                              }else{
                                echo "<option  value='".$value["boleta"]."'> ".$value["unidad"]." </option>";
                              }

                            $aux++;
                          }

                          ?>
                            
                        </select>
                    </div>
                  </div>

                <ul class="list-unstyled user_data">
                    <li>
                        <p>Reading</p>
                        <div class="progress progress_sm" id="reading">
                        </div>
                    </li>
                    <li>
                        <p>Writing</p>
                        <div class="progress progress_sm" id="writing">
                        </div>
                    </li>
                    <li>
                        <p>Listening</p>
                        <div class="progress progress_sm" id="listening">
                        </div>
                    </li>
                    <li>
                        <p> Speaking</p>
                        <div class="progress progress_sm" id="spk">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-9 ">
                <div class="profile_title">
                    <div class="col-md-6">
                        <h2>Seleccione un Grupo </h2>
                    </div>
                     <div class="col-md-6">
                        <div id="reportrange" class="pull-right" style="margin-top: 5px;  cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            <select id="grupoCambio">
                                
                               

                                <?php
                                      for ($i=0; $i < count($user1); $i++) {
                                ?>
                                <option value="<?php print($user1[$i]["id_grupo"]);  ?>"><?php print($user1[$i]['grupo']."--->".$user1[$i]['descripcion']); ?></option>

                                <?php
                                    
                                    }   
                                ?>
                            </select>
                        </div>
                    </div> 
                </div>
                <input type="hidden" name="" id="grupoMayor" value="<?php echo $user1[0]["id_grupo"]; ?>">
                <div id="graph_bar" class="containerCaja" style="width: 100%; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                          <div id="container"></div>
                         
                        

                </div>
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class=""><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Temas de aprendizaje</a>
                        </li>
                        <li role="presentation" class="active"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Boletas</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Objetivos de la unidad
                        </a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade " id="tab_content1" aria-labelledby="home-tab">
                            <ul class="messages">
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">03</h3>
                                        <p class="month">Jul</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Verbo To be </h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-error">21</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Pasado</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1" aria-hidden="true" data-icon=""></span>
                                            <a href="#" data-original-title="">Download</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">24</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Futuro</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-error">21</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Pronombres</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1" aria-hidden="true" data-icon=""></span>
                                            <a href="#" data-original-title="">Download</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane active" id="tab_content2" aria-labelledby="profile-tab">
                            <table id="tablaArticulos" class="table  table-hover nowrap text-center" style="width:100%">
                                <thead  >
                                    <tr class="headings text-align: -webkit-center">
                                        <th class="">#</th>
                                        <th class="">Grupo </th>
                                        <th class="">Tipo curso</th>
                                        <th class="">Nivel</th>
                                        <th class="">Maestro</th>
                                        <th class="text-center">Boleta</th>
                                    </tr>
                                </thead>
                                    <?php 
                                        $query = "SELECT grupos.id_grupo,  grupos.id_usuario as 'maestro', grupos.grupo_tipo_curso as 'grupo', grupos.grupo_descripcion as 'descripcion', niveles.nivel_descripcion as 'nivel' FROM `alumnos` INNER join grupos on alumnos.id_grupo = grupos.id_grupo INNER join niveles on niveles.id_nivel = grupos.id_nivel where alumnos.id_usuario = ".$_SESSION["id_usuario"];
                                        $user = pullQuery($query);
                                    ?>
                                <tbody>

                                    <?php
                                      for ($i=0; $i < count($user); $i++) {
                                    ?>
                                    <tr class="even pointer">
                                    <td><?php print($i+1); ?></td>
                                    <td><?php print($user[$i]['descripcion']); ?></td>
                                    <td><?php print($user[$i]['grupo']); ?></td>
                                    <td><?php print($user[$i]['nivel']); ?></td>
                                    <?php

                                        $queryM = "SELECT * from usuarios where id_usuario = ".$user[$i]['maestro'];
                                        $datosm = pullQuery($queryM);

                                    ?>
                                    <td><?php print($datosm[0]['usuario_nombre']." ".$datosm[0]['usuario_ap_paterno']." ".$datosm[0]['usuario_ap_materno']); ?></td>
                                    <td class="text-center">
                                      <button type="button" class="btn btn-success btn-xs editar" onclick="boletas(<?php print($user[$i]['id_grupo']); ?>)"><i class="fa fa-edit"> Ver Boleta</i></button>

                                    </td>

                                    <?php
                                       }
                                    ?>
                                   
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <ol class="list" id="objetivosAlumno">
                              <li data-emoji="🤪">Objetivo 1</li>
                              <li data-emoji="😴">Objetivo 2</li>    
                              <li data-emoji="🤠">Objetivo 3</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
 
 }

 if($_SESSION["tipo_usuaro"]=="Administrador"){


?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style type="text/css">
    
    #container {
      height: 400px; 
    }

    .highcharts-figure, .highcharts-data-table table {
      min-width: 310px; 
      max-width: 800px;
      margin: 1em auto;
    }

    .highcharts-data-table table {
      font-family: Verdana, sans-serif;
      border-collapse: collapse;
      border: 1px solid #EBEBEB;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }
    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
      padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
      padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }
</style>

<script type="text/javascript">
 $( function() {

     

    Highcharts.chart('container2', {
  chart: {
    type: 'pie',
    options3d: {
      enabled: true,
      alpha: 45
    }
  },
  title: {
    text: 'Ingresos por mes del 2021'
  },
  subtitle: {
    text: 'Ingresos en MXN  $'
  },
  plotOptions: {
    pie: {
      innerSize: 100,
      depth: 45
    }
  },
  series: [{
    name: 'Ingresos',
    data: [
      ['Enero', 5000],
      ['Febrero', 7000],
      ['Marzo', 11000],
      ['Abril', 15000],
      ['Mayo', 20000],
      ['Junio', 25000],
      ['Julio', 30000],
      ['Agosto', 0],
      ['Septiempre ', 0],
      ['Octubre ', 0],
      ['Noviembre ', 0],
      ['Diciembre ', 0]
    ]
  }]
});
       Highcharts.chart('container', {
      chart: {
        type: 'cylinder',
        options3d: {
          enabled: true,
          alpha: 15,
          beta: 15,
          depth: 50,
          viewDistance: 25
        }
      },
      title: {
        text: 'Alumnos por grupo'
      },
      plotOptions: {
        series: {
          depth: 0,
          colorByPoint: true
        }
      },
      series: [{
        data: [11,9,8,12,10],
        name: 'Alumnos',
        showInLegend: false
      }],
        xAxis: {

        categories: ['Grupo de Jorge','Sabatino', 'Grupo de luis', 'Grupo de norma','Grupo B2',''],
       title: {
          text: 'GRUPOS'
        },
      }
    });


    Highcharts.chart('container3', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: 0,
    plotShadow: false
  },
  title: {
    text: 'Porcentaje de<br>alumnos <br>aprobados',
    align: 'center',
    verticalAlign: 'middle',
    y: 60
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      dataLabels: {
        enabled: true,
        distance: -50,
        style: {
          fontWeight: 'bold',
          color: 'white'
        }
      },
      startAngle: -90,
      endAngle: 90,
      center: ['50%', '75%'],
      size: '110%'
    }
  },
  series: [{
    type: 'pie',
    name: 'Porcentaje de alumnos',
    innerSize: '50%',
    data: [
      ['Reprobados', 30 ],
      ['Aprobados',70 ],
      
      ]
  }]
});

});

</script>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>User Report <small>Activity report</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left">
                <div class="profile_img">
                    <div id="crop-avatar">
                        <img style ="width: 100%; max-width: 100%;" class="img-responsive avatar-view" src="<?php echo " ../usuarios/".$_SESSION['usuario_ruta_foto']; ?>"alt="Avatar" title="Change the avatar">


                    </div>
                </div>
                <h3> <?php echo $_SESSION["usuario_nombre"]?></h3>
                <ul class="list-unstyled user_data">
                    <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $_SESSION["usuario_telefono"]?>
                    </li>
                    <li>
                        <i class="fa fa-envelope user-profile-icon"></i> <?php echo $_SESSION["usuario_correo"]?>
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-building user-profile-icon"></i> Administrador
                        
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-users user-profile-icon"></i> Grupos: 5
                        
                    </li>

                     <li class="m-top-xs">
                        <i class="fa fa-calendar user-profile-icon"></i> Total de alumnos: 50
                        
                    </li>

                    <li class="m-top-xs">
                        <i class="fa fa-calendar user-profile-icon"></i> Total de maestros: 5
                        
                    </li>

                </ul>
                <a class="btn btn-success" style="color: white;"><i class="fa fa-edit m-right-xs"></i>Editar Perfil </a>
                <br>
                <h4>Datos generales</h4>
                <ul class="list-unstyled user_data" style="border:1px black solid; text-align: center;font-size: 15px;">
                    <li>
                        <p>Total de alumnos inscritos </p>
                        <p>50</p>
                    </li>
                    <li>
                        <p>Ingresos obtenidos </p>
                        <p>$100,000</p>
                    </li>
                    <li>
                        <p>Alumnos que no renovaron </p>
                        <p>5</p>
                    </li>
                    <li>
                        <p>Total de maestros inscritos</p>
                        <p>5</p>
                    </li>
                    <li>
                        <p>Total de grupos Nuevos</p>
                        <p>7</p>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-9 ">
                <div class="profile_title" style="border-radius: 10px 10px 10px 10px;-moz-border-radius: 10px 10px 10px 10px; -webkit-border-radius: 10px 10px 10px 10px;border: 0px solid #000000;">
                    <div class="col-md-6">
                        <h2>Seleccionar Año </h2>
                    </div>
                     <div class="col-md-6">
                        <div id="reportrange" class="pull-right" style="margin-top: 5px;  cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            <select class="">
                                <option value="1">2020</option>
                                <option value="2">2021</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div id="graph_bar" style="width: 100%; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                          <div id="container"></div>
                         
                        

                </div>
                <div>
                    <div id="container2"></div>
                </div>

                 <div>
                    <div id="container3"></div>
                </div>
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Temas de aprendizaje</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Boletas</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Objetivos de la unidad
                        </a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
                            <ul class="messages">
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">03</h3>
                                        <p class="month">Jul</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Verbo To be </h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-error">21</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Pasado</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1" aria-hidden="true" data-icon=""></span>
                                            <a href="#" data-original-title="">Download</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">24</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Futuro</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-error">21</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Pronombres</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1" aria-hidden="true" data-icon=""></span>
                                            <a href="#" data-original-title="">Download</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <table class="data table table-striped no-margin">
                                <thead>
                                    <tr>
                                        <th>Unidad </th>
                                        <th>Maestro</th>
                                        <th>Promedio</th>
                                        <th>Boleta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Jorge Luis Alvarez Carrillo</td>
                                        <td class="hidden-phone">9</td>
                                        <td class="vertical-align-mid">
                                           <button id="b1" class="btn btn-success">Ver boleta</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jorge Luis Alvarez Carrillo</td>
                                        <td class="hidden-phone">8</td>
                                        <td class="vertical-align-mid">
                                          <button id="b2" class="btn btn-success">Ver boleta</button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <ul class="list">
                              <li data-emoji="🤪">Objetivo 1</li>
                              <li data-emoji="😴">Objetivo 2</li>    
                              <li data-emoji="🤠">Objetivo 3</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }

    if($_SESSION["tipo_usuaro"]=="Maestro"){
?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style type="text/css">
    
    .highcharts-figure, .highcharts-data-table table {
      min-width: 320px; 
      max-width: 800px;
      margin: 1em auto;
    }

    #container {
      height: 450px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
      padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
      padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }

    li::marker {
      content: "😁"
    }

    li::marker {
      content: attr(data-emoji);
    }

    li:hover::marker {
      content: "🤯";
    }

    .list{
        font-size: 30px;
    }
</style>

<script type="text/javascript">
 $( function() {

       Highcharts.chart('container', {
      chart: {
        type: 'cylinder',
        options3d: {
          enabled: true,
          alpha: 15,
          beta: 15,
          depth: 50,
          viewDistance: 25
        }
      },
      title: {
        text: 'Alumnos por grupo'
      },
      plotOptions: {
        series: {
          depth: 0,
          colorByPoint: true
        }
      },
      series: [{
        data: [11,9,8,12,10],
        name: 'Alumnos',
        showInLegend: false
      }],
        xAxis: {

        categories: ['Grupo de Jorge','Sabatino', 'Grupo de luis', 'Grupo de norma','Grupo B2',''],
       title: {
          text: 'GRUPOS'
        },
      }
    });


    Highcharts.chart('container3', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: 0,
    plotShadow: false
  },
  title: {
    text: 'Porcentaje de<br>alumnos <br>aprobados',
    align: 'center',
    verticalAlign: 'middle',
    y: 60
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      dataLabels: {
        enabled: true,
        distance: -50,
        style: {
          fontWeight: 'bold',
          color: 'white'
        }
      },
      startAngle: -90,
      endAngle: 90,
      center: ['50%', '75%'],
      size: '110%'
    }
  },
  series: [{
    type: 'pie',
    name: 'Porcentaje de alumnos',
    innerSize: '50%',
    data: [
      ['Reprobados', 30 ],
      ['Aprobados',70 ],
      
      ]
  }]
});

 

 });
</script>




<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>User Report <small>Activity report</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left">
                <div class="profile_img">
                    <div id="crop-avatar">
                        <img style ="width: 100%; max-width: 100%;" class="img-responsive avatar-view" src="<?php echo " ../usuarios/".$_SESSION['usuario_ruta_foto']; ?>"alt="Avatar" title="Change the avatar">


                    </div>
                </div>
                <h3> <?php echo $_SESSION["usuario_nombre"]?></h3>
                <ul class="list-unstyled user_data">
                    <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $_SESSION["usuario_telefono"]?>
                    </li>
                    <li>
                        <i class="fa fa-envelope user-profile-icon"></i> <?php echo $_SESSION["usuario_correo"]?>
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-building user-profile-icon"></i> Maestro
                        
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-users user-profile-icon"></i> Grupo: Sabatino
                        
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-users user-profile-icon"></i> Curso: Basico-Intermedio
                        
                    </li>
                     <li class="m-top-xs">
                        <i class="fa fa-calendar user-profile-icon"></i> Fecha de inicio: 01/07/2021
                        
                    </li>

                </ul>
                <a class="btn btn-success" style="min-width: 250px; max-width: 250px; color: white;"><i class="fa fa-edit m-right-xs"></i>Editar Perfil </a>
                <br>

                <a class="btn btn-primary" style="min-width: 250px; max-width: 250px; color: white;"><i class="fa fa-edit m-right-xs"></i>Añadir  Tema de aprendizaje </a>
                <br>

                 <a class="btn btn-dark" style="min-width: 250px; max-width: 250px; color: white;"><i class="fa fa-edit m-right-xs"></i>Añadir objetivos de  unidad</a>
                <br>
                <h4>Skills</h4>
                <ul class="list-unstyled user_data">
                    <li>
                        <p>Reading</p>
                        <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50" style="width: 50%;" aria-valuenow="49"></div>
                        </div>
                    </li>
                    <li>
                        <p>Writing</p>
                        <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70" style="width: 70%;" aria-valuenow="69"></div>
                        </div>
                    </li>
                    <li>
                        <p>Listening</p>
                        <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30" style="width: 30%;" aria-valuenow="29"></div>
                        </div>
                    </li>
                    <li>
                        <p> Speaking</p>
                        <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50" style="width: 50%;" aria-valuenow="49"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-9">
                <div class="profile_title">
                    <div class="col-md-6">
                        <h2>Seleccionar Grupo </h2>
                    </div>
                     <div class="col-md-6">
                        <div id="reportrange" class="pull-right" style="margin-top: 5px;  cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            <select class="">
                                <option value="1">Grupo 1</option>
                                <option value="2">Grupo 2</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div id="graph_bar" style="width: 100%; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                          <div id="container"></div>
                         
                        

                </div>

                <div>
                    <div id="container3"></div>
                </div>
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Temas de aprendizaje</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Boletas</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Objetivos de la unidad
                        </a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
                            <ul class="messages">
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">03</h3>
                                        <p class="month">Jul</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Verbo To be </h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-error">21</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Pasado</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1" aria-hidden="true" data-icon=""></span>
                                            <a href="#" data-original-title="">Download</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">24</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Futuro</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <img src="../img/logo_blanco.png" style="background: black;" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-error">21</h3>
                                        <p class="month">May</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">Pronombres</h4>
                                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                        <br>
                                        <p class="url">
                                            <span class="fs1" aria-hidden="true" data-icon=""></span>
                                            <a href="#" data-original-title="">Download</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <table class="data table table-striped no-margin">
                                <thead>
                                    <tr>
                                        <th>Unidad </th>
                                        <th>Maestro</th>
                                        <th>Promedio</th>
                                        <th>Boleta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Jorge Luis Alvarez Carrillo</td>
                                        <td class="hidden-phone">9</td>
                                        <td class="vertical-align-mid">
                                           <button id="b1" class="btn btn-success">Ver boleta</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jorge Luis Alvarez Carrillo</td>
                                        <td class="hidden-phone">8</td>
                                        <td class="vertical-align-mid">
                                          <button id="b2" class="btn btn-success">Ver boleta</button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <ul class="list">
                              <li data-emoji="🤪">Objetivo 1</li>
                              <li data-emoji="😴">Objetivo 2</li>    
                              <li data-emoji="🤠">Objetivo 3</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
}

?>
