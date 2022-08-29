<?php

  //librerias
  require($_SERVER['DOCUMENT_ROOT']."/box/const/const.lib.php");
  require($_SERVER['DOCUMENT_ROOT']."/box/base/base.lib.php");


  $queryMaestros ="SELECT * from usuarios where (id_tipo_usuario = 2 or id_tipo_usuario = 3) and usuario_estatus = 1 and usuario_borrado  = 1 ";
  $datosMaestros = pullQuery($queryMaestros);

  $queryNiveles = "SELECT * from niveles ";
  $datosNiveles = pullQuery($queryNiveles);

  $queryAlum = "SELECT * FROM usuarios where id_tipo_usuario = 1 and usuario_estatus = 1 and usuario_borrado  = 1 and usuario_verificado = 1 ";
  $datosAlum = pullQuery($queryAlum);


  $cadenaUsuarios = "<option selected disabled> Seleccione una opción ... </option>";
  $cadenaNiveles = "<option selected disabled> Seleccione una opción ... </option>";
  $cadenaAlumnos = "<option  disabled> Seleccione alumnos ... </option>";


  foreach ($datosMaestros as $value) {
   
   $cadenaUsuarios = $cadenaUsuarios. "<option value='".$value["id_usuario"]."' >".$value['usuario_nombre']." ".$value['usuario_ap_paterno']." ".$value['usuario_ap_materno']."</option>";

  }

  foreach ($datosNiveles as $value) {
   
   $cadenaNiveles = $cadenaNiveles. "<option value='".$value["id_nivel"]."' >".$value['nivel_descripcion']."</option>";

  }


   foreach ($datosAlum as $value) {
   
   $cadenaAlumnos = $cadenaAlumnos.  "<option value='".$value["id_usuario"]."' >".$value['usuario_nombre']." ".$value['usuario_ap_paterno']." ".$value['usuario_ap_materno']."</option>";

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


<div class="clearfix"></div>
<div class="row">
 <div class="col-md-12 col-sm-12  ">
   <div class="x_panel">
     <div class="x_title">
       <h2>Administración de Grupos </h2>
       <ul class="nav navbar-right panel_toolbox">
         <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
         </li>

         <li><a class="close-link"><i class="fa fa-close"></i></a>
         </li>
       </ul>
       <div class="clearfix"></div>
     </div>
     <div class="x_content">
     <button type="button" id="nusuario" class="btn btn-dark">Nuevo grupo </button>
      <table id="tablaGrupos"  class="table  table-hover nowrap text-center" style="width:100%">
          <thead>
            <tr class="headings">
              <th>Descripción  del grupo</th>
              <th>Maestro Asignado </th>
              <th>Nivel del grupo  </th>
               <th>Tipo de curso  </th>
              <th>Fecha de Creación</th>
              <th>Total de alumnos </th>
              <th>Estatus</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <?php
            $query = "SELECT * FROM grupos   inner join  usuarios on usuarios.id_usuario  = grupos.id_usuario inner join niveles on niveles.id_nivel = grupos.id_nivel  where grupos.grupo_borrado = 1 ";
            $user = pullQuery($query);
          ?>
          <tbody>
            <?php
              for ($i=0; $i < count($user); $i++) {
            ?>
            <tr class="even pointer">

              <td><?php print($user[$i]['grupo_descripcion']); ?></td>
              <td> <?php print($user[$i]['usuario_nombre']." ".$user[$i]['usuario_ap_paterno']." ".$user[$i]['usuario_ap_materno']); ?></td>
             
              <td><?php print($user[$i]['nivel_descripcion']); ?></td>


              <td><?php print($user[$i]['grupo_tipo_curso']); ?></td>
            
              <td class="imagenTabla"><?php print(date("Y/m/d",strtotime($user[$i]["grupo_fecha_creacion"]))); ?></td>

              <td><?php 
                        $queryAlumnos = "SELECT COUNT(*) from alumnos where id_grupo = ".$user[$i]["id_grupo"]." and alumno_estatus = 1";
                        $alumnos = pullQuery($queryAlumnos);

                        print( $alumnos[0]["COUNT(*)"]." Alumnos");

              ?></td>

              <td >
                <?php
                  if ($user[$i]['grupo_estatus']==1) {
                    print('<p class="label  activo">Habilitado </p>');
                  } elseif($user[$i]['grupo_estatus']==0) {
                    print('<p class="label desactivo" >Inhabilitado </p>');
                  }
                ?>
              </td>

              <td class="text-center">
                <button type="button" class="btn btn-primary btn-xs editar" onclick="editar(<?php print($user[$i]['id_grupo']); ?>)"><i class="fa fa-edit"> Editar</i></button>
                <?php
                  if ($user[$i]['grupo_estatus']==1) {
                ?>
                <button type="button" class="btn btn-secondary btn-xs" onclick="desactivaUsuario(<?php print($user[$i]['id_grupo']); ?>)"><i class="fa fa-lock"> Desabilitar </i></button>
                <?php
              }elseif ($user[$i]['grupo_estatus']==0) {
                ?>
                <button type="button" class="btn btn-info btn-xs" onclick="activarUsuario(<?php print($user[$i]['id_grupo']); ?>)"><i class="fa fa-unlock"> Activar</i></button>
                <?php
                  }
                ?>
                
                <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php print($user[$i]['id_grupo']); ?>)"><i class="fa fa-trash"> Eliminar</i></button>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Grupo </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Descripción del grupo  </label>
          <div class="col-md-9 col-sm-9">
            <input type="text" class="form-control formU" id="grupo_descripcion">
        </div>
      </div>
      <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Maestro Responsable </label>
          <div class="col-md-9 col-sm-9">
            <select  class="form-control formU select" id="id_usuario"> 
              <?php
                echo $cadenaUsuarios;
              ?>

            </select>
        </div>
      </div>
      <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nivel del grupo </label>
          <div class="col-md-9 col-sm-9">
            <select  class="form-control formU select" id="id_nivel"> 
              <?php
                echo $cadenaNiveles;
              ?>

            </select>
        </div>
      </div>
      <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo de curso </label>
          <div class="col-md-9 col-sm-9">
            <select  class="form-control formU select" id="tipo_curso"> 
             <option selected disabled value="0">Seleccione una opción</option>
             <option value="Semi intensivo">Semi intensivo</option>
             <option value="Intensivo">Intensivo</option>
             <option value="Super intensivo"> Super intensivo</option>
             <option value="Sabatino">Sabatino</option>
             <option value="Conversation club">Conversation club</option>
             <option value="Kids">Kids</option>

            </select>
        </div>
      </div>
       <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alumnos</label>
          <div class="col-md-9 col-sm-9">
            <select  class="form-control formU select" id="alumnos" name="alumnos[]" multiple="multiple"> 
              <?php
                echo $cadenaAlumnos;
              ?>

            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="gusuario">Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="nuevoUsuariomod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Grupo </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Descripción del grupo  </label>
          <div class="col-md-9 col-sm-9">
            <input type="text" class="form-control formU" id="grupo_descripcionm">
        </div>
      </div>
      <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Maestro Responsable </label>
          <div class="col-md-9 col-sm-9">
            <select  class="form-control formU select" id="id_usuariom"> 
              

            </select>
        </div>
      </div>
      <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nivel del grupo </label>
          <div class="col-md-9 col-sm-9">
            <select  class="form-control formU select" id="id_nivelm"> 
             

            </select>
        </div>
      </div>
       <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alumnos</label>
          <div class="col-md-9 col-sm-9">
            <select  class="form-control formU select" id="alumnosm" name="alumnosm[]" multiple="multiple"> 
              

            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="gusuariom">Guardar</button>
      </div>
    </div>
  </div>
</div>



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



    $("#tablaGrupos").DataTable( {

        "scrollX": true,
        responsive: true

       } );

     });


   $("#nusuario").click(function(){

      $("#nuevoUsuario").appendTo("body").modal('show');
    });

   $('.select').select2({
                    width: '100%',
                    placeholder: 'Seleccione una opción'
    });


   $("#gusuario").click(function(){


      if($("#grupo_descripcion").val()==""){

        $("#grupo_descripcion").css("border","red solid 1px");
        swal("Atención", "Agregue una Descripción", "error");

        return;


      }

      if($("#id_usuario").select2('val')==null){

        $("#id_usuario").css("border","red solid 1px");
        swal("Atención", "Seleccione un Maestro", "error");

        return;

        
      }

      if($("#id_nivel").select2('val')==null){

        $("#id_nivel").css("border","red solid 1px");
        swal("Atención", "Seleccione un nivel", "error");

        return;

        
      }

      alumnos = $("#alumnos").val();

      if(alumnos.length <2 ){

        swal("Atención", "Debe Seleccione al menos 2 alumnos", "error");

        return;


      }



 

            $.ajax({
                        method: "POST",
                        url: "../servicios/servicios.php",
                        data: {
                            SSID: "guardarGrupo",
                            grupo_descripcion:$("#grupo_descripcion").val(),
                           id_usuario:$("#id_usuario").select2('val'),
                           id_nivel:$("#id_nivel").select2('val'),
                           grupo_tipo_curso: $("#tipo_curso").select2('val'),
                           alumnos: alumnos
                        },
                        success: function (response) {
                            console.log(response);
                            response = JSON.parse(response);
                            console.log(response);
                           
                            if(response.status=="100"){

                               swal("Exito!", "Grupo guardado", "success");
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

   });

   $("#gusuariom").click(function(){

     if($("#grupo_descripcionm").val()==""){

        $("#grupo_descripcionm").css("border","red solid 1px");
        swal("Atención", "Agregue una Descripción", "error");

        return;


      }

      if($("#id_usuariom").select2('val')==null){

        $("#id_usuario").css("border","red solid 1px");
        swal("Atención", "Seleccione un Maestro", "error");

        return;

        
      }

      if($("#id_nivelm").select2('val')==null){

        $("#id_nivelm").css("border","red solid 1px");
        swal("Atención", "Seleccione un nivel", "error");

        return;

        
      }

      alumnosm = $("#alumnosm").val();

      if(alumnosm.length <2 ){

        swal("Atención", "Debe Seleccione al menos 2 alumnos", "error");

        return;


      }

      $.ajax({
                        method: "POST",
                        url: "../servicios/servicios.php",
                        data: {
                            SSID: "editarGrupo",
                            grupo_descripcion:$("#grupo_descripcionm").val(),
                           id_usuario:$("#id_usuariom").select2('val'),
                           id_nivel:$("#id_nivelm").select2('val'),
                           alumnos: alumnosm,
                           id_grupo: $("#id_usuario").val()
                        },
                        success: function (response) {
                            console.log(response);
                            response = JSON.parse(response);
                            console.log(response);
                           
                            if(response.status=="100"){

                               swal("Exito!", "Edición guardada", "success");
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



  });




    function desactivaUsuario(id){

       swal({
              title: "Se requiere confirmación",
              text: "Una ves desactivado el grupo no se visualizara en el sistema a los Maestros",
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
                            SSID: "desGrupo",
                           id_grupo:id
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
              text: "Una ves activado el grupo volvera a ser visible para los Maestros",
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
                            SSID: "actGrupo",
                           id_grupo:id
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


    function editar(id){

     $("#id_usuario").val(id);

     $.ajax({
              method: "POST",
              url: "../servicios/servicios.php",
              data: {
                  SSID: "datosGrupo",
                 id_grupo:id
              },
              success: function (response) {
                  response = JSON.parse(response);
                  console.log(response);
                  datos = response.datos;

                  if(response.status=="100"){

                    
                    $("#grupo_descripcionm").val(datos[0]["grupo_descripcion"]);
                    $("#id_usuariom").html(response.maestros);
                    $("#id_nivelm").html(response.niveles);
                    $("#alumnosm").html(response.alumnos);
                    $
                     $('#alumnosm').select2({
                         width: '100%',
                         placeholder: 'Seleccione una opción'
                      });
                    $("#nuevoUsuariomod").appendTo("body").modal('show');

                  }



              },
              error: function (a) {
                  console.log(a );
              }
        });

    }


    function eliminar(id){

      swal({
            title: "Se requiere confirmación",
            text: "Una ves eliminado el grupo no aparecera en el sistema",
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
                          SSID: "eiminargrupo",
                         id_grupo:id
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


  

</script>