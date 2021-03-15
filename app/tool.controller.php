<?php

# CRUD de la tabla herramientas
require_once 'tool.model.php';

class HerramientaController 
{
    private $conexion;

    public function __CONSTRUCT()
    {
        try {
            $config = include 'config/config.php';
            $this->conexion = new PDO(
                'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['user'], $config['pass']
            );
        }
        catch( Exception $err ) {
            die( $err->getMessage() );
        }
    }

    public function listar()
    {
        try {
            $query = 'SELECT * FROM  herramientas';
            $result = $this->conexion->prepare( $query );
            $result->execute();

            $arr = array();

            foreach( $result->fetchAll(PDO::FETCH_OBJ) as $row )
            {
                $object = new Herramienta();

                $object->__SET( 'id',       $row->id );
                $object->__SET( 'nombre',   $row->nombre );
                $object->__SET( 'material', $row->material );
                $object->__SET( 'precio',   $row->precio );
                $object->__SET( 'creado',   $row->creado );

                $arr[] = $object;
            }

            return $arr;
        }
        catch( Exception $err ) {
            die( $err->getMessage() );
        }
    }

    public function find( $id )
    {
        try {
            $query  = 'SELECT * FROM  herramientas WHERE id = ?';
            $result = $this->conexion->prepare( $query );
            $result->execute( array($id) );
            $result = $result->fetch( PDO::FETCH_OBJ );

            $object = new Herramienta();

            $object->__SET( 'id',       $result->id );
            $object->__SET( 'nombre',   $result->nombre );
            $object->__SET( 'material', $result->material );
            $object->__SET( 'precio',   $result->precio );
            $object->__SET( 'creado',   $result->creado );

            return $object;
        }
        catch( Exception $err ) {
            die( $err->getMessage() );
        }
    }

    public function create( Herramienta $object )
    {
        try {
            $query = 'INSERT INTO herramientas( nombre, material, precio ) 
                      VALUES( ?, ?, ? )';

            $this->conexion->prepare( $query )->execute([
                $object->__GET( 'nombre' ),
                $object->__GET( 'material' ),
                $object->__GET( 'precio' )
            ]);
        }
        catch( Exception $err ) {
            die( $err->getMessage() );
        }
    }

    public function update( Herramienta $object )
    {
        try {
            $query = 'UPDATE herramientas 
                      SET nombre = ?, material = ?, precio = ?
                      WHERE id = ?';

            $this->conexion->prepare( $query )->execute([
                $object->__GET('nombre'),
                $object->__GET('material'),
                $object->__GET('precio'),
                $object->__GET('id')
            ]);
        }
        catch( Exception $err ) {
            die( $err->getMessage() );
        }
    }

    public function delete( $id )
    {
        try {
            $query = 'DELETE FROM herramientas WHERE id = ?';
            $this->conexion->prepare( $query )->execute([ $id ]);
        }
        catch( Exception $err ) {
            die( $err->getMessage() );
        }
    }

}



