<?php

View::template('sbadmin');
session_start();

class MedicamentosController extends AppController {


    public function listar(){

 $medicamento = new Medicamentos();
               
        $this->listaAnadidos = $medicamento->find_all_by_sql("SELECT * 
          from medicamentos order by descripcionM");



    }



    public function edit($idMedicamento){

   
    $this->titulo = "Gestión de Medicamentos";
    $this->subtitulo = "Editar Medicamentos";
    $this->informacion = "Es de humanos equivocarse... Aquí podemos corregir esos errores.";

    $medicamento = new Medicamentos();


    $this->medicamento = $medicamento->find($idMedicamento);


    if (Input::hasPost('idMedicamento')) {


            
            $medicamento->descripcionM = Input::post('descripcionM');
            $medicamento->formaFarmaM = Input::post('formaFarmaM');
            $medicamento->necesidadM = Input::post('necesidadM');
            $medicamento->precio = Input::post('precio');
            $medicamento->tiempo=date("Y-m-d H:i:s");
            $medicamento->descuento= Input::post('descuento');
          
     
               

            if(Input::post('formaFarmaM')==""){
               $medicamento->formaFarmaM ="Por definir";

            }

             if(Input::post('necesidadM')==""){
             $medicamento->necesidadM ="Por definir";
            }

              if(Input::post('precio')==""){
              $medicamento->precio =0;
            }

            if(Input::post('descuento')==""){
                $medicamento->descuento =0;
              }



    
            if (!$medicamento->update(Input::post('idMedicamento'))) {

                
                 Flash::error('Hubo un error al actualizar el medicamento.. Verifique la conexión por favor...');
              }
                else{

                  Flash::valid('Medicamento actualizado correctamente.');
                Input::delete();
              
                $medicamento2= new Medicamentos();
                
        $this->listaPacientes = $medicamento2->find_all_by_sql("SELECT * 
          from medicamentos order by tiempo desc limit 8");
               

               View::select('index');


                }

             
    }


        
    }


   public function crear(){

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Creación de Pacientes";
        $this->informacion = " <b>Carlos Eduardo Urbano </b>- Médico Principal";


 if(Input::hasPost('descripcionM')){

   
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

            $descripcionM=Input::post('descripcionM');
            $formaFarmaM=Input::post('formaFarmaM');
            $necesidadM=Input::post('necesidadM');
            $precio=Input::post('precio');
            $tiempo =date("Y-m-d H:i:s");
            $descuento= Input::post('descuento');
         


        
               

                  $sql = "INSERT INTO medicamentos (descripcionM, formaFarmaM,necesidadM,precio,descuento,tiempo)
                    
                  VALUES ('$descripcionM','$formaFarmaM','$necesidadM',$precio,$descuento,'$tiempo')";

                  if ($conn->query($sql) === TRUE) {
          
                    $medicamento2 = new Medicamentos();
                    $this->listaPacientes = $medicamento2->find_all_by_sql("SELECT *from medicamentos
                     order by tiempo desc limit 8");
               
                     
                     Input::delete();
                     Flash::valid('Medicamento guardado correctamente.');
               

                  } else {
                    echo " " . $conn->error;

                    Flash::error('Hubo un problema al guardar el paciente. Revise que tenga Xampp corriendo.');
                }

                  $conn->close();
                  Input::delete();
                    Redirect::to('medicamentos/index');
                   Flash::valid('Medicamento guardado correctamente.');


       }//If hasPost
    


   }


/* SEPARADOR FUNCIÓN CREAR*/

    public function index() {

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Sistema de Control de Medicamentos";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";


        if (Auth::is_valid()) {
            $tipo = Auth::get('rol');
            if ($tipo != null && $tipo == 1) {

                $paciente= new Pacientes();
                
        $this->listaPacientes = $paciente->find_all_by_sql("SELECT * from medicamentos order by tiempo desc limit 8");
               


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

            $medicamento= new Medicamentos();
            $nombreP= Input::post("nombreP");


            $sql="SELECT * from medicamentos where descripcionM like '%$nombreP%' ";
            $this->listaPacientes=$medicamento->find_all_by_sql($sql);

            if($this->listaPacientes== null) {
                Flash::error('Medicamento no encontrado, por favor pruebe nuevamente con otra parte de su descripción.');
            }else{

                Flash::valid('Lista de medicamentos encontrados....');

            }
        }// End buscar por nombres
    
    /************** SEPARADOR DE FUNCIONES ***********************/


   



    }

    
    public function acerca() {
        
        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Sistema de Control de Pacientes";
        $this->informacion = " <b>Carlos Eduardo Urbano </b>- Médico Principal";
    }

}
