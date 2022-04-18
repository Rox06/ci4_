<?= $cabecera ?>
    Formulario de crear

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Ingresa datos del libro</h5>
            <p class="card-text">
    
                <form method="post" action="<?= site_url('/guardar'); ?>" enctype="multipart/form-data">
                
                    <div class="form-group">
                        <label for="nombrelibro">Nombre del libro</label>
                        <input id="nombrelibro" class="form-control" type="text" name="nombrelibro">
                    </div>
                    <div class="form-group">
                        <label for="imagenlibro">Imagen del libro</label>
                        <input id="imagenlibro" class="form-control-file" type="file" name="imagenlibro">
                    </div>
                    <button class="btn btn-success" type="submit">Guardar</button>

                </form>
            </p>
        </div>
    </div>

<?= $pie ?>