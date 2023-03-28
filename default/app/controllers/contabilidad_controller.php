<?php


View::template('sbadmin');
session_start();
date_default_timezone_set("America/Bogota");


class ContabilidadController extends AppController {


    public function imprimirInformeContable(){

        $this->fechaInicial = $_SESSION['fechaInicial'];
        $this->fechaFinal = $_SESSION['fechaFinal'];
        $this->listaRegistros = $_SESSION['listaRegistros'];
        $this->sumaTotal = $_SESSION['sumaTotal'];


    }


    public function sumar(){

        $this->titulo = "Gestión contable de Clinic";
		$this->subtitulo = "Aquí podrá ver el resultado de las entradas y salidas por fechas.";
		$this->informacion = "Podrá observar el historial completo por fechas e imprimir un informe de ellas.";


        if(Input::hasPost('valI')){

            $fechaInicial = Input::post('fechaInicial');
            $fechaFinal   = Input::post('fechaFinal');

            $registro = new Contabilidad();

            $this->fecha1 = $fechaInicial;
            $this->fecha2 = $fechaFinal;

            $_SESSION['fechaInicial']= $fechaInicial;
            $_SESSION['fechaFinal']= $fechaFinal;


            

             $this->listaCreditos = $registro->find_all_by_sql("SELECT * from contabilidad where fecha between 
             '$fechaInicial' and '$fechaFinal' order by fecha asc ");

             $t = $registro->find_by_sql("SELECT SUM(monto) as suma from saldo where  fecha between 
             '$fechaInicial' and '$fechaFinal' ");

             $this->saldoFinal = $t->suma;

             $_SESSION['listaRegistros']= $registro->find_all_by_sql("SELECT * from contabilidad where fecha between 
             '$fechaInicial' and '$fechaFinal' order by fecha asc ");
            
             $_SESSION['sumaTotal']=$t->suma;

            

        }//end if HasPost


    }//end function sumar

    public function edit($idRegistro){

        $this->titulo = "Gestión contable de Clinic";
		$this->subtitulo = "Aquí podrá EDITAR los registros que haya introducido para una fecha.";
		$this->informacion = "Modifique los registros con la nueva información o valor.";

        $registro = new Contabilidad();

        $this->register = $registro->find_by_sql("SELECT * from contabilidad where id=$idRegistro");

        $r =$registro->find_by_sql("SELECT * from contabilidad where id=$idRegistro");
        $sel = $r->tipoIngEgre;

        $primeraFecha = $r->fecha;

        $array1 = array();
            if ($sel == "Entrada") $array1[0] = 'selected'; else $array1[0] = '';
            if ($sel == "Salida") $array1[1] = 'selected'; else $array1[1] = '';

        $this->selector = $array1;

        if(Input::hasPost('editVar')){

            $fecha = Input::post('fechaF');
			$concepto=Input::post('conceptoF');
            $monto = Input::post('montoF');
            $tipo = Input::post('tipo');

                    
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

                

               //Primero actualizamos el registro 

                $sql = "UPDATE contabilidad SET fecha='$fecha', monto=$monto, concepto='$concepto',tipoIngEgre='$tipo' WHERE id=$idRegistro ";

                            if ($conn->query($sql) === TRUE) {
                              
                            } else {
                                
                            }

                $creditos = new Contabilidad();

                if($fecha==$primeraFecha){

                    $sql="SELECT SUM(monto) as suma from contabilidad  where tipoIngEgre ='Entrada' and fecha = '$fecha' ";
                $sumaPositiva=$creditos->find_by_sql($sql);
                 $sql="SELECT SUM(monto) as suma from contabilidad  where tipoIngEgre ='Salida' and fecha='$fecha'                ";
                $sumaNegativa=$creditos->find_by_sql($sql);


                $montoFinal = floatval($sumaPositiva->suma) - floatval($sumaNegativa->suma);
                 $sql = "UPDATE saldo SET monto = $montoFinal where fecha ='$fecha'";

                         

                if ($conn->query($sql) === TRUE) {
                Flash::valid('Registro actualizado correctamente');
               
                Redirect::to("contabilidad/index");
                } else {
                    Flash::error('No se pudo actualizar el registro, revise los datos por favor.');
                Redirect::to("contabilidad/index");
                }




                }else{

                    // 2 sql de las dos fechas

                    /* SQL 1*/
                $sql="SELECT SUM(monto) as suma from contabilidad  where tipoIngEgre ='Entrada' and fecha = '$fecha' ";
                $sumaPositiva=$creditos->find_by_sql($sql);

                $sql="SELECT SUM(monto) as suma from contabilidad  where tipoIngEgre ='Salida' and fecha='$fecha'                ";
                $sumaNegativa=$creditos->find_by_sql($sql);


                $montoFinal = floatval($sumaPositiva->suma) - floatval($sumaNegativa->suma);
                 $sql = "UPDATE saldo SET monto = $montoFinal where fecha ='$fecha'";

                         

                if ($conn->query($sql) === TRUE) {
                
                } else {
                    
                }
                    /* SQL 1 FIN */

                    /* SQL 2*/
                $sql="SELECT SUM(monto) as suma from contabilidad  where tipoIngEgre ='Entrada' and fecha = '$primeraFecha' ";
                $sumaPositiva=$creditos->find_by_sql($sql);

                $sql="SELECT SUM(monto) as suma from contabilidad  where tipoIngEgre ='Salida' and fecha='$primeraFecha'                ";
                $sumaNegativa=$creditos->find_by_sql($sql);


                $montoFinal = floatval($sumaPositiva->suma) - floatval($sumaNegativa->suma);
                 $sql = "UPDATE saldo SET monto = $montoFinal where fecha ='$primeraFecha'";

                         

                if ($conn->query($sql) === TRUE) {
                Flash::valid('Registro actualizado correctamente');
               
                Redirect::to("contabilidad/index");
                } else {
                    Flash::error('No se pudo actualizar el registro, revise los datos por favor.');
                Redirect::to("contabilidad/index");
                }
                    /* SQL 2 FIN */

                   


                }


                 

                


                //Actualizamos el saldo pero cuando el registro cambia de fecha, 

               




                $conn->close();

                        }
        

    }

    public function verMasPorFecha2($idSaldo){

       $this->titulo = "Gestión contable de Clinic";
		$this->subtitulo = "Aquí podrá ver que registros y el saldo para ese día, para la fecha seleccionada.";
		$this->informacion = "Cada registro  es editable.";

        $registro = new Contabilidad();
        $saldoEncontrado = $registro->find_by_sql("SELECT * from saldo where id =$idSaldo");
        $fechaBusqueda = $saldoEncontrado->fecha;

        $this->listaCreditos = $registro->find_all_by_sql("SELECT * from contabilidad where fecha ='$fechaBusqueda'");

        $this->listaSaldos = $registro->find_all_by_sql("SELECT * from saldo where fecha ='$fechaBusqueda'");
        $this->fechaSeleccionada = $fechaBusqueda;


	}


	public function verMasPorFecha($idRegistro){

       $this->titulo = "Gestión contable de Clinic";
		$this->subtitulo = "Aquí podrá ver que registros y el saldo para ese día, para la fecha seleccionada.";
		$this->informacion = "Cada registro  es editable.";

        $registro = new Contabilidad();
        $registroEncontrado = $registro->find_by_sql("SELECT * from contabilidad where id =$idRegistro");
        $fechaBusqueda = $registroEncontrado->fecha;

        $this->listaCreditos = $registro->find_all_by_sql("SELECT * from contabilidad where fecha ='$fechaBusqueda'");

        $this->listaSaldos = $registro->find_all_by_sql("SELECT * from saldo where fecha ='$fechaBusqueda'");
        $this->fechaSeleccionada = $fechaBusqueda;


	}



	public function create(){

		$this->titulo = "Gestión contable de Clinic";
		$this->subtitulo = "Aquí podrá crear los registros diarios.";
		$this->informacion = "Introduzca la fecha correcta para cada registro.";

		if(Input::hasPost('idProF')){

			$fecha = Input::post('fechaF');
			$concepto=Input::post('conceptoF');
			//$fecha =date("Y-m-d");
			$created_at=date("Y-m-d H:i:s");
            $monto = Input::post('montoF');
            $tipo = Input::post('tipo');

                    
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

                 $creditos = new Creditos();
                $sql="SELECT * from saldo  where fecha ='$fecha'
                ";
                $saldoBuscado=$creditos->find_by_sql($sql);

                $montoActual = $saldoBuscado->monto;

                if($tipo=='Entrada'){

                    $montoFinal = $montoActual+$monto;
                }else{
                    $montoFinal = $montoActual-$monto;
                    }


                $sql = "UPDATE saldo SET monto=$montoFinal WHERE fecha='$fecha'";

                            if ($conn->query($sql) === TRUE) {
                              
                            } else {
                                
                            }



                $sql = "INSERT INTO contabilidad (fecha,concepto,monto,created_at,tipoIngEgre)
                VALUES ('$fecha', '$concepto', $monto,'$created_at','$tipo')";

                if ($conn->query($sql) === TRUE) {
                Flash::valid('Registro guardado correctamente');
                Redirect::to("contabilidad/index");
                } else {
                    Flash::error('No se pudo guardar el registro, revise los datos por favor.');
                Redirect::to("contabilidad/index");
                }






                $conn->close();

                        }




	}


	public function buscar(){

        $this->titulo = "Gestión contable de Clinic";
		$this->subtitulo = "Aquí podrá crear los registros diarios.";
		$this->informacion = "Introduzca la fecha correcta para cada registro.";


    

         if (Input::hasPost("valI")) {

          
            $fechaBusqueda= Input::post("cedulaP");


              $registro = new Contabilidad();
              $this->fechaSeleccionada = $fechaBusqueda; 
               $this->listaCreditos = $registro->find_all_by_sql("SELECT * from contabilidad where fecha ='$fechaBusqueda'");

               $this->listaSaldos = $registro->find_all_by_sql("SELECT * from saldo where fecha ='$fechaBusqueda'");
            

            if($this->listaCreditos== null) {
                Flash::error('No hay registros, por favor pruebe con otra fecha.');
                Redirect::to('contabilidad/index');

            }else{

                Flash::valid('Listando los registros para la fecha escogida. ');
                
                
                Input::delete();

            }
        }// End buscar por fecha

	}


	public function index(){

		$this->titulo = "Contabilidad";
		$this->subtitulo = "Aquí podrá mantener un registro de las entradas y salidas en su clinica.";
		$this->informacion = "Se listarán las últimas 10 entradas/salidas y abajo los saldos de las <b>últimas</b> fechas.";

		$contable = new Contabilidad();
		$sql="SELECT * from contabilidad  order by created_at desc limit 10";
		$this->listaCreditos=$contable->find_all_by_sql($sql);

        $hoy = date("Y-m-d");
        $manana   = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));

        $ayer   = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));

        
        $five = date("Y-m-d", strtotime( '-5 days' ) );



        $saldo = new Contabilidad(); // rango de 4 entre la fecha diaria -2 hacia atrás rango 4
		$sqlS="SELECT * from saldo where fecha between '$five' and '$hoy'     order by fecha desc ";
		$this->listaSaldos=$saldo->find_all_by_sql($sqlS);

        /* 
        
        Cuando me cree un egreso/ingreso actualice el saldo que está para esa fecha, los 
        saldos serán creados dinámicamente, ver forma de ordenamiento
        
        */






		





	}





}

?>