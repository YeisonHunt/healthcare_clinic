<?php

Load::lib('auth');
Load::models('usuarios');


View::template('iniciar_sesion');

class UsuariosController extends AppController {

    public function index() {

        if (Input::hasPost("usuario", "clave")) {
            $usuario = Input::post('usuario');
            $pwd = Input::post('clave');
            $iduser = $pwd;
            $auth = new Auth("model", "class: usuarios", "usuario: $usuario", "clave: $pwd");

            if ($auth->authenticate()) {
                
                Redirect::to('inicio/index');
            } else {
                Flash::error("Usuario o contraseña incorrectos!.. Por favor inténtelo de nuevo.");
            }
        }
    }

    public function sesion() {
        Auth::destroy_identity();
        View::select("index");
    }

}
