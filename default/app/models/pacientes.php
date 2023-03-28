<?php

class Pacientes extends ActiveRecord{

	public function getPacientes($page,$ppage){

		return $this->paginate("page: $page", "per_page: $ppage", 'order: nombreP asc');
	}
	

	public function getAllPacientes(){
		return $this->paginate("page: 1", 'order: nombreP asc');
	}

	public function getPaginados($page){


	return $this->paginate_by_sql('pacientes', 'SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
     fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
      CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes ', 'per_page: 3', 'page: 1');
	}

}