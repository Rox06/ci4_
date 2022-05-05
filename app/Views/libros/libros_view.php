<div class="container">
    <div class="card">
        <div class="card-header">
            Sistema biblioteca
        </div>
        <?php if(session('mensaje')){ ?>
            
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Éxito</strong> <?= session('mensaje'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php } ?>
                
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen libro</th>
                    <th scope="col">Nombre libro</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($datos as $dato){?>
                    <tr>
                        <th scope="row"><?php echo $dato['id_libro']; ?></th>
                        <td><img class="img-thumdnail" src="<?= base_url()?>/imagenes/<?=$dato['imagen_libro'];?>" width="100" alt=""></td>
                        <td><?php echo $dato['nombre_libro']; ?></td>
                        <td>
                            <input type="hidden" id="base_url" value="<?=base_url();?>">
                            <a href="<?=base_url('Biblioteca/editlibro/'.$dato['id_libro'])?>" class="btn btn-warning">Editar</a>
                            <a href="<?=base_url('Biblioteca/deletelibro/'.$dato['id_libro'])?>" class="btn btn-danger btn-eliminar" id="deletelibro" data-id="<?= $dato['id_libro']; ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="<?=base_url('Biblioteca/addlibro')?>" class="btn btn-success">Nuevo</a>
        </div>
    </div>
</div>