<?php
View::template('sbadmin');
session_start();
class RemisionController extends AppController
{
    public function index()
    {
        Redirect::to('remision/buscarPac');
    }
    
    
    public function generarFormulaM($idPaciente = null)
    {
        if (Input::hasPost('fechaM')) {
            $paciente           = new Pacientes();
            $idPaciente         = $_SESSION['idPaciente'];
            $this->paciente     = $paciente->find($idPaciente);
            $this->date         = Input::post('fechaM');
            $this->nombre       = Input::post('nombreM');
            $this->nit          = Input::post('nitM');
            $this->tel          = Input::post('telM');
            $this->quienEntrega = Input::post("quienEntrega");
            $this->quienRecibe  = Input::post("quienRecibe");
            $this->tipo         = Input::post('tipo');
            
            
        }
    }
    
    public function reciboCaja()
    {
        $this->titulo      = "Gestión de Recibos";
        $this->subtitulo   = "Imprimible para recibo de caja";
        $this->informacion = "Asegúrate de colocar el recibo de manera correcta.";
        
        
        if (Input::hasPost('test')) {
            
            $this->city       = Input::post('city');
            $this->fecha      = Input::post('fecha');
            $this->recibidoDe = Input::post('recibidoDe');
            $this->monto      = Input::post('monto');
            $this->nit        = Input::post('nit');
            $this->dir        = Input::post('dir');
            $this->tel        = Input::post('tel');
            $this->suma       = Input::post('suma');
            $this->concepto   = Input::post('concepto');
            
            View::select('imprimirCaja');
            
        }
        
    }
    
    
    public function verProcedimientos($idTipo)
    {
        $this->titulo            = "Gestión de Procedimientos";
        $this->subtitulo         = "Listando medicamentos para procedimiento escogido";
        $this->informacion       = "Aquí puedes modificar los medicamentos para el procedimiento actual.";
        $procedimientos          = new Procedimientos();
        $tp                      = new Tipoprocedimiento();
        $this->tp                = $tp->find($idTipo);
        $this->listaMedicamentos = $procedimientos->find_all_by_sql("SELECT * from procedimientos where 
 tipoProcedimiento_idTipo=$idTipo");
    }
    
    
    
    public function formularM($idPaciente = null)
    {
        $this->titulo         = "Centro Naturista Mi Salud";
        $this->subtitulo      = "Escogiendo <b>medicamentos</b> para remisión.";
        $this->informacion    = "<b>Carlos Eduardo Urbano </b>- Médico Principal";
        $this->listaPacientes = null;
        
        if ($idPaciente == null) {
            $_SESSION['idPaciente'] = $_SESSION['idPaciente'];
        } else {
            $_SESSION['idPaciente'] = $idPaciente;
        }
        $anadidos                  = new Medicamentos();
        $sqlA                      = "SELECT * from mtemporal order by tiempo desc limit 7";
        $this->listaAnadidos       = $anadidos->find_all_by_sql($sqlA);
        $_SESSION['listaAnadidos'] = $anadidos->find_all_by_sql($sqlA);
        $this->idPaciente69        = $idPaciente;
        
        if (Input::hasPost("valN")) {
            $medicamento                = new Medicamentos();
            $nombreP                    = Input::post("nombreP");
            $sql                        = "SELECT * from medicamentos where descripcionM like '%$nombreP%' ";
            $this->listaPacientes       = $medicamento->find_all_by_sql($sql);
            $_SESSION['listaPacientes'] = $medicamento->find_all_by_sql($sql);
            if ($this->listaPacientes == null) {
                Flash::error('Medicamento no encontrado, por favor pruebe nuevamente con otra parte de su descripción.');
            } else {
                Flash::valid('Lista de medicamentos encontrados....');
            }
        } // End buscar por nombres
    }
    
    public function delListaM($idM)
    {
        /* INICIO SEPARADOR CÓDIGO AÑADIR BASE DE DATOS MYSQLI*/
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "clinic";
        $conn       = new mysqli($servername, $username, $password, $dbname);
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
    
    
    
    public function guardarMedicamentos($idMedicamento = null)
    {
        
        /* ACCION QUE OCURRE CUANDO AÑADIMOS UN MEDICAMENTO A LA TABLA TEMPORAL PRE REMISION*/
        
        $this->titulo          = "Centro Naturista Mi Salud";
        $this->subtitulo       = "Escogiendo <b>medicamentos</b> para remisión.";
        $this->informacion     = "<b>Carlos Eduardo Urbano </b>- Médico Principal";
        $this->listaPacientes2 = null;
        if (Input::hasPost("valN")) {
            $medicamento           = new Medicamentos();
            $nombreP               = Input::post("nombreP");
            $sql                   = "SELECT * from medicamentos where descripcionM like '%$nombreP%' ";
            $this->listaPacientes2 = $medicamento->find_all_by_sql($sql);
            if ($this->listaPacientes2 == null) {
                Flash::error('Medicamento no encontrado, por favor pruebe nuevamente con otra parte de su descripción.');
            } else {
                Flash::valid('Lista de medicamentos encontrados....');
            }
        } // End buscar por medicamentos por nombres
        
        /* Código a ejecutar si se pulsa el botón de añadir medicamento*/
        
        if (Input::post('idMedicamento')) {
            $medicamento     = new Medicamentos();
            $medicamentoTemp = $medicamento->find(intval(Input::post('idMedicamento')));
            
            /* INICIO SEPARADOR CÓDIGO AÑADIR BASE DE DATOS MYSQLI*/
            $servername = "localhost";
            $username   = "root";
            $password   = "";
            $dbname     = "clinic";
            $conn       = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("utf8");
            if ($conn->connect_error) {
                die("Falló la conexión a Clinic. Revise por favor que tenga  Xampp corriendo en su equipo.: " . $conn->connect_error);
            }
            
            $cantidad     = intval(Input::post('cantidad'));
            $descripcionM = $medicamentoTemp->descripcionM;
            $formaFarmaM  = $medicamentoTemp->formaFarmaM;
            $necesidadM   = $medicamentoTemp->necesidadM;
            $valorUni     = $medicamentoTemp->precio;
            $descuento    = $medicamento->descuento;
            $tiempo       = date("Y-m-d H:i:s");
            //PENDIENTE POR CONFIGURAR COMO MEJOR SE VEA.
            $sql          = "INSERT INTO mtemporal (dM,fM,nM,cM,descuento,tiempo,valorUni)

                                                VALUES ('$descripcionM','$formaFarmaM','$necesidadM',$cantidad,$descuento,'$tiempo',$valorUni)";
            if ($conn->query($sql) === TRUE) {
                echo $medicamentoTemp->titulo;
                
                $idPaciente = $_SESSION['idPaciente'];
                Redirect::to('remision/formularM');
                Flash::valid('Medicamento añadido a la fórmula.');
            } else {
                echo " " . $conn->error;
                Flash::error('No se pudo añadir el medicamento a la fórmula.');
            }
            $conn->close();
            /* FINAL SEPARADOR CREAR */
        }
    }
    public function buscarPac()
    {
        $this->titulo         = "Centro Naturista Mi Salud";
        $this->subtitulo      = "Buscando paciente para hacer remisión";
        $this->informacion    = "<b>Carlos Eduardo Urbano </b>- Médico Principal";
        $this->listaPacientes = null;
        if (Input::hasPost("valN")) {
            $paciente             = new Pacientes();
            $nombreP              = Input::post("nombreP");
            $sql                  = "SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
            fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
            CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where nombreP like '%$nombreP%' ";
            $this->listaPacientes = $paciente->find_all_by_sql($sql);
            if ($this->listaPacientes == null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            } else {
                Flash::valid('Lista de pacientes encontrados....');
            }
        } // End buscar por nombres
        if (Input::hasPost("valA")) {
            $paciente             = new Pacientes();
            $nombreP              = Input::post("apellidoP");
            $sql                  = "SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
            fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
            CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where  apellidoP like '%$nombreP%' ";
            $this->listaPacientes = $paciente->find_all_by_sql($sql);
            if ($this->listaPacientes == null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            } else {
                Flash::valid('Lista de pacientes encontrados....');
            }
        } // End buscar por nombres
        if (Input::hasPost("valI")) {
            $paciente             = new Pacientes();
            $nombreP              = Input::post("cedulaP");
            $sql                  = "SELECT idPaciente,cedulaP,nombreP,apellidoP,dirP,celP,profesion,peso,
            fechaNaciP,estaturaP,rhP,genero,alergias,discapacidades,eps, 
            CURDATE(),TIMESTAMPDIFF(YEAR,fechaNaciP,CURDATE()) AS age from pacientes where  cedulaP=$nombreP ";
            $this->listaPacientes = $paciente->find_all_by_sql($sql);
            if ($this->listaPacientes == null) {
                Flash::error('Paciente no encontrado, por favor pruebe nuevamente con otro nombre, apellido ó cédula.');
            } else {
                Flash::valid('Lista de pacientes encontrados....');
            }
        } // End buscar por nombres
    }
}