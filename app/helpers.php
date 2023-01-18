<?php
use App\Http\Response;

/**
 * Retorna la ruta de una vista
 * @param string nombre de la vista
 * @return string
 */
if(! function_exists('viewPath')) {

    function viewPath($view) {

        $path = str_replace('.', '/', $view);

        return __DIR__ . "/../resources/views/$path.php";
    }
}

/**
 * Retorna una vista
 * @param string $viewName El nombre de la vista
 * @param array $viewData  La informacion que se le pasará a la vista
 * @param string $template La plantilla donde se imprimirá la vista
 * @return array
 */
if(! function_exists('view')) {
    function view($viewName, $viewData = [], $template = '') {

        // verificar si existe la sesion
        if(!isset($_SESSION)) {
            session_start();
        }
        // Verificar si el archivo de la vista existe
        if (!file_exists(viewPath($viewName))) {
          echo "View $viewName not found";
          die();
        }

        // Añadir los datos de la variable de sesión a los datos de la vista
        if (isset($_SESSION["REDIRECT_DATA"]) && is_array($_SESSION["REDIRECT_DATA"])) {

          foreach($_SESSION["REDIRECT_DATA"] as $key => $value) {
            $viewData[$key] = $value;
          }
        }
        // reiniciar los datos de redireccion
        $_SESSION["REDIRECT_DATA"] = [];

        // Incluir la vista
        
        extract($viewData);
        require viewPath($viewName);
      
        // Obtener el HTML generado por la vista y limpiar el buffer de salida
        $html = ob_get_contents();
        ob_end_clean();

        // Si le paso un template, se va a retornar esa vista adentro de ese template
        if($template) {
            // Iniciar el buffer de salida
            ob_start();
            $content = $html;
            require viewPath($template);
            $html = ob_get_contents();
            ob_end_clean();
        }
      
        // Retornar el HTML y los datos de la vista
        return [$html, $viewData];
    }
}

if(! function_exists('redirect')) {
    function redirect($to, $data = [])
    {
        session_start();
        $_SESSION["REDIRECT_DATA"] = [];
        $_SESSION["REDIRECT_DATA"] = $data;

        header("Location: /$to");
    }
}

/**
 * Retorna un hash encriptado con una clave secreta
 * @param string Texto a encriptar
 * @return string hash
 */
if(! function_exists('encrypt')) {
    function encrypt(string $str) {
        return sha1($str.'6C284A26');
    }
}
