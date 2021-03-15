<?php

# El modelo que refleja una registro de la tabla herramientas.

class Herramienta 
{
    private $id;
    private $nombre;
    private $material;
    private $precio;
    private $creado;

    public function __GET( $key ) {
        return $this->$key;
    }

    public function __SET( $key, $value ) {
        $this->$key = $value;
    }
}

