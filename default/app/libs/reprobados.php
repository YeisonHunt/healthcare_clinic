<?php



$conn = new mysqli('localhost','root','','belen_sistema_academico');
$conn1 = new mysqli('localhost','root','','belen_sistema_academico');

// Lista de Sql que necesito para hacer los cálculos de cuantos chicos(as) hay por listar.



$query_aprobados="SELECT COUNT(promover) from alumno where promover like 'Aprobado%' and grado=".$grado1." ";
$query_reprobados="SELECT COUNT(promover) from alumno where promover like 'Reprobado%' and grado=".$grado1."  ";





$prepare = $conn->prepare($query_aprobados);
$prepare->execute();

$prepare1 = $conn1->prepare($query_reprobados);
$prepare1->execute();
  



//Ahora guardaremos ese resultado en:
$resultSet= $prepare->get_result();
$resultSet1= $prepare1->get_result();
//Ahora vamos a trabajar con cada una de las filas del Set de Resultados
while($alumno_estado[]= $resultSet->fetch_array());
while($alumno_estado1[]= $resultSet1->fetch_array());

$resultSet->close();

$prepare->close();

$conn->close();

$resultSet1->close();

$prepare1->close();

$conn1->close();


    View::content();
    Load::lib('pdf/mpdf');
   

 $css = file_get_contents('css/sbadmin/bootstrap.css');
 $anio="2017";
  
   
foreach($alumno_estado as $var){



		$html.='
		
     <td><h3>'.$var['COUNT(promover)'].'</h3></td>
	
	
		';
}


?>