<?php

namespace App\Http;

class Response
{
    public $view;
    public $data;

    public function __construct($view = '', $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    private function redirectIfContentEmpty()
    {
        if(!$this->view){
            $this->redirect('/');
        } 
    }

    public function redirect($uri)
    {
        header("Location: $uri");
    }

    /**
     * Imprime la respuesta
     * 
     */
    public function send()
    {
        // retorna una vista
        echo $this->view;
    }
}