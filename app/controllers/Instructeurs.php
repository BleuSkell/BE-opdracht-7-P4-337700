<?php

class Instructeurs extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Dit is de instructeurspagina'
        ];

        $this->view('instructeurs/index', $data);
    }

}