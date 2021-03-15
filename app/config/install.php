<?php

    $config = include 'config.php';

    try {
        $conexion = new PDO(
            'mysql:host=' . $config['host'], $config['user'], $config['pass']
        );
        $sql = file_get_contents('migration.sql');
        $conexion->exec( $sql );

        echo 'Base de datos instalado correctamente';
    }
    catch( PDOException $err ) {
        echo $err->getMessage();
    }
