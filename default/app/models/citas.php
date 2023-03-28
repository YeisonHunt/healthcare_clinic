<?php

class Citas extends ActiveRecord{

public function getCalendario(){

	$hasta ="hasta";
	$space ="&nbsp;";

$sql = "SELECT diaC as date, pacientes.nombreP as title, CONCAT(citas.horaInicio,$hasta, 
	citas.horaFin, $space, pacientes.nombreP,$space, pacientes.apellidoP) 
as 'desc' FROM citas INNER JOIN pacientes ON citas.pacientes_idPaciente=pacientes.idPaciente";

return $this->find_all_by_sql($sql);

}


}