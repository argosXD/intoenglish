<?PHP
if (!defined(("DBCONFIG"))) {
  define("DBCONFIG","1");

date_default_timezone_set('America/Mexico_City');
  
  
 // Functions and Procedures
 function dbConnect(){

  //dominio,usuario,contraseña,base de datos
  
  $link = mysqli_connect(("65.99.225.221"),("intoeng1_develop"),("Marban85."), ("intoeng1_base_de_datos"));
  mysqli_set_charset($link, 'utf8mb4');
 // mysqli_query("SET NAMES 'utf8'", $link);
  
  //mysql_set_charset('utf8');
  if ($link){
     return $link;
  }else{
     return mysqli_error();
  }
 }//End dbConnect

 function dbSelect(){
  return true;
/*  $dbSelect = mysql_select_db(DB);
//  if ($dbSelect){
     return true;
  }else{
     return mysql_error();
  }
  */
 }//End dbSelect

 function dbQuery($query, $link){
  $result = mysqli_query($link, $query);
  if ($result){
	  
	  //mysql_free_result();
	  //ob_end_flush();
	  
	 return $result;

	 
	 
  }else{
     return false;
  }
 }//End dbQuery

 function dbQueryArray($query, $link){
  $result = mysqli_query($link, $query);
  $resultRow = array ();
  if ($result){
     $i=0;
     while ($row=dbFetchRow($result)) {
       $resultRow[$i]=$row;
       $i++;
     }
  } 
  
//  mysql_free_result();
//  ob_end_flush();
  
  return $resultRow;
  
  
 }//End dbQueryArray

 function dbFetchRow($result){
  $row = mysqli_fetch_array($result);
  return $row;
 }//End dbFecthRow 
 
 
 function DBQuery_s($query){
 	$result = mysqli_query($link, $query);
 	if($result)
 	{
 		return $result;
 	}
 	else
 	{
 		return false;
 	}
 }
}//End Fucntions DB
?>
