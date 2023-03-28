<?php


View::template('sbadmin');
session_start();
date_default_timezone_set("America/Bogota");


class CreditosController extends AppController {

	public function imprimirListaCreditos(){
		$credito = new Creditos();

		$this->listaCreditos = $credito->find_all_by_sql("SELECT * from creditos inner join pacientes
		 on pacientes_idPaciente=idPaciente order by deuda desc limit 30");

		 $this->deudaTotal = $credito->find_by_sql("SELECT SUM(deuda) as suma from creditos inner join pacientes
		 on pacientes_idPaciente=idPaciente order by deuda desc limit 30");


	}

	public function imprimirListaCreditosAll(){

		$credito = new Creditos();


		$this->listaCreditos = $credito->find_all_by_sql("SELECT * from creditos inner join pacientes on
		 pacientes_idPaciente=idPaciente order by deuda desc ");

		 $this->deudaTotal = $credito->find_by_sql("SELECT SUM(deuda) as suma from creditos inner join pacientes
		 on pacientes_idPaciente=idPaciente order by deuda desc ");
	}

	public function deudores(){

		$this->titulo = "Edición de Créditos";
		$this->subtitulo = "Aquí podremos ver los deudores morosos críticos";
		$this->informacion = "La lista se compondrá con los 30 primeros.";

		$credito = new Creditos();

		$this->listaCreditos = $credito->find_all_by_sql("SELECT * from creditos inner join pacientes on
		 pacientes_idPaciente=idPaciente order by deuda desc limit 30");

		 $this->deudaTotal = $credito->find_by_sql("SELECT SUM(deuda) as suma from creditos inner join pacientes
		 on pacientes_idPaciente=idPaciente order by deuda desc limit 30 ");

	}



	public function deudoresAll(){

		$this->titulo = "Edición de Créditos";
		$this->subtitulo = "Lista Completa de créditos.";
		$this->informacion = "Aquí se listarán todos los deudores en orden descendente.";
		$credito = new Creditos();


		$this->listaCreditos = $credito->find_all_by_sql("SELECT * from creditos inner join
		 pacientes on pacientes_idPaciente=idPaciente order by deuda desc ");

		 $this->deudaTotal = $credito->find_by_sql("SELECT SUM(deuda) as suma from creditos inner join pacientes
		 on pacientes_idPaciente=idPaciente order by deuda desc ");
	}

	public function edit2($idCredito){

  	$credito = new Creditos();

    $this->credito = $credito->find($idCredito);

	$deuda=0;
	$des="Deuda Cancelada!";
	$idCredito1=$idCredito;

	$fechaMod=date("Y-m-d H:i:s");


				
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "clinic";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->set_charset("utf8");
		// Check connection
		if ($conn->connect_error) {
			die("Falló la conexión: " . $conn->connect_error);
		} 

		$sql = "UPDATE creditos SET deuda=$deuda,fechaMod='$fechaMod',des='$des' WHERE idCredito=$idCredito1";

					if ($conn->query($sql) === TRUE) {
						Flash::valid('Se cancelò la deuda correctamente.');
		Redirect::to("creditos/index");
						
					} else {
						Flash::error('No se pudo cancelar la deuda, revise su conexiòn a Xampp.');
		Redirect::to("creditos/index");
						
					}


		$conn->close();




	}

	public function edit($idCredito){
   
        $this->titulo = "Edición de Créditos";
		$this->subtitulo = "Aquí podremos editar los respectivos créditos.";
		$this->informacion = "Modifique los datos dependiendo el cambio del estado del crédito.";

    $credito = new Creditos();

    $this->credito = $credito->find($idCredito);

    $credito1=$credito->find($idCredito);

    $paciente = new Pacientes();

    $this->paciente=$paciente->find($credito1->pacientes_idPaciente);

    if (Input::hasPost('valVayne')) {

    	$tipoMonto=intval(Input::post('tipoMonto'));
    	$monto = Input::post('both');
    	$des=Input::post('des');

    	if ($tipoMonto==1) {

    		$deuda=$credito1->deuda - $monto;
    		
    	}else{

       $deuda=$credito1->deuda + $monto;

    	}


			

			$fechaMod=date("Y-m-d H:i:s");

     
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Falló la conexión: " . $conn->connect_error);
} 

$sql = "UPDATE creditos SET deuda=$deuda,fechaMod='$fechaMod',des='$des' WHERE idCredito=$idCredito";

			if ($conn->query($sql) === TRUE) {
				Flash::valid('Crédito actualizado correctamente');
   Redirect::to("creditos/index");
				
			} else {
				 Flash::error('No se pudo actualizar el crédito, revise los datos por favor.');
   Redirect::to("creditos/index");
				
			}


$conn->close();
       
    	
    }

    	


	}



	public function ver($idPaciente){

        $this->titulo = "Edición de Créditos";
		$this->subtitulo = "Aquí podremos editar los respectivos créditos.";
		$this->informacion = "Viendo actualmente crédito del paciente seleccionado.";

     $creditos = new Creditos();
		$sql="SELECT * from creditos inner join pacientes on pacientes_idPaciente=idPaciente where pacientes.idPaciente =$idPaciente 
		 ";
		$this->listaCreditos=$creditos->find_all_by_sql($sql);



	}



	public function crear($idPaciente){

		$this->titulo = "Creación de Créditos";
		$this->subtitulo = "Aquí podrá describir el origen del crédito para su paciente.";
		$this->informacion = "Introduzca la descripción del crédito por favor.";

		if(Input::hasPost('valAle')){

			$des = Input::post('des');
			$deuda=Input::post('deuda');
			$fecha =date("Y-m-d");
			$fechaMod=date("Y-m-d H:i:s");

     
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Falló la conexión: " . $conn->connect_error);
} 

$sql = "UPDATE pacientes SET hasCredito=1 WHERE idPaciente=$idPaciente";

			if ($conn->query($sql) === TRUE) {
				
			} else {
				
			}



$sql = "INSERT INTO creditos (des,fecha,fechaMod,deuda,pacientes_idPaciente)
VALUES ('$des', '$fecha', '$fechaMod','$deuda',$idPaciente)";

if ($conn->query($sql) === TRUE) {
   Flash::valid('Crédito guardado correctamente');
   Redirect::to("creditos/index");
} else {
    Flash::error('No se pudo guardar el crédito, revise los datos por favor.');
   Redirect::to("creditos/buscar");
}






$conn->close();

		}




	}


	public function buscar(){


    if (Input::hasPost("valN")) {


    	$this->titulo = "Edición de Créditos";
		$this->subtitulo = "Aquí podrá mantener un registro de los créditos otorgados.";
		$this->informacion = "Se listarán los pacientes que ha buscado...";




            $historiaclinica= new Historiaclinica();
            $nombreP= Input::post("nombreP");


            $sql="SELECT * from pacientes where nombreP like '%$nombreP%' ";

            $this->listaCreditos=$historiaclinica->find_all_by_sql($sql);

            if($this->listaCreditos== null) {
                Flash::error('No hay pacientes, por favor pruebe con otro nombre.');
            }else{

                Flash::valid('Listando los pacientes encontrados con ese nombre.... ');
               
                Input::delete();

            }
        }// End buscar por nombres

         if (Input::hasPost("valN")) {

            $historiaclinica= new Historiaclinica();
            $nombreP= Input::post("apellidoP");


           $sql="SELECT * from pacientes where apellidoP like '%$nombreP%' ";

            $this->listaCreditos=$historiaclinica->find_all_by_sql($sql);

            if($this->listaCreditos== null) {
                Flash::error('No hay pacientes, por favor pruebe con otro apellido.');
            }else{

                Flash::valid('Listando los pacientes encontrados con ese apellido.... ');
                
                Input::delete();

            }
        }// End buscar por apellido

         if (Input::hasPost("valI")) {

            $historiaclinica= new Historiaclinica();
            $nombreP= Input::post("cedulaP");


            $sql="SELECT * from pacientes where cedulaP= $nombreP ";

            $this->listaCreditos=$historiaclinica->find_all_by_sql($sql);

            if($this->listaCreditos== null) {
                Flash::error('No hay pacientes, por favor pruebe con otro número de cédula o revise el que introdujo.');
            }else{

                Flash::valid('Listando el paciente encontrado con la cédula anterior. ');
                
                Input::delete();

            }
        }// End buscar por identificacion

	}


	public function index(){

		$this->titulo = "Gestión de Deudas";
		$this->subtitulo = "Aquí podrá mantener un registro de los créditos otorgados.";
		$this->informacion = "Se listarán los últimos 8 créditos creados o modificados...";

		$creditos = new Creditos();
		$sql="SELECT * from creditos inner join pacientes on pacientes_idPaciente=idPaciente order by fechaMod desc limit 8";
		$this->listaCreditos=$creditos->find_all_by_sql($sql);


		if (Input::hasPost('abonar')) {

			$abonar = Input::post('abonar');
			$idCredito = Input::post('idCredito');
			$creditoAbo = new Creditos();
			$creditoObject = $creditoAbo->find(Input::post('idCredito'));

			$total = $creditoObject->deuda - $abonar;
			date_default_timezone_set("America/Bogota");
			$date=date("Y-m-d H:i:s");



			/* CÓDIGO PARA ACTUALIZAR CRÉDITO*/

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "clinic";

// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			$conn->set_charset("utf8");
// Check connection
			if ($conn->connect_error) {
				die("Falló la conexión: " . $conn->connect_error);
			} 

			$sql = "UPDATE creditos SET deuda=$total, fechaMod='$date' WHERE idCredito=$idCredito";

			if ($conn->query($sql) === TRUE) {
				Flash::valid("Crédito actualizado satisfactoriamente");

				$sql="SELECT * from creditos inner join pacientes on pacientes_idPaciente=idPaciente
				 order by fechaMod desc limit 8";
		        $this->listaCreditos=$creditos->find_all_by_sql($sql);

		        Redirect::to('creditos/index');
			} else {
				Flash::error("Ocurrió un error durante la actualización...: ");
				$sql="SELECT * from creditos inner join pacientes on pacientes_idPaciente=idPaciente  order by fechaMod desc limit 8";
		        $this->listaCreditos=$creditos->find_all_by_sql($sql);

		        Redirect::to('creditos/index');
			}

			$conn->close();

			/* FIN CÓDIGO ACTUALIZAR CRÉDITO*/
		}// END ABONAR

		if (Input::hasPost('aumentar')) {

			$aumentar = Input::post('aumentar');
			$idCredito = Input::post('idCredito');
			$creditoAbo = new Creditos();
			$creditoObject = $creditoAbo->find(Input::post('idCredito'));

			$total = $creditoObject->deuda + $aumentar;
			date_default_timezone_set("America/Bogota");
			$date=date("Y-m-d H:i:s");



			/* C+ODIGO PARA ACTUALIZAR CRÉDITO*/

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "clinic";

// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
			if ($conn->connect_error) {
				die("Falló la conexión: " . $conn->connect_error);
			} 

			$sql = "UPDATE creditos SET deuda=$total, fechaMod='$date' WHERE idCredito=$idCredito";

			if ($conn->query($sql) === TRUE) {
				Flash::valid("Crédito actualizado satisfactoriamente");

				$sql="SELECT * from creditos inner join pacientes on pacientes_idPaciente=idPaciente order by fechaMod desc limit 8";
		        $this->listaCreditos=$creditos->find_all_by_sql($sql);

		        Redirect::to('creditos/index');
			} else {
				Flash::error("Ocurrió un error durante la actualización...: ");
				$sql="SELECT * from creditos inner join pacientes on pacientes_idPaciente=idPaciente order by fechaMod desc limit 8";
		        $this->listaCreditos=$creditos->find_all_by_sql($sql);

		        Redirect::to('creditos/index');
			}

			$conn->close();

			/* FIN CÓDIGO ACTUALIZAR CRÉDITO*/
		}// END ABONAR





	}





}

?>