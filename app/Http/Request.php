<?php

namespace App\Http;

use App\Http\Response;

class Request
{
    public $controller;
    public $method;
    public $data;

    public $segments = [];

    public function __construct()
    {
        // dominio.example/controller/index...
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);
        
        $this->setController();
        $this->setMethod();
        $this->setData();
    }

    /**
     * inputs data
     */
    public function inputs()
    {
        $body = json_decode(file_get_contents('php://input'));
        return $body;
    }

    /**
     * POST data
     */

    public function post()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            return (object) $_POST;
        }else {
            return false;
        }
    }
    
    /**
     * Setea el controlador del recurso
     */
    public function setController()
    {
        $this->controller = empty($this->segments[1])
            ? 'home' 
            : $this->segments[1];
    }

    /**
     * Setea el método de la petición
     */
    public function setMethod()
    {
        $this->method = empty($this->segments[2])
        ? 'index' 
        : $this->segments[2];
    }

    public function setData()
    {
        $this->data = empty($this->segments[3])
        ? '' 
        : $this->segments[3];
    }

    /**
     * Retorna la ruta del controlador
     * @return string
     */
    public function getController()
    {
        $controller = ucfirst($this->controller);
        
        return "App\Http\Controllers\\{$controller}Controller";
    }

    /**
     * Retorna el metodo de la petición
     * @return string
     */
    public function getMethod()
    {   
        return $this->method;
    }

    public function getDataURI()
    {
        return $this->data;
    }

    /**
     * Procesa la petición
     */
    public function send()
    {
        $controller = $this->getController();

        if(!method_exists($controller, $this->getMethod())){
            echo "Method does not exist";
            die();
        }

        $method = new \ReflectionMethod($controller, $this->getMethod());
        $dataURI = $this->getDataURI();

        // Verifica si el metodo solicita el request como parametro
        $parameters = [];
        foreach ($method->getParameters() as $parameter) {
            // Guardo todos los parametros en el array parameters
            if($parameter->getName() == 'request') {
                $parameters["request"] = $this;
            }
        }

        if(!empty($dataURI)) {
            $parameters["id"] = $dataURI;
        }

        $instance = new $controller;

        $response_content = call_user_func([
            $instance,
            $method->name,
        ], ...$parameters);

        list($view, $data) = $response_content;

        $response = new Response($view, $data);

        $response->send();
    }
}