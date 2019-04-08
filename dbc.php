<?php

class Connection {

    #Atributos
    private $_connection;
    private static $_instance;
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'TFC';

    #Crea una instancia si no existe
    public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
    }
    
    #Constructor
    private function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database) or die ("Error al conectar con: ".$this->_database);
    }
    
    #Evita el duplicado de la conexión
    private function __clone() { }

    #Instancia nula
    public function nullInstance() {
        $this->$_instance = null;
    }
	
    #Devuelve la conexión mysql
    public function getConnection() {
    	return $this->_connection;
    }

    #Cierra la conexión mysqli
    public function closeConnection() {
        $this->_connection->close();
    }

    #Insertar
    public function insertSQL($table, $param) {
        $result = $this->getConnection()->query("INSERT INTO {$table} VALUES (NULL, {$param})") or die ($this->_connection->error);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    #Borrar
    public function removeSQL($table, $param) {
    $result = $this->getConnection()->query("DELETE FROM {$table} WHERE {$param}") or die ($this->_connection->error);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    #Actualizar
    public function updateSQL($table, $fields, $param) {
    $result = $this->getConnection()->query("UPDATE {$table} SET {$fields} WHERE {$param}") or die ($this->_connection->error);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
	
    #Leer, devuelve array asociativo
    public function readSQL($table, $param) {
    $result = $this->getConnection()->query("SELECT * FROM {$table} WHERE {$param}") or die($this->_connection->error);
        if ($result) {
            $data = Array();
                while($row = $result->fetch_array()) {
                    array_push($data, $row);
                }
            return $data;
        } else {
            return false;
        }
    }

}

?>
