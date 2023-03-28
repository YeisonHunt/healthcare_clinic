<?php

View::template('sbadmin');
session_start();

class HistoriaclinicaController extends AppController
{
   
public function imprimirHistorias($fecha1,$fecha2,$idPaciente){
 $historiaclinica= new Historiaclinica();

  

  $paciente = new Pacientes();

  $this->paciente = $paciente->find_by_idPaciente($idPaciente);


if($fecha1==1 and $fecha2==1){

 $this->listaClinicas = $_SESSION['historiasClinicasC'];

  $this->f1=null;
 $this->f2=null;


}else{$this->listaClinicas = $_SESSION['historiasClinicas'];


 $this->f1=$fecha1;
 $this->f2=$fecha2;}


 




}
   public function buscar2(){ 

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Buscando la historia para su historia Clinica.";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";
        



        if (Input::hasPost("valH")) {

            $historiaclinica= new Historiaclinica();
            $nombreP= Input::post("nombreP");


            $sql="SELECT * from historiaclinica inner join pacientes
        	on historiaclinica.pacientes_idPaciente=pacientes.idPaciente where historiaclinica.motivoH like '%$nombreP%' 
        	order by historiaclinica.tiempo desc limit 20 ";

            $this->listaClinicas=$historiaclinica->find_all_by_sql($sql);

            if($this->listaClinicas== null) {
                Flash::error('Historia Clinica  no encontrada, por favor pruebe con otro palabra.');
            }else{

                Flash::valid('Lista de historias clinicas con esas palabras  encontradas.... Máx: 20 reg');
                View::select("index");
                Input::delete();

            }
        }// End buscar por nombres



        



}# END FUNCTION BUSCAR asignar paciente



	public function verTodas($idPaciente=null){


      $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Lista de Historias Clinicas";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";

       $paciente = new Pacientes();
       if($idPaciente==null){


        $idPaciente=$_SESSION['idTemporal'];
       }

       $_SESSION['idTemporal']=$idPaciente;
  $this->paciente=$paciente->find($idPaciente);


        $listaClinicas = new Historiaclinica();

        $this->listaClinicas = $listaClinicas->find_all_by_sql("SELECT * from historiaclinica inner join pacientes
        	on historiaclinica.pacientes_idPaciente=pacientes.idPaciente where pacientes.idPaciente =$idPaciente 
        	order by historiaclinica.tiempo desc limit 8");

        $_SESSION['historiasClinicasC']=$listaClinicas->find_all_by_sql("SELECT * from historiaclinica inner join pacientes
            on historiaclinica.pacientes_idPaciente=pacientes.idPaciente where pacientes.idPaciente =$idPaciente 
            order by historiaclinica.tiempo asc ");

              $this->f1=null;
              $this->f2=null;


        if(Input::hasPost('prueba')){

              /*Hacer selects con fecha y poner el date como value en la fecha del selector con los array de Academic */

              $fecha1=Input::post("fecha1");
              $fecha2=Input::post("fecha2");

              $_SESSION['fecha1']= $fecha1;
              $_SESSION['fecha2']= $fecha2;
              


              $this->listaClinicas = $listaClinicas->find_all_by_sql("SELECT * from historiaclinica inner join pacientes
            on historiaclinica.pacientes_idPaciente=pacientes.idPaciente where pacientes.idPaciente =$idPaciente and 
            fecha BETWEEN CAST('$fecha1' AS DATE) AND CAST('$fecha2' AS DATE)
            order by historiaclinica.fecha asc");

              $this->f1=$fecha1;
              $this->f2=$fecha2;


 $_SESSION['historiasClinicas']=$listaClinicas->find_all_by_sql("SELECT * from historiaclinica inner join pacientes
            on historiaclinica.pacientes_idPaciente=pacientes.idPaciente where pacientes.idPaciente =$idPaciente and 
            fecha BETWEEN CAST('$fecha1' AS DATE) AND CAST('$fecha2' AS DATE)
            order by historiaclinica.fecha asc ");



        }

	}

public function edit($idHistoriaClinica,$idPaciente){


        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Editando Historias Clinicas";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";

        $historiaclinica = new Historiaclinica();

        $this->historiaClinica= $historiaclinica->find($idHistoriaClinica);

        $paciente = new Pacientes();

        $this->paciente=$paciente->find($idPaciente);

      
    if (Input::hasPost('valN')) {

            
            $historiaclinica->motivoH = Input::post('motivoH');
            $historiaclinica->preDistolica = Input::post('preDiastolica');
            $historiaclinica->preSistolica = Input::post('preSistolica');
            $historiaclinica->frecCardiaca = Input::post('frecCardiaca');
            $historiaclinica->frecRespiratoria = Input::post('frecRespiratoria');
            $historiaclinica->fecha=Input::post('fechaNueva');
          
          
     
               

    
            if (!$historiaclinica->update(Input::post('valN'))) {

                
                 Flash::error('Hubo un error al actualizar la historia clinica.. Verifique la conexión por favor...');
              }
                else{

                Flash::valid('Historia Clinica  actualizada correctamente.');
                Input::delete();
              
               
        $listaClinicas = new Historiaclinica();

        $this->listaClinicas = $listaClinicas->find_all_by_sql("SELECT * from historiaclinica inner join pacientes
        	on historiaclinica.pacientes_idPaciente=pacientes.idPaciente order by historiaclinica.tiempo desc limit 8");

               Redirect::to("historiaclinica/index");


                }

             
    }



}

	public function index(){

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Lista de Historias Clinicas";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";



        $listaClinicas = new Historiaclinica();

        $this->listaClinicas = $listaClinicas->find_all_by_sql("SELECT * from historiaclinica inner join pacientes
        	on historiaclinica.pacientes_idPaciente=pacientes.idPaciente order by historiaclinica.tiempo desc limit 8");



	}


public function crearHistoria($idPaciente){

    date_default_timezone_set("America/Bogota");

	    $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Creando la historia Clinica";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";

        #crear el update paciente dentro del if hasPost
        $paciente = new Pacientes();

        $this->paciente=$paciente->find($idPaciente);

        if (Input::hasPost('valN')) {
        	

        	$motivoH=Input::post('motivoH');
        	$preDistolica=Input::post('preDiastolica');
        	$preSistolica=Input::post('preSistolica');
        	$frecCardiaca=Input::post('frecCardiaca');
        	$frecRespiratoria=Input::post('frecRespiratoria');
        	$tiempo =date("Y-m-d H:i:s");
            $fecha = Input::post('fechaNueva');
            
            //Actualización PROCEDURAL

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
   $conn->set_charset("utf8");
// Check connection
if (!$conn) {
    die("Falló la conexión... Revise que Xampp esté corriendo por favor.: " . mysqli_connect_error());
}

$sql = "INSERT INTO historiaclinica (motivoH, preDistolica,
 preSistolica,frecCardiaca,frecRespiratoria,pacientes_idPaciente,tiempo,fecha)
VALUES ('$motivoH', '$preDistolica', '$preSistolica','$frecCardiaca','$frecRespiratoria','$idPaciente','$tiempo','$fecha')";


if (mysqli_query($conn, $sql)) {
    
            


} else {
    echo "Error creando hsitoria clinica: " . mysqli_error($conn);
}

$sql = "UPDATE pacientes SET hasHistoria=1 WHERE idPaciente=$idPaciente";



if (mysqli_query($conn, $sql)) {
    
              $listaClinicas = new Historiaclinica();

        $this->listaClinicas = $listaClinicas->find_all_by_sql("SELECT * from historiaclinica inner join pacientes
        	on historiaclinica.pacientes_idPaciente=pacientes.idPaciente order by historiaclinica.tiempo desc limit 8");

               
                     
                     Input::delete();
                     Flash::valid('Historia Clinica guardada correctamente.');
                    Redirect::to('historiaclinica/index');


} else {
    echo "Error updating record: " . mysqli_error($conn);
}


mysqli_close($conn);




           


        }# END INF HASPOST
	




}







// Buscar PACIENTES para ASIGNAR
public function buscar(){ 

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Buscando al paciente para su historia Clinica.";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";
        

        $this->listaPacientes=null;


        if (Input::hasPost("valN")) {

            $medicamento= new Medicamentos();
            $nombreP= Input::post("nombreP");


            $sql="SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
     fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps,hasHistoria,
      CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where nombreP like '%$nombreP%' ";
            $this->listaPacientes=$medicamento->find_all_by_sql($sql);

            if($this->listaPacientes== null) {
                Flash::error('Paciente no encontrado, por favor pruebe con otro nombre.');
            }else{

                Flash::valid('Lista de pacientes encontrados....');

            }
        }// End buscar por nombres


        if (Input::hasPost("valA")) {

            $paciente= new Pacientes();
            $nombreP= Input::post("apellidoP");


            $sql="SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
     fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps,hasHistoria,
      CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where  apellidoP like '%$nombreP%' ";
            $this->listaPacientes=$paciente->find_all_by_sql($sql);

            if($this->listaPacientes== null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            }else{

                Flash::valid('Lista de pacientes encontrados....');

            }
        }// End buscar por APELLIDOS


        if (Input::hasPost("valI")) {

            $paciente= new Pacientes();
            $nombreP= Input::post("cedulaP");


            $sql="SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
     fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps,hasHistoria, 
      CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where  cedulaP=$nombreP ";
            $this->listaPacientes=$paciente->find_all_by_sql($sql);

            if($this->listaPacientes== null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            }else{

                Flash::valid('Lista de pacientes encontrados....');

            }
        }// End buscar por IDS


}# END FUNCTION BUSCAR asignar paciente

   public function del($idHistoriaClinica) {

      



        if (Auth::is_valid()) {
            $tipo = Auth::get('rol');
            if ($tipo != null && $tipo == 1) {
                $profesor = new Profesor();
                if (!$profesor->delete($id)) {
                    Flash::error('No se pudo eliminar el profesor.');
                } else {
                    Flash::valid('Se ha eliminado el profesor correctamente');
                }

                $this->listaProfesores = $profesor->getProfesores(1, 10);
                View::select("index");
            } else {
                Redirect::to('inicio/index');
            }
        } else {
            Redirect::to('usuarios/index');
        }
    }

  


}
