<?php

View::template('sbadmin');
session_start();
date_default_timezone_set("America/Bogota");

class CertificacionesController extends AppController {

    public function index() {

        $this->titulo = "Busca tu paciente";
		$this->subtitulo = "Genera certificados para ellos(as)";
		$this->informacion = "Busque el paciente de la manera que prefiera";

        
        $this->listaPacientes=null;


        if (Input::hasPost("valN")) {

            $paciente= new Pacientes();
            $nombreP= Input::post("nombreP");


            $sql="SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
            fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
            CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where nombreP like '%$nombreP%' ";
            $this->listaPacientes=$paciente->find_all_by_sql($sql);

            if($this->listaPacientes== null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            }else{

                Flash::valid('Lista de pacientes encontrados....');

            }
        }// End buscar por nombres


        if (Input::hasPost("valA")) {

            $paciente= new Pacientes();
            $nombreP= Input::post("apellidoP");


            $sql="SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
            fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
            CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where  apellidoP like '%$nombreP%' ";
            $this->listaPacientes=$paciente->find_all_by_sql($sql);

            if($this->listaPacientes== null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            }else{

                Flash::valid('Lista de pacientes encontrados....');

            }
        }// End buscar por nombres


        if (Input::hasPost("valI")) {

            $paciente= new Pacientes();
            $nombreP= Input::post("cedulaP");


            $sql="SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
            fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
            CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where  cedulaP=$nombreP ";
            $this->listaPacientes=$paciente->find_all_by_sql($sql);

            if($this->listaPacientes== null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            }else{

                Flash::valid('Lista de pacientes encontrados....');

            }
        }// End buscar por nombres




    } // Fin FUNCION INDEX

    public function nuevoCertificado($idPaciente){


        $this->titulo = "Certificaciones";
		$this->subtitulo = "Comprobación de citas en pacientes.";
		$this->informacion = "Introduzca los datos que se le piden correctamente.";

           $paciente = new Pacientes();

           $this->paciente=$paciente->find($idPaciente);

           if(Input::hasPost('temp')){
           
           $this->ciudadExp= Input::post("lugarExpedicion");
           //$this->fechaExp =  date("Y-m-d");
           $this->razon=Input::post("reason");
           $this->direccion=Input::post('direccion');
           $this->fechaExp= Input::post('fechaCer');
           $this->fechaPedida =Input::post('fechaPedida');
           $this->rangoEdad = Input::post('rangoEdad');

           View::select('imprimirCertificado');



           }
          


    }

      public function nuevoLaboral($idPaciente){


        $this->titulo = "Certificaciones";
		$this->subtitulo = "Certificaciones Laborales.";
		$this->informacion = "Introduzca los datos que se le piden correctamente.";

           $paciente = new Pacientes();

           $this->paciente=$paciente->find($idPaciente);

           if(Input::hasPost('temp')){
           
           $this->ciudadExp= Input::post("lugarExpedicion");
           //$this->fechaExp =  date("Y-m-d");
           $this->razon=Input::post("reason");
     
           $this->fechaExp= Input::post('fechaCer');

           $this->dirCon = Input::post('dirCon');

           $this->telCon = Input::post('telCon');

           $this->celCon = Input::post('celCon');

           
          // $this->fechaPedida= Input::post('fechaPedida');
          

           View::select('imprimirLaboral');



           }
          


    }




   

}
