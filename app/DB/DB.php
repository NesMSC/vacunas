<?php

namespace App\DB;

class DB {
    private static $instance;
    private $conn;
    private $host;
    private $user;
    private $pass;
    private $name;

    // El constructor de la clase se encarga de conectarse a la base de datos
    // utilizando las credenciales leídas del archivo de configuración
    private function __construct() {
        // Leer el archivo de configuración y asignar las credenciales a las variables de la 
        $config = parse_ini_file(__DIR__."/.env");

        $this->host = $config['DB_HOST'];
        $this->user = $config['DB_USER'];
        $this->pass = $config['DB_PASS'];
        $this->name = $config['DB_NAME'];

        // Conectarse a la base de datos
        $this->conn = new \mysqli($this->host, $this->user, $this->pass, $this->name);
    }

    /**
     * Esta funcion permite obtener una instancia de la clase
     * 
     * @return DB
     */
    public static function getInstance() {
        if (self::$instance === null) {
        self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Comienza una transacción
     */
    public static function beginTransaction() {
        $instance = self::getInstance();
        $instance->conn->begin_transaction();
    }
 
    /**
     * Termina la transacción y evalúa si fue exitosa
     */
    public static function commitTransaction() {
        $instance = self::getInstance();
        // Si hubo un error durante la transaccion, hace rollback
        if($instance->conn->error) {
            $instance->conn->rollback();
        }else {
            $instance->conn->commit();
        }
    }

    /**
     *  El método select recibe una consulta SELECT y devuelve el resultado de la consulta
     * 
     * @param string La consulta select
     * 
     * @return array El array asociativo con los datos consultados
     */
    public static function select($query) {
        // Obtener la instancia de la clase
        $instance = self::getInstance();

        // Realizar la consulta y obtener el resultado
        $result = $instance->conn->query($query);

        // Si la consulta falló, devolver false
        if ($result === false) {
            return false;
        }

        // Si la consulta tuvo éxito, recorrer los resultados y guardarlos en un arreglo
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Devolver el arreglo con los resultados
        return $rows;
    }

    /**
     * El método insert recibe una consulta INSERT y devuelve el ID del último registro insertado
     * 
     * @param string El nombre de la table
     * @param array Datos a insertar
     * 
     * @return int El id del registro creado
     */
    public static function insert($table, $data = []) {
        
        $keys = array_keys($data);
        $values = array_values($data);

        $query = "INSERT INTO $table (".implode(',', $keys).") VALUES (";

        foreach ($values as $key => $str) {
            $query .= "'$str'";

            if(count($values) == $key + 1) {
                $query .= ");";
            }else {
                $query .= ", ";
            }
        }

        // Obtener la instancia de la clase
        $instance = self::getInstance();

        // Realizar la consulta y obtener el resultado
        $result = $instance->conn->query($query);

        // Si la consulta falló, devolver false
        if ($result === false) {
            return false;
        }

        // Si la consulta tuvo éxito, devolver el ID del último registro insertado
        return $instance->conn->insert_id;
    }

    /**
     * El método delete recibe una consulta DELETE y devuelve el número de filas afectadas
     * 
     * @param string La consulta SQL
     * 
     * @return int  número de filas afectadas
     */
    public static function delete($query) {
        // Obtener la instancia de la clase
        $instance = self::getInstance();
    
        // Realizar la consulta y obtener el resultado
        $result = $instance->conn->query($query);
    
        // Si la consulta falló, devolver false
        if ($result === false) {
          return false;
        }
    
        // Si la consulta tuvo éxito, devolver el número de filas afectadas
        return $instance->conn->affected_rows;
    }
    
    /**
     * El método update recibe una consulta UPDATE y devuelve el número de filas afectadas
     * 
     * @param string La consulta SQL
     * 
     * @return int  número de filas afectadas
     */
    public static function update($query) {
        // Obtener la instancia de la clase
        $instance = self::getInstance();

        // Realizar la consulta y obtener el resultado
        
        $result = $instance->conn->query($query);

        // Si la consulta falló, devolver false
        
        if ($result === false) {
        return false;
        }

        // Si la consulta tuvo éxito, devolver el número de filas afectadas
        return $instance->conn->affected_rows;
    }

}
