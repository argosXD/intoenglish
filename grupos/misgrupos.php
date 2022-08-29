<?php

  //librerias
  require($_SERVER['DOCUMENT_ROOT']."/box/const/const.lib.php");
  require($_SERVER['DOCUMENT_ROOT']."/box/base/base.lib.php");




  $queryGrupos = "SELECT * from grupos where id_usuario = ".$_SESSION["id_usuario"]." and grupo_estatus =1 and grupo_borrado = 1";
  $datos = pullQuery($queryGrupos);

  $cadenaGrupos= "<option selected disabled>  Seleccione un Grupo ... </option>";


 foreach ($datos as  $value) {
  	   
  	 $cadenaGrupos = $cadenaGrupos. "<option value='".$value["id_grupo"]."' >".$value['grupo_descripcion']."</option>";

 }


?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left; width: 20px; text-align: center;}
h5{
  padding-top: 15px;
}

.stepContainer{
  height: auto !important;
}
</style>

<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<input type="hidden" name="" id="idalumno">

<div class="clearfix"></div>
<div class="row">
 <div class="col-md-12 col-sm-12  ">
   <div class="x_panel">
     <div class="x_title">
       <h2>Bienvenido a tus grupos <?php echo $_SESSION["usuario_nombre"]; ?></h2>
       <ul class="nav navbar-right panel_toolbox">
         <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
         </li>

         <li><a class="close-link"><i class="fa fa-close"></i></a>
         </li>
       </ul>
       <div class="clearfix"></div>
     </div>
     <div class="x_content">

     	<!-- <div class="col-md-3 text-center" style="border:  red solid 1px; ">
     		<img src="<?php //echo '../usuarios/'.$_SESSION["usuario_ruta_foto"]; ?>" alt="" style="width: 100; height: 150px;">

     	 </div> -->
       <div class="form-group row text-center" style="">
          <label class="col-form-label col-md-3 col-sm-3  " for="first-name">Seleccion uno de sus grupos</label>
          <div class="col-md-6 col-sm-6">
            <select  class="form-control formU select" id="grupos" > 
              
            	<?php echo $cadenaGrupos; ?>
            </select>


          </div>
        
       </div>
       <div class="form-horizontal form-label-left input_mask " id="datosGrup" style="display: none;">
	       	<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
	                  <label for="ref">Descripción  </label>
	                  <input disabled type="text" class="form-control veri" id="grupo_descripcion" style="border-radius: 10px; background-color: #0000;">
	                  
	        </div>

	        <div class="col-md-3 col-sm-12 form-group has-feedback">
	                  <label for="ref">Nivel </label>
	                  <input disabled type="text" class="form-control veri" id="nivel_descripcion" style="border-radius: 10px; background-color: #0000;">
	                  
	        </div>

	        <div class="col-md-3 col-sm-12 form-group has-feedback">
	                  <label for="ref">Total de alumnos </label>
	                  <input disabled type="text" class="form-control veri" id="total" style="border-radius: 10px; background-color: #0000;">
	                  
	        </div>

	        <div class="col-md-3 col-sm-12 form-group has-feedback">
	                  <label for="ref">Fecha de creación </label>
	                  <input disabled type="text" class="form-control veri" id="fecha" style="border-radius: 10px; background-color: #0000;">
	                  
	        </div>
       </div>

       <div class="col-md-12">
        <button class="btn btn-primary" id="obj" style="display: none;"> Objetivos de la unidades </button>
        <button class="btn btn-secondary" id="objEdit" style="display: none;">Editar Objetivos </button>
         
       </div>
       <div class="col-md-12" id="divTabla"> 

       	
       </div>
   
     </div>
   </div>
 </div>
</div>

<input type="hidden" id="id_usuario">
<input type="hidden" id="id_grupoM">
<input type="hidden" id="id_boleta_alumno">

<div class="modal fade bd-example-modal-lg" id="m_objetivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Objetivos de las unidades </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<form class="form-horizontal form-label-left" >

          <h2 style="color: black;">Seleccione una unidad</h2>

          <div class="form-group row">
            <label class="col-form-label col-md-1 col-sm-6 label-align" for="first-name">Unidad </label>
            <div class="col-md-6 col-sm-6">
              <select class="form-control" id="unidadesObjetivos">
                <option value="0" selected disabled >Seleccione una opción </option>
                <option value="1">Unidad 1</option>
                <option value="2">Unidad 2</option>
                <option value="3">Unidad 3</option>
                <option value="4">Unidad 4</option>
                <option value="5">Unidad 5</option>
                <option value="6">Unidad 6</option>
                <option value="7">Unidad 7</option>
                <option value="8">Unidad 8</option>
                <option value="9">Unidad 9</option>
                <option value="10">Unidad 10</option>
                <option value="11">Unidad 11</option>
                <option value="12">Unidad 12</option>
              </select>
            </div>
          </div>

        </form>

        <div class="row" style="display: none;" id="divObjetivos">
          <div class="col-md-4 form-group">
            <label> Objetivo 1 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_1"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 2 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_2"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 3 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_3"  style="border: 1px solid rgb(204, 204, 204);">      
          </div> 
          <div class="col-md-4 form-group">
            <label> Objetivo 4 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_4"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 5 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_5"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 6 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_6"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 7 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_7"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 8 </label>
            <input type="text"  class="form-control Objetivos" id="objetivo_8"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>

          
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Objetivos">Guardar </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="m_objetivos_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar objetivos de las unidades </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" >

          <h2 style="color: black;">Seleccione una unidad</h2>

          <div class="form-group row">
            <label class="col-form-label col-md-1 col-sm-6 label-align" for="first-name">Unidad </label>
            <div class="col-md-6 col-sm-6">
              <select class="form-control" id="unidadesObjetivos_edit">
            
              </select>
            </div>
          </div>

        </form>

        <div class="row" style="display: none;" id="divObjetivos_edit">
          <div class="col-md-4 form-group">
            <label> Objetivo 1 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_1_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 2 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_2_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 3 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_3_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div> 
          <div class="col-md-4 form-group">
            <label> Objetivo 4 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_4_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 5 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_5_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 6 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_6_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 7 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_7_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>
          <div class="col-md-4 form-group">
            <label> Objetivo 8 </label>
            <input type="text"  class="form-control Objetivos_edit" id="objetivo_8_edit"  style="border: 1px solid rgb(204, 204, 204);">      
          </div>

          
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Objetivos_edit">Guardar </button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="m-califiaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edición de calificaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="wizard_verticle2" class="form_wizard wizard_verticle">
                      <ul class="list-unstyled wizard_steps">
                        <li>
                          <a href="#step-11">
                            <span class="step_no">1</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-22">
                            <span class="step_no">2</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-33">
                            <span class="step_no">3</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-44">
                            <span class="step_no">4</span>
                          </a>
                        </li>
                   
                      
                      </ul>
                <div id="step-11" >
                   <h2 class="StepTitle">Paso 1 Seleccionar Categoría </h2>
                        <form class="form-horizontal form-label-left" >

                          <span class="section">Seleccione una unidad</span>

                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Unidad <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <select name="" id="unidades" class="form-control select select2">
                                <option value="0" selected disabled >Seleccione una opción </option>
                                <option value="1">Unidad 1</option>
                                <option value="2">Unidad 2</option>
                                <option value="3">Unidad 3</option>
                                <option value="4">Unidad 4</option>
                                <option value="5">Unidad 5</option>
                                <option value="6">Unidad 6</option>
                                <option value="7">Unidad 7</option>
                                <option value="8">Unidad 8</option>
                                <option value="9">Unidad 9</option>
                                <option value="10">Unidad 10</option>
                                <option value="11">Unidad 11</option>
                                <option value="12">Unidad 12</option>
                              </select>
                            </div>
                          </div>
                         

                        </form>
                </div>
                <div id="step-22">

                  <h2 class="StepTitle">Paso 2 Hours Covered  </h2>
                        <form class="form-horizontal form-label-left" >

                          <span class="section">Ingrese los datos solicitados</span>

                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hours Covered <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <input type="number" id="horas" class="form-control">
                                
                            </div>
                          </div>
                         

                        </form>

                </div>
                <div id="step-33">
                  <h2 class="StepTitle">Paso 3 Ingrese las calificaciones  </h2>
                  <form class="form-horizontal form-label-left">
                    <span class="section">Ingrese las calificaciones </span>
                    <div class="col-md-4 form-group">
                      <label> Attendance: </label>
                      <input type="number" min="0" max="100" class="form-control cali" id="attendance"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Class participation: </label>
                      <input type="number" min="0" max="100" class="form-control cali" id="classP"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Speaking Skill: </label>
                      <input type="number" min="0" max="100" class="form-control cali" id="Speaking"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>

                    <div class="col-md-4 form-group">
                      <label> Listening skill: </label>
                      <input type="number" min="0" max="100" class="form-control cali" id="Listening"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Written Skill: </label>
                      <input type="number" min="0" max="100" class="form-control cali" id="Written"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Reading Skill: </label>
                      <input type="number" min="0" max="100" class="form-control cali" id="Reading"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    

                  </form>

                </div>
                <div id="step-44">
                  <h2 class="StepTitle">Paso 4 Ingrese los datos seleccionados  </h2>

                   <form class="form-horizontal form-label-left">
                    <span class="section">Final Feedback </span>
                    <textarea class="form-control" id="feedback"></textarea>


                   </form>


                </div>

              </div>


      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="EditarCalif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Asignación de calificaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="wizard_verticle2Edit" class="form_wizard wizard_verticle">
                      <ul class="list-unstyled wizard_steps">
                        <li>
                          <a href="#step-11">
                            <span class="step_no">1</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-22">
                            <span class="step_no">2</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-33">
                            <span class="step_no">3</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-44">
                            <span class="step_no">4</span>
                          </a>
                        </li>
                   
                      
                      </ul>
                <div id="step-11" >
                   <h2 class="StepTitle">Paso 1 Seleccionar Categoría </h2>
                        <form class="form-horizontal form-label-left" >

                          <span class="section">Seleccione una unidad</span>

                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Unidad <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <select class="form-control" id="unidadesEdit"></select>
                            </div>
                          </div>
                         

                        </form>
                </div>
                <div id="step-22">

                  <h2 class="StepTitle">Paso 2 Hours Covered  </h2>
                        <form class="form-horizontal form-label-left" >

                          <span class="section">Ingrese los datos solicitados</span>

                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hours Covered <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <input type="number" id="horasEdit" class="form-control">
                                
                            </div>
                          </div>
                         

                        </form>

                </div>
                <div id="step-33">
                  <h2 class="StepTitle">Paso 3 Ingrese las calificaciones  </h2>
                  <form class="form-horizontal form-label-left">
                    <span class="section">Ingrese las calificaciones </span>
                    <div class="col-md-4 form-group">
                      <label> Attendance: </label>
                      <input type="number" min="0" max="100" class="form-control caliEdit" id="attendanceEdit"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Class participation: </label>
                      <input type="number" min="0" max="100" class="form-control caliEdit" id="classPEdit"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Speaking Skill: </label>
                      <input type="number" min="0" max="100" class="form-control caliEdit" id="SpeakingEdit"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>

                    <div class="col-md-4 form-group">
                      <label> Listening skill: </label>
                      <input type="number" min="0" max="100" class="form-control caliEdit" id="ListeningEdit"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Written Skill: </label>
                      <input type="number" min="0" max="100" class="form-control caliEdit" id="WrittenEdit"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    <div class="col-md-4 form-group">
                      <label> Reading Skill: </label>
                      <input type="number" min="0" max="100" class="form-control caliEdit" id="ReadingEdit"  style="border: 1px solid rgb(204, 204, 204);">      
                    </div>
                    

                  </form>

                </div>
                <div id="step-44">
                  <h2 class="StepTitle">Paso 4 Ingrese los datos seleccionados  </h2>

                   <form class="form-horizontal form-label-left">
                    <span class="section">Final Feedback </span>
                    <textarea class="form-control" id="feedbackEdit"></textarea>


                   </form>


                </div>

              </div>


      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="skillsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registro de Skills</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="wizard_verticleSkills" class="form_wizard wizard_verticle">
                      <ul class="list-unstyled wizard_steps">
                        <li>
                          <a href="#step-11">
                            <span class="step_no">1</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-22">
                            <span class="step_no">2</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-33">
                            <span class="step_no">3</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-44">
                            <span class="step_no">4</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-55">
                            <span class="step_no">5</span>
                          </a>
                        </li>
                   
                      
                      </ul>
               <div id="step-11" >
                   <h2 class="StepTitle">Paso 1 Seleccionar Unidad </h2>
                        <form class="form-horizontal form-label-left" >

                          <span class="section">Seleccione una unidad</span>

                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Unidad <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <select class="form-control" id="unidadesSkills"></select>
                            </div>
                          </div>
                         

                        </form>
                </div>
                <div id="step-22">

                  <h2 class="StepTitle">Paso 2 Speaking Skill Grade  </h2>
                        <form class="form-horizontal form-label-left" >

                          <span class="section">The student is able to…</span>
                          <div class="content col-md-12">
                           <table class="tg text-center" style="border: blue; width: 100%;">
                            <thead>
                              <tr>
                                <th class="tg-0pky"></th>
                                <th class="tg-0pky">Excelent</th>
                                <th class="tg-0pky">Good</th>
                                <th class="tg-0pky">Fair</th>
                                <th class="tg-0pky">Poor</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="tg-c3ow s1">To communicate or transmit his ideas with range of Words and Grammar</td>
                                <td class="tg-0pky"> <input type="radio"  name="s1" value="Excellent"></td>
                                <td class="tg-0pky"> <input type="radio"  name="s1" value="Good"></td>
                                <td class="tg-0pky"> <input type="radio"  name="s1" value="Fair"></td>
                                <td class="tg-0pky"> <input type="radio"  name="s1" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow s2">To communicate or transmit his ideas with fluency</td>
                                <td class="tg-0pky"><input type="radio"  name="s2" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="s2" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="s2" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="s2" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow s3">To communicate or transmit his ideas with the right intonation & pronunciation</td>
                                <td class="tg-0pky"><input type="radio"  name="s3" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="s3" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="s3" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="s3" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow s4">To communicate or transmit his ideas with Accuracy </td>
                                <td class="tg-0pky"><input type="radio"  name="s4" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="s4" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="s4" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="s4" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow s5">To communicate or transmit his ideas using Discourse Markers</td>
                                <td class="tg-0pky"><input type="radio"  name="s5" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="s5" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="s5" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="s5" value="Poor"></td>
                              </tr>
                            </tbody>
                           </table>
                            <h5 style="color:black;"> SPEAKING FEEDBACK </h5>
                            <textarea class="form-control" id="sfeedback"></textarea>
                            
                          </div>

                         
                         

                        </form>

                </div>
                <div id="step-33">
                  <h2 class="StepTitle">Paso 3 Listening Skill  </h2>
                  <form class="form-horizontal form-label-left">
                    <span class="section">The student is able to… </span>
                    <table class="tg text-center" style="border: blue; width: 100%;">
                            <thead>
                              <tr>
                                <th class="tg-0pky"></th>
                                <th class="tg-0pky">Excelent</th>
                                <th class="tg-0pky">Good</th>
                                <th class="tg-0pky">Fair</th>
                                <th class="tg-0pky">Poor</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="tg-c3ow l1">Listen for gist </td>
                                <td class="tg-0pky"> <input type="radio"  name="l1" value="Excellent"></td>
                                <td class="tg-0pky"> <input type="radio"  name="l1" value="Good"></td>
                                <td class="tg-0pky"> <input type="radio"  name="l1" value="Fair"></td>
                                <td class="tg-0pky"> <input type="radio"  name="l1" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow l2">Listen for specific information</td>
                                <td class="tg-0pky"><input type="radio"  name="l2" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="l2" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="l2" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="l2" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow l3">Listen for inference of opinion or attitude (intonation)</td>
                                <td class="tg-0pky"><input type="radio"  name="l3" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="l3" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="l3" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="l3" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow l4">Listen to work out meaning from context </td>
                                <td class="tg-0pky"><input type="radio"  name="l4" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="l4" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="l4" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="l4" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow l5">To recognize grammar pattern or discourse markers </td>
                                <td class="tg-0pky"><input type="radio"  name="l5" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="l5" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="l5" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="l5" value="Poor"></td>
                              </tr>
                            </tbody>
                    </table>
                    <h5 style="color:black;">LISTENING FEEDBACK </h5>
                    <textarea class="form-control" id="lfeedback"></textarea>

                  </form>

                </div>
                <div id="step-44">
                  <h2 class="StepTitle">Paso 4 Writing Grading Card</h2>

                   <form class="form-horizontal form-label-left">
                    <span class="section">The student is able to… </span>
                    <table class="tg text-center" style="border: blue; width: 100%;">
                            <thead>
                              <tr>
                                <th class="tg-0pky"></th>
                                <th class="tg-0pky">Excelent</th>
                                <th class="tg-0pky">Good</th>
                                <th class="tg-0pky">Fair</th>
                                <th class="tg-0pky">Poor</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="tg-c3ow w1">To his ideas with range of Words </td>
                                <td class="tg-0pky"> <input type="radio"  name="w1" value="Excellent"></td>
                                <td class="tg-0pky"> <input type="radio"  name="w1" value="Good"></td>
                                <td class="tg-0pky"> <input type="radio"  name="w1" value="Fair"></td>
                                <td class="tg-0pky"> <input type="radio"  name="w1" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow w2">To communicate or transmit his ideas with Accuracy. </td>
                                <td class="tg-0pky"><input type="radio"  name="w2" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="w2" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="w2" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="w2" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow w3">To write his ideas using Discourse Markers.</td>
                                <td class="tg-0pky"><input type="radio"  name="w3" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="w3" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="w3" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="w3" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow w4">To write his ideas with range of Grammar. </td>
                                <td class="tg-0pky"><input type="radio"  name="w4" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="w4" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="w4" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="w4" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow w5">To write his ideas with Punctuation. </td>
                                <td class="tg-0pky"><input type="radio"  name="w5" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="w5" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="w5" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="w5" value="Poor"></td>
                              </tr>
                            </tbody>
                    </table>
                     <h5 style="color:black;" >WRITING FEEDBACK </h5>
                     <textarea class="form-control" id="wfeedback"></textarea>


                   </form>


                </div>

                <div id="step-55">

                   <h2 class="StepTitle">Paso 5 Reading Grading Card</h2>

                   <form class="form-horizontal form-label-left">
                    <span class="section">The student is able to… </span>
                    <table class="tg text-center" style="border: blue; width: 100%;">
                            <thead>
                              <tr>
                                <th class="tg-0pky"></th>
                                <th class="tg-0pky">Excelent</th>
                                <th class="tg-0pky">Good</th>
                                <th class="tg-0pky">Fair</th>
                                <th class="tg-0pky">Poor</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="tg-c3ow r1">Scan a text for specific details  </td>
                                <td class="tg-0pky"> <input type="radio"  name="r1" value="Excellent"></td>
                                <td class="tg-0pky"> <input type="radio"  name="r1" value="Good"></td>
                                <td class="tg-0pky"> <input type="radio"  name="r1" value="Fair"></td>
                                <td class="tg-0pky"> <input type="radio"  name="r1" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow r2">Guess the meaning of words from the context.</td>
                                <td class="tg-0pky"><input type="radio"  name="r2" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="r2" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="r2" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="r2" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow r3">Predict the content of a text.</td>
                                <td class="tg-0pky"><input type="radio"  name="r3" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="r3" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="r3" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="r3" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow r4">Skim a text for the main ideas. </td>
                                <td class="tg-0pky"><input type="radio"  name="r4" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="r4" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="r4" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="r4" value="Poor"></td>
                              </tr>
                              <tr>
                                <td class="tg-c3ow r5">Understand the main idea. </td>
                                <td class="tg-0pky"><input type="radio"  name="r5" value="Excellent"></td>
                                <td class="tg-0pky"><input type="radio"  name="r5" value="Good"></td>
                                <td class="tg-0pky"><input type="radio"  name="r5" value="Fair"></td>
                                <td class="tg-0pky"><input type="radio"  name="r5" value="Poor"></td>
                              </tr>
                            </tbody>
                    </table>
                     <h5 style="color:black;">READING FEEDBACK </h5>
                     <textarea class="form-control" id="rfeedback"></textarea>


                   </form>
                  
                </div>

              </div>


      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="m_boletas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Consulta de boletas </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="form-horizontal form-label-left" >

          <h2 style="color: black;">Seleccione una unidad</h2>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-6 label-align" for="first-name">Unidad </label>
            <div class="col-md-6 col-sm-6">
              <select class="form-control" id="s_boletas">
            
              </select>
              
            </div>
            <div class="col-md-12 "  style="padding-top: 15px;" id="d_boletas"> </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Consulta_B">Consultar </button>
      </div>
    </div>
  </div>
</div>

 

<script >
	
	$(function(){



    $("#s_boletas").on("change",function(){
    

       $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            boleta_id: $("#s_boletas").val(),
            data: {
                  SSID: "consultaBoletas",
                  boleta_id: $("#s_boletas").val()
            },
            success: function (response) {

               response = JSON.parse(response);
               console.log(response);

               if(response.status =="100"){
                  $("#d_boletas").html(response.cadena);
               }
             
            }
          });

    });

    $("#Consulta_B").click(function(){

      if($("#s_boletas").val()!="0"){
        window.open( "../documentos/boleta.php?alumno="+$("#id_boleta_alumno").val()+"&boleta="+$("#s_boletas").val(), '_blank');
      }else{
        swal("Atención","Debe Seleccionar una unidad","warning");
      }


    });

    $("#unidadesObjetivos").on("change",function(){
      
       $("#divObjetivos").css("display","block");
      
 
    });

    $("#unidadesObjetivos_edit").on("change",function(){

       $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                  SSID: "datosObjetivos",
                  unidad_objetivo_id: $("#unidadesObjetivos_edit").val()


            },
            success: function (response) {

              response = JSON.parse(response);
              console.log(response);
              

              if(response.status=="100"){
                $("#divObjetivos_edit").css("display","inline-block");
                $("#objetivo_1_edit").val(response.datos[0]["unidad_objetivo_desc_1"]);
                $("#objetivo_2_edit").val(response.datos[0]["unidad_objetivo_desc_2"]);
                $("#objetivo_3_edit").val(response.datos[0]["unidad_objetivo_desc_3"]);
                $("#objetivo_4_edit").val(response.datos[0]["unidad_objetivo_desc_4"]);
                $("#objetivo_5_edit").val(response.datos[0]["unidad_objetivo_desc_5"]);
                $("#objetivo_6_edit").val(response.datos[0]["unidad_objetivo_desc_6"]);
                $("#objetivo_7_edit").val(response.datos[0]["unidad_objetivo_desc_7"]);
                $("#objetivo_8_edit").val(response.datos[0]["unidad_objetivo_desc_8"]);


              }else{
                swal("Atención","No hay objetivos registrados","error");
              }


            }  
          });


    });

    $("#Objetivos").click(function(){

      if($("#objetivo_1").val()!=""){

        $.ajax({
                method: "POST",
                url: "../servicios/servicios.php",
                data: {
                      SSID: "guardarObjetivos",
                      grupo_id: $("#id_grupoM").val(),
                      unidad_numero: $("#unidadesObjetivos").val(),
                      unidad_objetivo_desc_1:$("#objetivo_1").val(),
                      unidad_objetivo_desc_2:$("#objetivo_2").val(),
                      unidad_objetivo_desc_3:$("#objetivo_3").val(),
                      unidad_objetivo_desc_4:$("#objetivo_4").val(),
                      unidad_objetivo_desc_5:$("#objetivo_5").val(),
                      unidad_objetivo_desc_6:$("#objetivo_6").val(),
                      unidad_objetivo_desc_7:$("#objetivo_7").val(),
                      unidad_objetivo_desc_8:$("#objetivo_8").val()


                },
                success: function (response) {

                  response = JSON.parse(response);
                  console.log(response);
                  datos = response.datosG;

                  if(response.status=="100"){

                    swal("Exito","Los objetivos fueron registrados","success");
                    $("#m_objetivos").modal("toggle");
                  }else{
                    swal("Error","Los objetivos NO fueron registrados","error");  


                  }

                }
              });

      
      }else{
        swal("Atención","Debe ingresar al menos un objetivo","warning");

      }
    });

    $("#Objetivos_edit").click(function(){

      if($("#objetivo_1_edit").val()!=""){

        $.ajax({
                method: "POST",
                url: "../servicios/servicios.php",
                data: {
                      SSID: "EditarObjetivos",
                      unidad_objetivo_id: $("#unidadesObjetivos_edit").val(),
                      unidad_objetivo_desc_1:$("#objetivo_1_edit").val(),
                      unidad_objetivo_desc_2:$("#objetivo_2_edit").val(),
                      unidad_objetivo_desc_3:$("#objetivo_3_edit").val(),
                      unidad_objetivo_desc_4:$("#objetivo_4_edit").val(),
                      unidad_objetivo_desc_5:$("#objetivo_5_edit").val(),
                      unidad_objetivo_desc_6:$("#objetivo_6_edit").val(),
                      unidad_objetivo_desc_7:$("#objetivo_7_edit").val(),
                      unidad_objetivo_desc_8:$("#objetivo_8_edit").val()


                },
                success: function (response) {

                  response = JSON.parse(response);
                  console.log(response);
                  datos = response.datosG;

                  if(response.status=="100"){

                    swal("Exito","Los objetivos fueron Editados","success");
                    $("#m_objetivos_edit").modal("toggle");
                  }else{
                    swal("Error","Los objetivos NO fueron Editados","error");  

 
                  }

                }
              });

      
      }else{
        swal("Atención","Debe ingresar al menos un objetivo","warning");

      }
    });


    $("#obj").click(function(){ 

      $("#m_objetivos").modal("toggle");


    });


    $("#objEdit").click(function(){ 

       $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                  SSID: "verObjetivos",
                  id_grupo: $("#id_grupoM").val()


            },
            success: function (response) {

              response = JSON.parse(response);
              console.log(response);
              

              if(response.status=="100"){
                $("#unidadesObjetivos_edit").html(response.cadena);
                $("#m_objetivos_edit").modal("toggle");
              }else{
                swal("Atención","No hay objetivos registrados","error");
              }


            }  
          });


    });




		 
    $('#wizard_verticle2').smartWizard({
        // Properties
        selected: 0,  // Selected Step, 0 = first step   
        keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
        enableAllSteps: false,  // Enable/Disable all steps on first load
        transitionEffect: 'slide', // Effect on navigation, none/fade/slide/slideleft
        contentURL:null, // specifying content url enables ajax content loading
        contentURLData:null, // override ajax query parameters
        contentCache:true, // cache step contents, if false content is fetched always from ajax url
        cycleSteps: false, // cycle step navigation
        enableFinishButton: false, // makes finish button enabled always
        hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
        errorSteps:[],    // array of step numbers to highlighting as error steps
        labelNext:'Siguiente', // label for Next button
        labelPrevious:'Anterior', // label for Previous button
        labelFinish:'Finalizar',  // label for Finish button        
        noForwardJumping:false,
        // Events
        // onLeaveStep: null, // triggers when leaving a step
        // onShowStep: null,  // triggers when showing a step
        // onFinish: null  // triggers when Finish button is clicked
        onLeaveStep:leaveAStepCallback,
        onFinish:onFinishCallback    
    });

    $('#wizard_verticle2Edit').smartWizard({
        // Properties
        selected: 0,  // Selected Step, 0 = first step   
        keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
        enableAllSteps: false,  // Enable/Disable all steps on first load
        transitionEffect: 'slide', // Effect on navigation, none/fade/slide/slideleft
        contentURL:null, // specifying content url enables ajax content loading
        contentURLData:null, // override ajax query parameters
        contentCache:true, // cache step contents, if false content is fetched always from ajax url
        cycleSteps: false, // cycle step navigation
        enableFinishButton: false, // makes finish button enabled always
        hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
        errorSteps:[],    // array of step numbers to highlighting as error steps
        labelNext:'Siguiente', // label for Next button
        labelPrevious:'Anterior', // label for Previous button
        labelFinish:'Finalizar',  // label for Finish button        
        noForwardJumping:false,
        // Events
        // onLeaveStep: null, // triggers when leaving a step
        // onShowStep: null,  // triggers when showing a step
        // onFinish: null  // triggers when Finish button is clicked
        onLeaveStep:leaveAStepCallbackEdit,
         onFinish:onFinishCallbackEdit    
    }); 

    $('#wizard_verticleSkills').smartWizard({
        // Properties
        selected: 0,  // Selected Step, 0 = first step   
        keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
        enableAllSteps: false,  // Enable/Disable all steps on first load
        transitionEffect: 'slide', // Effect on navigation, none/fade/slide/slideleft
        contentURL:null, // specifying content url enables ajax content loading
        contentURLData:null, // override ajax query parameters
        contentCache:true, // cache step contents, if false content is fetched always from ajax url
        cycleSteps: false, // cycle step navigation
        enableFinishButton: false, // makes finish button enabled always
        hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
        errorSteps:[],    // array of step numbers to highlighting as error steps
        labelNext:'Siguiente', // label for Next button
        labelPrevious:'Anterior', // label for Previous button
        labelFinish:'Finalizar',  // label for Finish button        
        noForwardJumping:false,
        // Events
        // onLeaveStep: null, // triggers when leaving a step
        // onShowStep: null,  // triggers when showing a step
        // onFinish: null  // triggers when Finish button is clicked
        onLeaveStep:leaveAStepCallbackSkill,
         onFinish:onFinishCallbackSkill    
    }); 



       

        function validateAllSteps(){
          var isStepValid = true;
          // all step validation logic     
          return isStepValid;
        } 

        function leaveAStepCallback(obj, context){
         

         if(context.fromStep < context.toStep){

          return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
         }else{

          return true;
         }
         
        }

        function validateSteps(stepnumber){
          var isStepValid = true;
          // validate step 1
          if(stepnumber == 1){
              
              if($("#unidades").val()>0){

                return isStepValid;

              }else{

                swal("Atención", "Debe seleccionar una unidad", "warning");
                return false;

              }
          }

            if(stepnumber == 2){
              
              if($("#horas").val()>0){

                return isStepValid;

              }else{

                swal("Atención", "Debe ingresar los datos solicitados", "warning");
                return false;

              }
          }

           if(stepnumber == 3){
              valida=0;

              $(".cali").each(function(){

                if($(this).val()==""){
                  valida=1;
                  $(this).css("border","1px solid red");
                }

                if($(this).val() <0 || $(this).val()>100){
                  valida =2;
                  $(this).css("border","1px solid black");
                }

              });

              
              if(valida == 0){

                return isStepValid;

              }else if(valida ==1 ){


                swal("Atención", "Debe ingresar las calificaciones solicitadas", "warning");
                return false;

              }else if(valida ==2){


                swal("Atención", "Debe ingresar un valor entre el 0 y el 100", "warning");
                return false;

              }
          }

        }

        function onFinishCallback(objs, context){
         if(validateAllSteps()){

                    

            if($("#feedback").val()==""){

                swal("Atención", "Debe ingresar un feedback", "warning");
                return false;


            }else{
                  
                  $.ajax({
                          method: "POST",
                          url: "../servicios/servicios.php",
                          data: {
                                SSID: "guardarCalif",
                                boleta_unidad: $("#unidades").val(),
                                boleta_hours_covered: $("#horas").val(),
                                boleta_attendance:$("#attendance").val(),
                                boleta_class_participation: $("#classP").val(),
                                boleta_speaking_skill: $("#Speaking").val(),
                                boleta_listening_skill: $("#Listening").val(),
                                boleta_written_skill: $("#Written").val(),
                                boleta_reading_skill: $("#Reading").val(),
                                boleta_final_feedback: $("#feedback").val(),
                                boleta_id_alumno: $("#idalumno").val()


                          },
                          success: function (response) {

                            response = JSON.parse(response);
                            // console.log(response);
                            datos = response.datosG;

                            if(response.status=="100"){

                              swal("Exito","Los datos de la boleta fueron registrados","success");
                              $("#m-califiaciones").modal("toggle");
                            }else{
                              swal("Error","Los datos de la boleta NO fueron registrados","error");  


                            }

                          }
                        });
            }
          


         }

        }


        function validateAllStepsEdit(){
          var isStepValid = true;
          // all step validation logic     
          return isStepValid;
        
        } 

        function leaveAStepCallbackEdit(obj, context){
         

         if(context.fromStep < context.toStep){

          return validateStepsEdit(context.fromStep); // return false to stay on step and true to continue navigation 
         }else{

          return true;
         } 
         
        }

        function validateStepsEdit(stepnumber){
         var isStepValid = true;
          // validate step 1
         if(stepnumber == 1){
          	if($("#unidadesEdit").val()==null){
          		swal("Atención", "Debe seleccionar una unidad", "warning");
                return false;
          	}else{
          		$("#horasEdit").val(datosBoleta[0]["boleta_hours_covered"]);
      				$("#attendanceEdit").val(datosBoleta[0]["boleta_attendance"]);
      				$("#classPEdit").val(datosBoleta[0]["boleta_class_participation"]);
      				$("#SpeakingEdit").val(datosBoleta[0]["boleta_speaking_skill"]);
      				$("#ListeningEdit").val(datosBoleta[0]["boleta_listening_skill"]);
      				$("#WrittenEdit").val(datosBoleta[0]["boleta_written_skill"]);
      				$("#ReadingEdit").val(datosBoleta[0]["boleta_reading_skill"]);
      				$("#feedbackEdit").val(datosBoleta[0]["boleta_final_feedback"]);

			        return isStepValid;     
          	}

         }

          if(stepnumber == 2){
              
              if($("#horasEdit").val()>0){

                return isStepValid;

              }else{

                swal("Atención", "Debe ingresar los datos solicitados", "warning");
                return false;

              }
          }

           if(stepnumber == 3){
              valida=0;

              $(".caliEdit").each(function(){

                if($(this).val()==""){
                  valida=1;
                  $(this).css("border","1px solid red");
                }

                if($(this).val() <0 || $(this).val()>100){
                  valida =2;
                  $(this).css("border","1px solid black");
                }

              });

              
              if(valida == 0){

                return isStepValid;

              }else if(valida ==1 ){


                swal("Atención", "Debe ingresar las calificaciones solicitadas", "warning");
                return false;

              }else if(valida ==2){


                swal("Atención", "Debe ingresar un valor entre el 0 y el 100", "warning");
                return false;

              }
          }

        } 

        function onFinishCallbackEdit(objs, context){
    			if(validateAllStepsEdit()){

    				$.ajax({
    				          method: "POST",
    				          url: "../servicios/servicios.php",
    				          data: {
    				                SSID: "EditarBoleta",
    				                boleta_id:$("#unidadesEdit").val(),
    				                boleta_hours_covered: $("#horasEdit").val(),
    								boleta_attendance: $("#attendanceEdit").val(),
    								boleta_class_participation: $("#classPEdit").val(),
    								boleta_speaking_skill: $("#SpeakingEdit").val(),
    								boleta_listening_skill: $("#ListeningEdit").val(),
    								boleta_written_skill: $("#WrittenEdit").val(),
    								boleta_reading_skill: $("#ReadingEdit").val(),
    								boleta_final_feedback: $("#feedbackEdit").val()

    				          },
    				          success: function (response) {

    				            response = JSON.parse(response);
    				            console.log(response);
    				          

    				            if(response.status=="100"){

    				              swal("Exito","Los datos de la boleta fueron actulizados","success");
                                  $("#EditarCalif").modal("toggle");


    				            }else{
    				            	swal("Error","No se actualizaron los datos de la boleta","error"); 
    				            }

    				          } 
    			            });

    				

    			}else{

    			}

        }

        function validateAllStepsSkill(){
          var isStepValid = true;
          // all step validation logic     
          return isStepValid;
        
        } 

        function leaveAStepCallbackSkill(obj, context){
         

         if(context.fromStep < context.toStep){

          return validateStepsSkill(context.fromStep); // return false to stay on step and true to continue navigation 
         }else{

          return true;
         } 
         
        }

        function validateStepsSkill(stepnumber){

         var isStepValid = true;


         if(stepnumber == 1){
            if($("#unidadesSkills").val()==null){
              swal("Atención", "Debe seleccionar una unidad", "warning");
                return false;
            }else{


              return isStepValid;     
            }

         }

         if(stepnumber == 2){

            validacion =0;

            if($('input:radio[name=s1]:checked').val()==undefined){
              validacion =1;
             $(".s1").css("color","red"); 
            }
            if($('input:radio[name=s2]:checked').val()==undefined){
              validacion =1;
             $(".s2").css("color","red"); 
            }
            if($('input:radio[name=s3]:checked').val()==undefined){
              validacion =1;
             $(".s3").css("color","red"); 
            }
            if($('input:radio[name=s4]:checked').val()==undefined){
              validacion =1;
             $(".s4").css("color","red"); 
            }
            if($('input:radio[name=s5]:checked').val()==undefined){
              validacion =1;
             $(".s5").css("color","red"); 
            }

            if($("#sfeedback").val()==""){
              validacion =1;
              $("#sfeedback").css("border","1px solid red");

            }

            if(validacion==1){
              swal("Atención","Ingrese los datos solicitados","warning");
              return false;
            }else{
              return isStepValid;
            }


           }
        

         if(stepnumber == 3){

            validacion =0;

            if($('input:radio[name=l1]:checked').val()==undefined){
              validacion =1;
             $(".l1").css("color","red"); 
            }
            if($('input:radio[name=l2]:checked').val()==undefined){
              validacion =1;
             $(".l2").css("color","red"); 
            }
            if($('input:radio[name=l3]:checked').val()==undefined){
              validacion =1;
             $(".l3").css("color","red"); 
            }
            if($('input:radio[name=l4]:checked').val()==undefined){
              validacion =1;
             $(".l4").css("color","red"); 
            }
            if($('input:radio[name=l5]:checked').val()==undefined){
              validacion =1;
             $(".l5").css("color","red"); 
            }

            if($("#lfeedback").val()==""){
              validacion =1;
              $("#lfeedback").css("border","1px solid red");

            }

            if(validacion==1){
              swal("Atención","Ingrese los datos solicitados","warning");
              return false;
            }else{
              return isStepValid;
            }
         }

         if(stepnumber == 4){

            validacion =0;

            if($('input:radio[name=w1]:checked').val()==undefined){
              validacion =1;
             $(".w1").css("color","red"); 
            }
            if($('input:radio[name=w2]:checked').val()==undefined){
              validacion =1;
             $(".w2").css("color","red"); 
            }
            if($('input:radio[name=w3]:checked').val()==undefined){
              validacion =1;
             $(".w3").css("color","red"); 
            }
            if($('input:radio[name=w4]:checked').val()==undefined){
              validacion =1;
             $(".w4").css("color","red"); 
            }
            if($('input:radio[name=w5]:checked').val()==undefined){
              validacion =1;
             $(".w5").css("color","red"); 
            }

            if($("#wfeedback").val()==""){
              validacion =1;
              $("#wfeedback").css("border","1px solid red");

            }

            if(validacion==1){
              swal("Atención","Ingrese los datos solicitados","warning");
              return false;
            }else{
              return isStepValid;
            }
         }

         if(stepnumber == 5){

            validacion =0;

            if($('input:radio[name=r1]:checked').val()==undefined){
              validacion =1;
             $(".r1").css("color","red"); 
            }
            if($('input:radio[name=r2]:checked').val()==undefined){
              validacion =1;
             $(".r2").css("color","red"); 
            }
            if($('input:radio[name=r3]:checked').val()==undefined){
              validacion =1;
             $(".r3").css("color","red"); 
            }
            if($('input:radio[name=r4]:checked').val()==undefined){
              validacion =1;
             $(".r4").css("color","red"); 
            }
            if($('input:radio[name=r5]:checked').val()==undefined){
              validacion =1;
             $(".r5").css("color","red"); 
            }

            if($("#rfeedback").val()==""){
              validacion =1;
              $("#rfeedback").css("border","1px solid red");

            }

            if(validacion==1){
              swal("Atención","Ingrese los datos solicitados","warning");
              return false;
            }else{
              return isStepValid;
            }
         }

          // validate step 1
        }



        function onFinishCallbackSkill(objs, context){
          if(validateAllStepsSkill()){

            $.ajax({
                      method: "POST",
                      url: "../servicios/servicios.php",
                      data: {
                            SSID: "skillsRegistro",
                            boleta_id:$("#unidadesSkills").val(),
                            s1: $('input:radio[name=s1]:checked').val(),
                            s2: $('input:radio[name=s2]:checked').val(),
                            s3: $('input:radio[name=s3]:checked').val(),
                            s4: $('input:radio[name=s4]:checked').val(),
                            s5: $('input:radio[name=s5]:checked').val(),
                            l1: $('input:radio[name=l1]:checked').val(), 
                            l2: $('input:radio[name=l2]:checked').val(),
                            l3: $('input:radio[name=l3]:checked').val(),
                            l4: $('input:radio[name=l4]:checked').val(),
                            l5: $('input:radio[name=l5]:checked').val(),
                            w1: $('input:radio[name=w1]:checked').val(),
                            w2: $('input:radio[name=w2]:checked').val(),
                            w3: $('input:radio[name=w3]:checked').val(),
                            w4: $('input:radio[name=w4]:checked').val(),
                            w5: $('input:radio[name=w5]:checked').val(),
                            r1: $('input:radio[name=r1]:checked').val(),
                            r2: $('input:radio[name=r2]:checked').val(),
                            r3: $('input:radio[name=r3]:checked').val(),
                            r4: $('input:radio[name=r4]:checked').val(),
                            r5: $('input:radio[name=r5]:checked').val(),
                            sfeedback: $("#sfeedback").val(),
                            lfeedback: $("#lfeedback").val(),
                            wfeedback: $("#wfeedback").val(),
                            rfeedback: $("#rfeedback").val()


                            
                      },
                      success: function (response) {

                        response = JSON.parse(response);
                        console.log(response);
                      

                        if(response.status=="100"){

                          swal("Exito","Los datos de la boleta fueron actulizados","success");
                          $("#EditarCalif").modal("skillsModal");
                          $(".tg-c3ow").css("color","#8d9dae");

                          $("input:radio").each(function(){
                              $(this).prop("checked",false);
                          });



                        }else{
                          swal("Error","No se actualizaron los datos de la boleta","error"); 
                        }

                      } 
                      });

            

          }else{

          }

        }






      $('.stepContainer').css("height","auto");


	   	$('.select').select2({
                    width: '100%',
                    placeholder: 'Seleccione una opción'
         });


      $('#grupos').on('select2:select', function (e) {
		    


		     $.ajax({
              method: "POST",
              url: "../servicios/servicios.php",
              data: {
                  SSID: "getGrupo",
                 id_grupo: e.params.data.id
              },
              success: function (response) {
                  response = JSON.parse(response);
                  console.log(response);
                  datos = response.datosG;

                  if(response.status=="100"){

			           		$("#grupo_descripcion").val(datos.grupo_descripcion);
                  	$("#nivel_descripcion").val(datos.nivel_descripcion);
                  	$("#total").val(datos.total);
                  	$("#fecha").val(datos.grupo_fecha_creacion);
                  	$("#datosGrup").css("display","block");
                  	$("#divTabla").html(response.tabla);
                    $("#obj").css("display","inline-block");
                    $("#objEdit").css("display","inline-block");

                    $("#id_grupoM").val(e.params.data.id);

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

  
                  

                  }



              },
              error: function (a) {
                  console.log(a );
              }
             });


	        });

	    });

function editar(id){

    $("#idalumno").val(id);

   	$("#m-califiaciones").modal("toggle");

		 
}

function calificaciones(id){

  $("#id_boleta_alumno").val(id);

  $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                  SSID: "verUnidades",
                  boleta_id_alumno: id


            },
            success: function (response) {

              response = JSON.parse(response);
              console.log(response);
              datos = response.datosG;

              if(response.status=="100"){

                $("#s_boletas").html(response.cadena);
                $("#m_boletas").modal("toggle");
                $("#d_boletas").html("");

              }else{
                swal("Atención","No tiene boletas registradas","warning");
              }
            }
          });



   // window.open( "../documentos/boleta.php?alumno="+id, '_blank');
 
}

var datosBoleta;

function cambiar(id){

  	 
  	$("#idalumno").val(id);

  	$.ajax({
	          method: "POST",
	          url: "../servicios/servicios.php",
	          data: {
	                SSID: "verUnidades",
	                boleta_id_alumno: $("#idalumno").val()


	          },
	          success: function (response) {

	            response = JSON.parse(response);
	            console.log(response);
	            datos = response.datosG;

	            if(response.status=="100"){

	            	$("#unidadesEdit").html(response.cadena);

	            	$("#unidadesEdit").on("change",function(){
	            		$.ajax({
				          method: "POST",
				          url: "../servicios/servicios.php",
				          data: {
				                SSID: "verBoleta",
				                boleta_id:$("#unidadesEdit").val()


				          },
				          success: function (response) {

				            response = JSON.parse(response);
				            console.log(response);
				          

				            if(response.status=="100"){

				            	datosBoleta = response.datos;


				            }else{
				            	swal("Error","No tiene calificaciones registradas","error"); 
				            }

				          }
			            });


	            	});

	                $("#EditarCalif").modal("toggle");
	                $('#wizard_verticle2Edit').smartWizard('goToStep', 1);
	                $(".stepContainer").css("height","auto");



	            }else{
	            	swal("Error","No tiene calificaciones registradas","error"); 
	            }

	          }
            });

}

function skills(id){

    $("#idalumno").val(id);

    $.ajax({
            method: "POST",
            url: "../servicios/servicios.php",
            data: {
                  SSID: "verUnidades",
                  boleta_id_alumno: $("#idalumno").val()


            },
            success: function (response) {

              response = JSON.parse(response);
              console.log(response);
              datos = response.datosG;

              if(response.status=="100"){

                  $("#unidadesSkills").html(response.cadena);
                  $("#skillsModal").modal("toggle");
                  $('#wizard_verticleSkills').smartWizard('goToStep', 1);
                  $(".stepContainer").css("height","auto");



              }else{
                swal("Error","No tiene calificaciones registradas","error"); 
              }

            }
            });


}

</script> 