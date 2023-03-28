<?php

View::template('sbadmin');

class InicioController extends AppController {

    public function index() {
        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Sistema de Control de Pacientes";
        $this->informacion = "<b>Carlos Eduardo Urbano </b>- Médico Principal";
    }
    
    public function acerca() {
        
        $this->titulo = "Centro Naturista Mi Salud";
        $this->subtitulo = "Sistema de Control de Pacientes";
        $this->informacion = " <b>Carlos Eduardo Urbano </b>- Médico Principal";
    }

}
