<?php

  //librerias
  require($_SERVER['DOCUMENT_ROOT']."/box/const/const.lib.php");
  require($_SERVER['DOCUMENT_ROOT']."/box/base/base.lib.php");


$query = "SELECT * FROM categorias where categoria_estatus = '1'";
$categorias = pullQuery($query);

$subquery = "SELECT * FROM subcategorias where subcategoria_estatus = '1'";
$subcategorias = pullQuery($subquery);

$permisos = "SELECT * from permisos where permiso_estatus = '1'";
$datosperm = pullQuery($permisos);



$cadena = "<option selected disabled> Seleccione una opción ... </option>";

  foreach ($categorias as  $value) {

     $cadena = $cadena. "<option value='".$value["id_categoria"]."' >".$value["categoria_nombre"]."</option>";


  }

  $cadenaperm = "<option selected disabled> Seleccione una opción ... </option>";

  foreach ($datosperm as  $value) {

     $cadenaperm = $cadenaperm. "<option value='".$value["id_permiso"]."' >".$value["permiso_descripcion"]."</option>";


  }

  $queryTipo = "SELECT * from tipo_usuarios ";
  $datosP = pullQuery($queryTipo);


  $cadenaTipo = "<option selected disabled> Seleccione una opción ... </option>";

  foreach ($datosP as  $value) {

  $cadenaTipo = $cadenaTipo. "<option value='".$value["id_tipo_usuario"]."' >".$value["tipo_usuario_descripcion"]."</option>";

  }



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

      input[type="file"]#nuestroinput1 {
                    width: 0.1px;
                    height: 0.1px;
                    opacity: 0;
                    overflow: hidden;
                    position: absolute;
                    z-index: -1;
                 }

    label[for="nuestroinput1"] {
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
<script type="text/javascript">
   $( function() {

    $('input[type=file]#nuestroinput1').change(function(e){
            var archivos = $("#nuestroinput1")[0].files.length;
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
   document.getElementById("nuestroinput1").addEventListener("change", readFile);

   function readFile() {

      if (this.files && this.files[0]) {

        var FR= new FileReader();

        FR.addEventListener("load", function(e) {

          $("#datos").val(e.target.result);

          $("#imgTitulo").attr("src",e.target.result);

        });

        FR.readAsDataURL( this.files[0] );
      }

    }


      //When page loads...
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


    $("#permisos").select2({
                    width: '100%'
    });


    $("#nusuario").click(function(){

      $("#nuevoUsuario").appendTo("body").modal('show');
    });

    $(".formU").on("click",function(){
         $(this).removeAttr("style");

    });

     $("#gusuario").click(function(){

        
                // swal("Listos","Datos guardados","success");

                    $.ajax({
                            method: "POST",
                            url: "../servicios/servicios.php",
                            data: {
                                SSID: "guardarUsuario2",
                                usuario_nombre: $("#usuario_nombre").val(),
                                usuario_ap_paterno: $("#usuario_ap_paterno").val(),
                                usuario_ap_materno: $("#usuario_ap_materno").val(),
                                usuario_fecha_nacimiento: $("#usuario_fecha_nacimiento").val(),
                                usuario_correo: $("#usuario_correo").val(),
                                usuario_telefono: $("#usuario_telefono").val(),
                                password: $("#password").val(),
                                id_tipo_usuario: $("#id_tipo_usuario").val()

                            },
                            success: function (response) {
                                response = JSON.parse(response);
                                console.log(response);

                                if(response.status=="100"){
                                  swal("Maestro Almacenando","Exito","success");
                                       setTimeout(function(){
                                    location.reload();
                                  }, 3000);

                                   // swal("Se registro correctamente","Te mandamos un correo a "+$("#Email").val()+" valida el correo que te mandamos para terminar el registro","success");
                                }
                                
                                    
                                    
                            },
                            error: function (a) { 
                                console.log(a );
                             }
                    });

      });


    $("#gpermisos").click(function(){

      if($("#permisos").val()==null){

        swal("Atención","Debe selecionar por lo menos un permiso por usuario","warning");
      }else{

        permiso = $("#permisos").val();

        $.ajax({
                      method: "POST",
                      url: "../servicios/servicios.php",
                      data: {
                          SSID: "npermisos",
                         id_usuario: $("#id_usuario").val() ,
                         permiso:permiso
                      },
                      success: function (response) {
                          response = JSON.parse(response);
                          console.log(response);
                          datos = response.datos;
                          if(response.status=="100"){

                          swal("Atención",response.message,"success", {
                                buttons: {
                                aceptar: true
                                  },
                                })
                                .then((value) => {
                                  switch (value) {

                                case "aceptar":
                                   $("#permisosmod").modal('toggle');
                                  break;
                                  }
                                });



                          }else{
                            swal("Atención", response.message, "error");
                          }

                      },
                      error: function (a) {
                          console.log(a );
                      }
                });
      }


    });

    $("#eusuario").click(function(){

          validar = 0;

          $(".formUe").each(function(){

              if($(this).val()==""){
                validar =1;

                $(this).css("border","1px solid red");

              }
          });

          if($("#pswe").val() != $("#psw2e").val() ){
            validar = 2;
            $("#psw2e").css("border","1px solid red");


           }

          if(validar==0){

             var formData = new FormData();
              var files = $('#nuestroinput1')[0].files[0];
              formData.append('file',files);
              formData.append('SSID',"EUsuario");
              formData.append('usuario_telefono',$("#telefonoe").val());
              formData.append('usuario_correo',$("#correoe").val());
              formData.append('usuario_nombre',$("#nombree").val());
              formData.append('usuario_ap_paterno',$("#ape").val());
              formData.append('usuario_ap_materno',$("#ame").val());
              formData.append('usuario_password',$("#pswe").val());
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
                                    location.reload();
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



  function editar(id){

    $("#id_usuario").val(id);

     $.ajax({
              method: "POST",
              url: "../servicios/servicios.php",
              data: {
                  SSID: "datosUsuario",
                 id_usuario:id
              },
              success: function (response) {
                  response = JSON.parse(response);
                  console.log(response);
                  datos = response.datos;

                  if(response.status=="100"){

                    
                    $("#correoe").val(datos[0]["usuario_correo"]);
                    $("#nombree").val(datos[0]["usuario_nombre"]);
                    $("#ape").val(datos[0]["usuario_ap_paterno"]);
                    $("#ame").val(datos[0]["usuario_ap_materno"]);
                    $("#telefonoe").val(datos[0]["usuario_telefono"]);
                    $("#imgTitulo").attr("src","../usuarios/"+datos[0]["usuario_ruta_foto"]);
                    $("#pswe").val("validado");
                    $("#psw2e").val("validado");

                    $("#editarUsuario").appendTo("body").modal('show');

                  }



              },
              error: function (a) {
                  console.log(a );
              }
        });

  }

  function desactivaUsuario(id){

     swal({
            title: "Se requiere confirmación",
            text: "Una ves desactivado el usuario no podra acceder al sistema",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["Cancelar", "Confirmar"]
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                      method: "POST",
                      url: "../servicios/servicios.php",
                      data: {
                          SSID: "desUsuario",
                         id_usuario:id
                      },
                      success: function (response) {
                          response = JSON.parse(response);
                          console.log(response);
                          datos = response.datos;
                          if(response.status=="100"){

                             swal("Atención", response.message, "success");
                              setTimeout(function(){
                                location.reload();
                              }, 3000);


                          }else{
                            swal("Atención", response.message, "error");
                          }

                      },
                      error: function (a) {
                          console.log(a );
                      }
                });

            } else {
              swal("Se cancelo la operación");
            }
          });

  }

  function eliminar(id){

      swal({
            title: "Se requiere confirmación",
            text: "Una ves eliminado el usuario no aparecera en el sistema",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["Cancelar", "Confirmar"]
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                      method: "POST",
                      url: "../servicios/servicios.php",
                      data: {
                          SSID: "elimUsu",
                         id_usuario:id
                      },
                      success: function (response) {
                          response = JSON.parse(response);
                          console.log(response);
                          datos = response.datos;
                          if(response.status=="100"){

                             swal("Atención", response.message, "success");
                              setTimeout(function(){
                                location.reload();
                              }, 3000);


                          }else{
                            swal("Atención", response.message, "error");
                          }

                      },
                      error: function (a) {
                          console.log(a );
                      }
                });

            } else {
              swal("Se cancelo la operación");
            }
          });

  }

  function activarUsuario(id){

     swal({
            title: "Se requiere confirmación",
            text: "Una ves activado el usuario podrá acceder al sistema",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["Cancelar", "Confirmar"]
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                      method: "POST",
                      url: "../servicios/servicios.php",
                      data: {
                          SSID: "actUsuario",
                         id_usuario:id
                      },
                      success: function (response) {
                          response = JSON.parse(response);
                          console.log(response);
                          datos = response.datos;
                          if(response.status=="100"){

                             swal("Atención", response.message, "success");
                              setTimeout(function(){
                                location.reload();
                              }, 3000);


                          }else{
                            swal("Atención", response.message, "error");
                          }

                      },
                      error: function (a) {
                          console.log(a );
                      }
                });

            } else {
              swal("Se cancelo la operación");
            }
          });

  }

  function permisos(id){

    $("#id_usuario").val(id);
      $.ajax({
                      method: "POST",
                      url: "../servicios/servicios.php",
                      data: {
                          SSID: "permisosusua",
                         id_usuario:id
                      },
                      success: function (response) {
                          response = JSON.parse(response);
                          console.log(response);
                          datos = response.datos;
                          if(response.status=="100"){

                             $("#permisos").html(response.cadena);
                             $("#id_usuario").val(id);


                          }else{
                            swal("Atención", response.message, "error");
                          }

                      },
                      error: function (a) {
                          console.log(a );
                      }
                });

     $("#permisosmod").appendTo("body").modal('show');

  }


</script>

<script type="text/javascript">
   $( function() {

      $.extend( true, $.fn.dataTable.defaults, {
      "language": {
          "decimal": ",",
          "thousands": ".",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoPostFix": "",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "loadingRecords": "Cargando...",
          "lengthMenu": "Mostrar _MENU_ registros",
          "paginate": {
              "first": "Primero",
              "last": "Último",
              "next": "Siguiente",
              "previous": "Anterior"
          },
          "processing": "Procesando...",
          "search": "Buscar:",
          "searchPlaceholder": "Término de búsqueda",
          "zeroRecords": "No se encontraron resultados",
          "emptyTable": "Ningún dato disponible en esta tabla",
          "aria": {
              "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sortDescending": ": Activar para ordenar la columna de manera descendente"
          },
          //only works for built-in buttons, not for custom buttons
          "buttons": {
              "create": "Nuevo",
              "edit": "Cambiar",
              "remove": "Borrar",
              "copy": "Copiar",
              "csv": "fichero CSV",
              "excel": "tabla Excel",
              "pdf": "documento PDF",
              "print": "Imprimir",
              "colvis": "Visibilidad columnas",
              "collection": "Colección",
              "upload": "Seleccione fichero...."
          },
          "select": {
              "rows": {
                  _: '%d filas seleccionadas',
                  0: 'clic fila para seleccionar',
                  1: 'una fila seleccionada'
              }
          }
      }
     } );



    $("#tablaArticulos").DataTable( {

        "scrollX": true,
        responsive: true

       } );


     });

</script>

<div class="clearfix"></div>
<div class="row">
 <div class="col-md-12 col-sm-12  ">
   <div class="x_panel">
     <div class="x_title">
       <h2>Administración de Maestros </h2>
       <ul class="nav navbar-right panel_toolbox">
         <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
         </li>

         <li><a class="close-link"><i class="fa fa-close"></i></a>
         </li>
       </ul>
       <div class="clearfix"></div>
     </div>
     <div class="x_content">
    <!--  <button type="button" id="nusuario" class="btn btn-dark">Nuevo usuario </button> -->
      <table id="tablaArticulos"  class="table  table-hover nowrap text-center" style="width:100%">
          <thead>
            <tr class="headings">
              <th>Nombre</th>
              <th>Tipo usuario</th>
              <th>Correo</th>
              <th>Télefono</th>
              <th>Fecha de creación </th>
              <th>Estatus</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <?php
            $query = "SELECT * FROM usuarios  inner join  tipo_usuarios on usuarios.id_tipo_usuario = tipo_usuarios.id_tipo_usuario  where usuarios.usuario_borrado = 1  and usuarios.id_tipo_usuario = 2";
            $user = pullQuery($query);
          ?>
          <tbody>
            <?php
              for ($i=0; $i < count($user); $i++) {
            ?>
            <tr class="even pointer">

              <td><?php print("<div style= 'text-align: -webkit-center;'> <img  style='width: 80px; height: 80px; display: block; alt='imagen alternativa'; src="."../usuarios/".$user[$i]['usuario_ruta_foto']."></div>"); ?><?php print($user[$i]['usuario_nombre']." ".$user[$i]['usuario_ap_paterno']." ".$user[$i]['usuario_ap_materno']); ?></td>
              <td><?php print($user[$i]['tipo_usuario_descripcion']); ?></td>
              <td><?php print($user[$i]['usuario_correo']); ?></td>
              <td> <?php print($user[$i]['usuario_telefono']); ?></td>

              <td class="imagenTabla"><?php print(date("Y/m/d",strtotime($user[$i]["usuario_fecha_creacion"]))); ?></td>

              <td >
                <?php
                  if ($user[$i]['usuario_estatus']==1) {
                    print('<p class="label  activo">Habilitado </p>');
                  } elseif($user[$i]['usuario_estatus']==0) {
                    print('<p class="label desactivo" >Inhabilitado </p>');
                  }
                ?>
              </td>

              <td class="text-center">
                <button type="button" class="btn btn-primary btn-xs editar" onclick="editar(<?php print($user[$i]['id_usuario']); ?>)"><i class="fa fa-edit"> Editar</i></button>
                <?php
                  if ($user[$i]['usuario_estatus']==1) {
                ?>
                <button type="button" class="btn btn-secondary btn-xs" onclick="desactivaUsuario(<?php print($user[$i]['id_usuario']); ?>)"><i class="fa fa-lock"> Desabilitar </i></button>
                <?php
              }elseif ($user[$i]['usuario_estatus']==0) {
                ?>
                <button type="button" class="btn btn-info btn-xs" onclick="activarUsuario(<?php print($user[$i]['id_usuario']); ?>)"><i class="fa fa-unlock"> Activar</i></button>
                <?php
                  }
                ?>
                
                <button type="button" class="btn btn-success btn-xs" onclick="permisos(<?php print($user[$i]['id_usuario']); ?>)"><i class="fa fa-cog"> Permisos</i></button>
                <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php print($user[$i]['id_usuario']); ?>)"><i class="fa fa-trash"> Eliminar</i></button>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
      </table>
     </div>
   </div>
 </div>
</div>

<input type="hidden" id="id_usuario">


<div class="modal fade" id="nuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Maestro </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

               <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre(s)  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="usuario_nombre">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Apellido Paterno  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="usuario_ap_paterno">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Apellido Materno  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="usuario_ap_materno">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Correo  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="usuario_correo">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Telefono  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="usuario_telefono">
            </div>
          </div>
           <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha de nacimiento  </label>
              <div class="col-md-9 col-sm-9">
                <input type="date" class="form-control formUe" id="usuario_fecha_nacimiento">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo de usuario  </label>
              <div class="col-md-9 col-sm-9">
                <select id="id_tipo_usuario" class="form-control" >
                  <option selected value="2">Maestro</option>
                </select>
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Contraseña  </label>
              <div class="col-md-9 col-sm-9">
                <input type="password" class="form-control formUe" id="psw" placeholder="">
                <input type="password" class="form-control formUe" id="psw2" placeholder="Repetir Contraseña">
            </div>
          </div>
      
   
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="gusuario">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <input type="text" class="form-control formUe" id="nombree">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Apellido Paterno  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="ape">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Apellido Materno  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="ame">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Correo  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="correoe">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Telefono  </label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control formUe" id="telefonoe">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Contraseña  </label>
              <div class="col-md-9 col-sm-9">
                <input type="password" class="form-control formUe" id="pswe" placeholder="">
                <input type="password" class="form-control formUe" id="psw2e" placeholder="Repetir Contraseña">
            </div>
          </div>
            </div>
            <div class="tab_content text-center" id="tab2">
             
                        <p style="color:black;">
                         Seleccione una foto de perfil
                        </p>

                        <span class="nuestroinput1" style="">
                         <input id="nuestroinput1" name="nuestroinput1" type="file"  accept="image/*"   >
                       </span>
                       <label for="nuestroinput1">
                           <span> <i class="fa fa-upload"></i>  &nbsp;  seleccionar  </span>
                       </label>

                       <div class="divImg" ><img  style="width: 200px; height: 200px;" id="imgTitulo" src="" alt=""></div>
            </div>
        </div>

     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="eusuario">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="permisosmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Permisos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Seleccione o eliminine los permisos que desea otorgar o rebocar según corresponda</p>
        <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Permisos </label>
            <div class="col-md-9 col-sm-9">
              <select name="" id="permisos" multiple="multiple" ><?php  echo $cadenaperm; ?> </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="gpermisos">Guardar</button>
      </div>
    </div>
  </div>
</div>