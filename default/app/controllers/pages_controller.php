<?php


class PagesController extends AppController {

    protected function before_filter() {
        $this->limit_params = false;
        // Si es AJAX enviar solo el view
        if (Input::isAjax()) {
            View::template(null);
        }
    }

    public function show() {
        View::select(implode('/', $this->parameters));
    }

}
