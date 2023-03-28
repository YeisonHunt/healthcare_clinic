<?php

class Procedimientos extends ActiveRecord{

	public function getProcedimientos($page,$ppage){

		return $this->paginate("page: $page", "per_page: $ppage", 'order: idPro asc');
	}
	

	public function getAllProcedimientos(){
		return $this->paginate("page: 1", 'order: idPro asc');
	}

}