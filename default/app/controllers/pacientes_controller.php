<?php

View::template('sbadmin');
session_start();

date_default_timezone_set("America/Bogota");


class PacientesController extends AppController {


    public function edit($idPaciente){

   
    $this->titulo = "Gestión de Pacientes";
    $this->subtitulo = "Editar Pacientes";
    $this->informacion = "Es de humanos equivocarse... Aquí podemos corregir esos errores.";

    $paciente = new Pacientes();


    $this->paciente = $paciente->find($idPaciente);


    if (Input::hasPost('idProF')) {

            
            $paciente->cedulaP = Input::post('idP');
            $paciente->nombreP = Input::post('nF');
            $paciente->apellidoP = Input::post('aF');
            $paciente->dirP = Input::post('dF');
            $paciente->celP = Input::post('cF');
            $paciente->profesion = Input::post('prF');
            $paciente->peso = Input::post('pF');
            $paciente->fechaNaciP = Input::post('fN');
            $paciente->estaturaP = Input::post('eF');
            $paciente->rhP = Input::post('rhF');
            $paciente->genero=Input::post('gF');

            $paciente->alergias = Input::post('aleF');
            $paciente->discapacidades = Input::post('disF');
            $paciente->eps=Input::post('epsF');
            $paciente->tiempo=date("Y-m-d H:i:s");


             if(Input::post('cF')==""){
               $paciente->celP ="----------";

            }
          

            if(Input::post('aleF')==""){
               $paciente->alergias ="Ninguna";

            }

             if(Input::post('disF')==""){
            $paciente->discapacidades ="Ninguna";  
            }

              if(Input::post('epsF')==""){
             $paciente->eps ="Ninguna";  
            }




            


            if (!$paciente->update(Input::post('idProF'))) {

                
                 Flash::error('Hubo un error al actualizar el paciente.. Verifique que los datos estén correctos, como cédula por ejemplo.');
                     Redirect::to('pacientes/index');

              }
                else{

                  Flash::valid('Paciente actualizado correctamente.');
                Input::delete();
              
                $paciente2= new Pacientes();
                
        $this->listaPacientes = $paciente2->find_all_by_sql("SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
     fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
      CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes order by tiempo desc limit 8");
               

                 Redirect::to('pacientes/index');



                }

             
    }


        
    }


   public function crear(){

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Creación de Pacientes";
        $this->informacion = " <b>Carlos Eduardo Urbano </b>- Médico Principal";


 if(Input::hasPost('idProF')){

   
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "clinic";


            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("utf8");

            if ($conn->connect_error) {
                die("Falló la conexión a Clinic. Revise por favor que tenga  Xampp corriendo en su equipo.: " . $conn->connect_error);
            }
           
           // Comencemos a traer los datos que vienen del formulario

            $cedulaP=Input::post('idP');
            $nombreP=Input::post('nF');
            $apellidoP=Input::post('aF');
            $dirP=Input::post('dF');
            $profesion=Input::post('prF');
            $peso=Input::post('pF');
            $date=Input::post('fN');


           // Código para asginar la edad según la fecha de nacimiento.
           
            $celP=Input::post('cF');
            $estaturaP=Input::post('eF');
            $rhP=Input::post('rhF');
            $genero=Input::post('gF');

            $alergias=Input::post('aleF');
            $discapacidades=Input::post('disF');
            $eps=Input::post('epsF');

             if($eps==""){
               $eps ="Ninguna";

            }

              if($celP==""){
               $celP ="----------";

            }





            if($alergias==""){
               $alergias ="Ninguna";

            }

             if($discapacidades==""){

              $discapacidades ="Ninguna";  
            }
               
               

                  $sql = "INSERT INTO pacientes (cedulaP, nombreP,apellidoP,dirP,celP,profesion,peso,fechaNaciP,
                    estaturaP,rhP,genero,alergias,discapacidades,eps)
                  VALUES ($cedulaP,'$nombreP','$apellidoP','$dirP','$celP','$profesion','$peso','$date',
                    '$estaturaP','$rhP','$genero','$alergias','$discapacidades','$eps')";

                  if ($conn->query($sql) === TRUE) {
          
                    $paciente = new Pacientes();
                    $this->listaPacientes = $paciente->find_all_by_sql("SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
            
                      fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
                       CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes order by tiempo desc limit 8");
               
                     
                     Input::delete();
                     Flash::valid('Paciente guardado correctamente.');
                    Redirect::to('pacientes/index');

                  } else {
                    echo " " . $conn->error;
 
                 Flash::error('Hubo un error al actualizar el paciente.. Verifique que los datos estén correctos, como cédula por ejemplo.');
                }
                  $conn->close();


       }//If hasPost
    


   }


/* SEPARADOR FUNCIÓN CREAR*/

    public function index() {

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Sistema de Control de Pacientes";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";


        if (Auth::is_valid()) {
            $tipo = Auth::get('rol');
            if ($tipo != null && $tipo == 1) {

                $paciente= new Pacientes();
                
        $this->listaPacientes = $paciente->find_all_by_sql("SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
     fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
      CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes order by tiempo desc limit 8");

        $this->numeroPacientes =$paciente->find_by_sql("SELECT COUNT(*) as cuenta from pacientes ");
               


            } else {
                Redirect::to('inicio/index');
            }
        } else {
            Redirect::to('usuarios/index');
        }

    }


    
    public function buscar() {

         $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Búsqueda de Pacientes";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";
        

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


   



    }

    
    public function acerca() {
        
        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Sistema de Control de Pacientes";
        $this->informacion = " <b>Carlos Eduardo Urbano </b>- Médico Principal";
    }

}
