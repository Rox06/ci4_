<?= $cabecera ?>

<div class="card">
        <div class="card-body">
            <h5 class="card-title">Ingresa datos del libro</h5>
            <p class="card-text">
    
                <form method="post" action="<?= site_url('/actualizar'); ?>" enctype="multipart/form-data">
                
                <input type="text" name="id_libro" value="<?= $libro['id_libro']; ?>">

                    <div class="form-group">
                        <label for="nombrelibro">Nombre del libro</label>
                        <input id="nombrelibro" value="<?= $libro['nombre_libro']?>" class="form-control" type="text" name="nombrelibro">
                    </div>
                    <div class="form-group">
                        <label for="imagenlibro">Imagen del libro</label>
                        <img class="img-thumdnail" src="<?= base_url()?>/imagenes/<?= $libro['imagen_libro']; ?>" width="100" alt="">
                        <input id="imagenlibro" class="form-control-file" type="file" name="imagenlibro">
                    </div>
                    <button class="btn btn-success" type="submit">Guardar</button>

                </form>
            </p>
        </div>
    </div>

<?= $pie ?>