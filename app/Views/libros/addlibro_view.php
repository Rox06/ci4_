<div class="container">
    <div class="card">
        <div class="card-header">
            Agregar un libro
        </div>
        <?php if(session('mensaje')){ ?>
            
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error</strong> <?= session('mensaje'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php } ?>

        <form name="form" action="<?=base_url('Biblioteca/getdatos') ?>" method="post" enctype="multipart/form-data">        
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombrelibro" class="form-label">Nombre del libro</label>
                    <input type="text" name="nombrelibro" class="form-control" id="nombrelibro" placeholder="Nombre del libro">
                </div>
                <div class="mb-3">
                    <label for="imagenlibro" class="form-label">Imagen del libro</label>
                    <input type="file" name="imagenlibro" class="form-control-file" id="imagenlibro">
                </div>
                <input type="submit" value="Guardar" class="btn btn-success">
                <a href="<?=base_url('Biblioteca') ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>