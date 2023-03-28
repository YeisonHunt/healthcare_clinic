<?php

View::template('sbadmin');
session_start();

class CitasController extends AppController {

    public function verCalendario() {

        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Calendario de Citas";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";

        $citas = new Citas();

        $sql = "SELECT diaC as date, pacientes.nombreP as title, CONCAT(citas.horaInicio,'hasta', 
        citas.horaFin, ' ', pacientes.nombreP,' ', pacientes.apellidoP) 
       as 'desc' FROM citas INNER JOIN pacientes ON citas.pacientes_idPaciente=pacientes.idPaciente";

        $this->calendario =$citas->find_all_by_sql($sql);

        $_SESSION['calendario']=$citas->find_all_by_sql($sql);


    }
    
   

}
