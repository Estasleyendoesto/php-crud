<?php

    require_once 'app/tool.model.php';
    require_once 'app/tool.controller.php';

    $object = new Herramienta();
    $crud   = new HerramientaController();

    if ( isset( $_REQUEST['action'] ) )
    {
        switch ( $_REQUEST['action'] )
        {
            case 'add':
                $object->__SET( 'nombre',   $_REQUEST['nombre'] );
                $object->__SET( 'material', $_REQUEST['material'] );
                $object->__SET( 'precio',   $_REQUEST['precio'] );

                $crud->create( $object );
                header('Location: index.php');
                break;
            case 'update':
                $object->__SET( 'id',       $_REQUEST['id'] );
                $object->__SET( 'nombre',   $_REQUEST['nombre'] );
                $object->__SET( 'material', $_REQUEST['material'] );
                $object->__SET( 'precio',   $_REQUEST['precio'] );

                $crud->update( $object );
                header('Location: index.php');
                break;
            case 'delete':
                $crud->delete( $_REQUEST['id'] );

                header('Location: index.php');
                break;
            case 'onUpdate':
                $object = $crud->find( $_REQUEST['id'] );
        }
    }

?>

<?php include 'header.php' ?>

<div class="container p-5">

    <h1 class="text-center p-4"><?php echo $object->id ? 'Actualizar' : 'Registrar' ?> herramienta</h1>

    <form method="post" action="?action=<?php echo $object->id ? 'update' : 'add';  ?>">
        <input type="hidden" name="id" value="<?php echo $object->__GET('id'); ?>">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $object->__GET('nombre'); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Material</label>
            <input type="text" name="material" class="form-control" value="<?php echo $object->__GET('material'); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="any" name="precio" class="form-control" value="<?php echo $object->__GET('precio'); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Creado</label>
            <input type="text" name="creado" class="form-control" value="<?php echo $object->__GET('creado'); ?>" disabled>
        </div>
        <button type="submit" class="btn btn-info"><?php echo $object->id ? 'Actualizar' : 'Registrar' ?></button>
        <?php if( $object->id ): ?>
            <a class="btn btn-dark" href="?">Cancelar</a>
        <?php endif ?>
    </form>

    <hr class="m-5" />

    <h1 class="p-5 text-center">Resultados</h1>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Material</th>
                <th>Precio</th>
                <th>Creado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $crud->listar() as $row ): ?>
                <tr>
                    <td><?php echo $row->__GET('id'); ?></td>
                    <td><?php echo $row->__GET('nombre'); ?></td>
                    <td><?php echo $row->__GET('material'); ?></td>
                    <td><?php echo $row->__GET('precio'); ?></td>
                    <td><?php echo $row->__GET('creado'); ?></td>
                    <td style="width: 171px;">
                        <a class="btn btn-warning" href="?action=onUpdate&id=<?php echo $row->id ?>">Editar</a>
                        <a class="btn btn-danger" href="?action=delete&id=<?php echo $row->id ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>

<?php include 'footer.php' ?>