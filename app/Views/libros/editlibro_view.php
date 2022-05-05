<div class="container">
    <div class="card">
        <div class="card-header">
            Editar registro
        </div>
        <?php if(session('mensaje')){ ?>
            
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error</strong> <?= session('mensaje'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php } ?>

        <form name="form" action="<?=base_url('Biblioteca/updatelibro') ?>" method="post" enctype="multipart/form-data">        
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombrelibro" class="form-label">Nombre del libro</label>
                    <input type="text" name="nombrelibro" class="form-control" id="nombrelibro" value="<?=$dato['nombre_libro']?>" placeholder="Nombre del libro">
                </div>
                <div class="mb-3">
                    <label for="nombrelibro" class="form-label">Imagen del libro</label>
                    <img class="img-thumdnail" src="<?= base_url()?>/imagenes/<?= $dato['imagen_libro']; ?>" width="100" alt="">
                    <input id="imagenlibro" class="form-control-file" type="file" name="imagenlibro">

                </div>
                <input type="submit" value="Actualizar" class="btn btn-success">
                <input type="hidden" name="idlibro" value="<?=$dato['id_libro']?>">
                <a href="<?=base_url('Biblioteca') ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>