<?php

View::template('sbadmin');
session_start();

class ProcedimientosController extends AppController {

    public function procedimientos() {

        $this->titulo = "Gestión de Procedimientos";
        $this->subtitulo = "Actualización de Procedimientos";
        $this->informacion = "En está sección puede ver los medicamentos de los procedimientos.";

        $idPro = $_SESSION['idPro'];
        $idTipo = $_SESSION['idTipo'];


        $procedimiento1 = new Procedimientos();
        $tp = new Tipoprocedimiento();

        $this->tp = $tp->find($idTipo);


        $this->listaMedicamentos = $procedimiento1->find_all_by_sql("SELECT * from procedimientos where 
 tipoProcedimiento_idTipo=$idTipo");
        View::select('verProcedimientos');
    }

    public function editMedicamento($idPro, $idTipo) {

           $this->titulo = "Gestión de Procedimientos";
        $this->subtitulo = "Actualización de Procedimientos";
        $this->informacion = "En está sección puede editar los medicamentos de los procedimientos.";

        $_SESSION['idPro'] = $idPro;
        $_SESSION['idTipo'] = $idTipo;


        if (Auth::is_valid()) {
            $tipo = Auth::get('rol');
            if ($tipo != null && $tipo == 1) {
                $procedimiento = new Procedimientos();

                if (Input::hasPost("idPro")) {

                    $this->procedimiento = $procedimiento->find(Input::post("idPro"));

                    $procedimiento->cantidad = Input::post('cF');
                    $procedimiento->descripcionPro = Input::post('dF');
                    $procedimiento->formaFarma = Input::post('ffF');
                    $procedimiento->necesidad = Input::post('nF');



                    if (!$procedimiento->update(Input::post('idPro'))) {
                        Flash::error('No se pudo actualizar el medicamento correctamente!');
                    } else {

                        Flash::valid('Se actualizó el medicamento correctamente!');
                        $idPro = $_SESSION['idPro'];
                        $idTipo = $_SESSION['idTipo'];


                        $procedimiento1 = new Procedimientos();
                        $tp = new Tipoprocedimiento();

                        $this->tp = $tp->find($idTipo);


                        $this->listaMedicamentos = $procedimiento1->find_all_by_sql("SELECT * from procedimientos where 
                           tipoProcedimiento_idTipo=$idTipo");
                        View::select('verProcedimientos');
                    }
                } else {
                    $this->procedimiento = $procedimiento->find($idPro);
                }
            } else {
                Redirect::to('inicio/index');
            }
        } else {
            Redirect::to('usuarios/index');
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

    public function buscar() {

        $this->titulo = "Gestión de Procedimientos";
        $this->subtitulo = "Busqueda de Procedimientos";
        $this->informacion = "En está sección puede buscar todos los prode creados en Clinic.";


        $this->listaProcedimientosT = null;

        if (Input::hasPost("nombreProF")) {

            $procedimientoT = new Tipoprocedimiento();
            $nombrePro = Input::post("nombreProF");
            $sql = "SELECT * from tipoProcedimiento where tituloTipo like '%$nombrePro%'";
            $this->listaProcedimientosT = $procedimientoT->find_all_by_sql($sql);

            if ($this->listaProcedimientosT == null) {
                Flash::error('Procedimiento  no encontrado, asegúrese de que existe en CLinic.');
            }
        }
    }

    public function index($page = 1) {

        $this->titulo = "Gestión de Procedimientos";
        $this->subtitulo = "Procedimientos Actuales";
        $this->informacion = "En está sección puede gestionar todos los procedimientos de Clinic.";

        if (Auth::is_valid()) {
            $tipo = Auth::get('rol');
            if ($tipo != null && $tipo == 1) {

                $tipoProcedimiento = new Tipoprocedimiento();

                $this->listaProcedimientos = $tipoProcedimiento->getProcedimientos($page, 10);
            } else {
                Redirect::to('inicio/index');
            }
        } else {
            Redirect::to('usuarios/index');
        }
    }

    public function create() {

        $this->titulo = "Gestión de Profesores";
        $this->subtitulo = "Registro de Profesor";
        $this->informacion = "En está sección puede llevar acabo el registro de un profesor.";

        if (Auth::is_valid()) {
            $tipo = Auth::get('rol');
            if ($tipo != null && $tipo == 1) {

                if (Input::hasPost("nombreF", "apellidoF", "idF", "estadoF")) {


                    $profesor = new Profesor();
                    $profesor->idPro = Input::post('idProF');
                    $profesor->nombrePro = strtoupper(Input::post('nombreF'));
                    $profesor->apellidoPro = strtoupper(Input::post('apellidoF'));
                    $profesor->identidadPro = Input::post('idF');
                    $profesor->estadoPro = Input::post('estadoF');

                    if (!$profesor->save()) {
                        Flash::error('Hubo un error al agrerar el nuevo profesor. Revise los datos por favor..');
                    } else {
                        Flash::valid('Profesor guardado correctamente');
                        Input::delete();
                        Redirect::to('profesor/index');
                    }
                }
            } else {
                Redirect::to('inicio/index');
            }
        } else {
            Redirect::to('usuarios/index');
        }
    }

// Fin Create

    public function edit($idTipo) {

        $this->titulo = "Gestión de Profesores";
        $this->subtitulo = "Actualización de Profesor";
        $this->informacion = "En está sección puede actualizar la información del profesor. ";

        if (Auth::is_valid()) {
            $tipo = Auth::get('rol');
            if ($tipo != null && $tipo == 1) {
                $tipoprocedimiento = new Tipoprocedimiento();

                if (Input::hasPost("idPro")) {

                    $this->tipoprocedimiento = $tipoprocedimiento->find(Input::post("idPro"));

                    $tipoprocedimiento->tituloTipo = Input::post('tituloF');



                    if (!$tipoprocedimiento->update(Input::post('idPro'))) {
                        Flash::error('No se pudo actualizar el procedimiento correctamente!');
                    } else {
                        Flash::valid('Se actualizó el procedimiento correctamente!');

                        $page = 1;
                        $this->listaProcedimientos = $tipoprocedimiento->getProcedimientos($page, 10);

                        Redirect::to('procedimientos/index');
                    }
                } else {
                    $this->tipoprocedimiento = $tipoprocedimiento->find($idTipo);
                }
            } else {
                Redirect::to('inicio/index');
            }
        } else {
            Redirect::to('usuarios/index');
        }
    }

    public function del($id) {

        $this->titulo = "Gestión de Profesores";
        $this->subtitulo = "Actualización de Profesor";
        $this->informacion = "En está sección puede actualizar la información del profesor. ";



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
