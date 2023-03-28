<?php

View::template('sbadmin');
session_start();


class FormulaController extends AppController {


    public function index(){


        Redirect::to('formula/buscarPac');
    }

    public function generarFormulaE(){

    if (Input::hasPost('idPaciente')) {

      $paciente = new Pacientes();
      $idPaciente=Input::post('idPaciente');
      $this->paciente = $paciente->find($idPaciente);
      $this->idPaciente= $idPaciente;

      $this->date=date("Y-m-d");

      
      $this->e= explode("-",Input::post('exams'));




    }

     

    }



    public function formularE($idPaciente){
    

        $this->titulo = "Generación de órdenes para exámenes";
        $this->subtitulo = "Por favor introduzca un máximo de 8 exámenes por fórmula.";
        $this->informacion = "No olvide presionar ENTER para un nuevo examen.";


      $paciente = new Pacientes();
      $this->paciente = $paciente->find($idPaciente);

      $this->idPaciente=$idPaciente;
     




    }


    public function generarFormulaM($idPaciente=null){


if (Input::hasPost('fechaM')) {
     $paciente = new Pacientes();
      $idPaciente=$_SESSION['idPaciente'];
      $this->paciente = $paciente->find($idPaciente);
      $this->date=Input::post('fechaM');
      
 
}
       
      


    }


     public function generarFormulaP(){

     // $this->listaProcedimientosT=null;

       
      $paciente = new Pacientes();
      $idPaciente=$_SESSION['idPaciente2'];
      $this->paciente = $paciente->find($idPaciente);

      if (Input::hasPost('fechaP')) {

         $this->date= Input::post('fechaP');

      $pacienteComp=$paciente->find($idPaciente);
      $idTipo=Input::post('idTipo');

if($idTipo==4 or $idTipo==5){

$this->s=2;

}else{

    $this->s=1;
}


if ($pacienteComp->genero=="M" and $idTipo==5) {

$this->listaAnadidos=$paciente->find_all_by_sql("SELECT * from procedimientos where 
 tipoProcedimiento_idTipo=$idTipo and idPro!=43 ");

    
}elseif($pacienteComp->genero=="F"  and $idTipo==5){

$this->listaAnadidos=$paciente->find_all_by_sql("SELECT * from procedimientos where 
 tipoProcedimiento_idTipo=$idTipo and idPro!=42 ");

}else{
      $this->listaAnadidos=$paciente->find_all_by_sql("SELECT * from procedimientos where 
 tipoProcedimiento_idTipo=$idTipo ");
}
       
      }

     




    }

     public function verProcedimientos($idTipo) {

        $this->titulo = "Gestión de Procedimientos";
        $this->subtitulo = "Listando medicamentos para procedimiento escogido";
        $this->informacion = "Aquí puedes modificar los medicamentos para el procedimiento actual.";

        $procedimientos = new Procedimientos();
        $tp = new Tipoprocedimiento();

        $this->tp = $tp->find($idTipo);




        $this->listaMedicamentos = $procedimientos->find_all_by_sql("SELECT * from procedimientos where 
 tipoProcedimiento_idTipo=$idTipo");
    }

    public function formularP($idPaciente=null){

   $this->titulo = "Centro Naturista Mi Salud";
    $this->subtitulo = "Escogiendo el prodecimiento  para formular.";
    $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";

    if($idPaciente==null)
{
    $_SESSION['idPaciente2']= $_SESSION['idPaciente2'];
}else
{

    $_SESSION['idPaciente2']= $idPaciente;

}
   



   $this->listaProcedimientosT= $_SESSION['listaProcedimientosT'];



   if (Input::hasPost("nombreProF")) {

            $procedimientoT = new Tipoprocedimiento();
            $nombrePro = Input::post("nombreProF");
            $sql = "SELECT * from tipoProcedimiento where tituloTipo like '%$nombrePro%'";
            $this->listaProcedimientosT = $procedimientoT->find_all_by_sql($sql);

            $_SESSION['listaProcedimientosT']=$procedimientoT->find_all_by_sql($sql);

            $_SESSION['comparador']=1;

            if ($this->listaProcedimientosT == null) {
                Flash::error('Procedimiento  no encontrado, asegúrese de que existe en CLinic.');
            }
        }

    }


public function formularM($idPaciente=null){

    $this->titulo = "Centro Naturista Mi Salud";
    $this->subtitulo = "Escogiendo <b>medicamentos</b> para formular.";
    $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";

    $this->listaPacientes=null;

    if ($idPaciente==null) {
        $_SESSION['idPaciente']=$_SESSION['idPaciente'];
    }else{$_SESSION['idPaciente']=$idPaciente;}

    

     $anadidos = new Medicamentos();
       $sqlA="SELECT * from mtemporal order by tiempo desc limit 7";

       $this->listaAnadidos=$anadidos->find_all_by_sql($sqlA);
       $_SESSION['listaAnadidos']=$anadidos->find_all_by_sql($sqlA);

       
  $this->idPaciente69= $idPaciente;


    if (Input::hasPost("valN")) {

        $medicamento= new Medicamentos();
        $nombreP= Input::post("nombreP");


        $sql="SELECT * from medicamentos where descripcionM like '%$nombreP%' ";
        $this->listaPacientes=$medicamento->find_all_by_sql($sql);

        $_SESSION['listaPacientes']=$medicamento->find_all_by_sql($sql);

        if($this->listaPacientes== null) {
            Flash::error('Medicamento no encontrado, por favor pruebe nuevamente con otra parte de su descripción.');
        }else{

            Flash::valid('Lista de medicamentos encontrados....');

        }
        }// End buscar por nombres







    }



    public function delListaM($idM){

            /* INICIO SEPARADOR CÓDIGO AÑADIR BASE DE DATOS MYSQLI*/
         $servername = "localhost";
         $username = "root";
         $password = "";
         $dbname = "clinic";


         $conn = new mysqli($servername, $username, $password, $dbname);
         $conn->set_charset("utf8");

         if ($conn->connect_error) {
            die("Falló la conexión a Clinic. Revise por favor que tenga  Xampp corriendo en su equipo.: " . $conn->connect_error);
        }

        $sql = "DELETE FROM mtemporal where idM=$idM";

        if ($conn->query($sql) === TRUE) {
       
           Flash::valid('Medicamento eliminado de la próxima fórmula.');


        } else {
            echo " " . $conn->error;

            Flash::error('No se pudo eliminar el medicamento de la fórmula.');
        }

        $conn->close();
        Redirect::to('formula/formularM');


    }

    


    public function guardarMedicamentos($idMedicamento=null){

       $this->titulo = "Centro Naturista Mi Salud";
       $this->subtitulo = "Escogiendo <b>medicamentos</b> para formular.";
       $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";

       $this->listaPacientes2=null;


       if (Input::hasPost("valN")) {

        $medicamento= new Medicamentos();
        $nombreP= Input::post("nombreP");


        $sql="SELECT * from medicamentos where descripcionM like '%$nombreP%' ";
        $this->listaPacientes2=$medicamento->find_all_by_sql($sql);

        if($this->listaPacientes2== null) {
            Flash::error('Medicamento no encontrado, por favor pruebe nuevamente con otra parte de su descripción.');
        }else{

            Flash::valid('Lista de medicamentos encontrados....');

        }
        }// End buscar por medicamentos por nombres

      


        if(Input::post('idMedicamento')){

         $medicamento = new Medicamentos();
         $medicamentoTemp =$medicamento->find(intval(Input::post('idMedicamento')));

         /* INICIO SEPARADOR CÓDIGO AÑADIR BASE DE DATOS MYSQLI*/
         $servername = "localhost";
         $username = "root";
         $password = "";
         $dbname = "clinic";


         $conn = new mysqli($servername, $username, $password, $dbname);
         $conn->set_charset("utf8");

         if ($conn->connect_error) {
            die("Falló la conexión a Clinic. Revise por favor que tenga  Xampp corriendo en su equipo.: " . $conn->connect_error);
        }

        $cantidad= intval(Input::post('cantidad'));
        $descripcionM=$medicamentoTemp->descripcionM;
        $formaFarmaM=$medicamentoTemp->formaFarmaM;
        $necesidadM=$medicamentoTemp->necesidadM;
        $tiempo=date("Y-m-d H:i:s");

        //PENDIENTE POR CONFIGURAR COMO MEJOR SE VEA.



        $sql = "INSERT INTO mtemporal (dM,fM,nM,cM,tiempo)

        VALUES ('$descripcionM','$formaFarmaM','$necesidadM',$cantidad,'$tiempo')";

        if ($conn->query($sql) === TRUE) {


      echo $medicamentoTemp->titulo;

           //View::select('formularM');
      $idPaciente=$_SESSION['idPaciente'];

           Redirect::to('formula/formularM');
           Flash::valid('Medicamento añadido a la fórmula.');


        } else {
            echo " " . $conn->error;

            Flash::error('No se pudo añadir el medicamento a la fórmula.');
        }

        $conn->close();




        /* FINAL SEPARADOR CREAR */




    }









}




   



    public function buscarPac(){


        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Buscando paciente para formular.";
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



 


}
