<?php

class Medicamentos extends ActiveRecord{

	public function getPacientes($page,$ppage){

		return $this->paginate("page: $page", "per_page: $ppage", 'order: tiempo asc');
	}
	

	public function getAllPacientes(){
		return $this->paginate("page: 1", 'order: tiempo asc');
	}

	

}