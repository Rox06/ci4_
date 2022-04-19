<?= $cabecera ?>
<a class="btn btn-success" href="<?=base_url('crear') ?>">Crear nuevo libro </a>
    </br></br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($libros as $libro): ?>
                <tr>
                    <td><?= $libro['id_libro']; ?></td>
                    <td>
                        <img class="img-thumdnail" src="<?= base_url()?>/imagenes/<?= $libro['imagen_libro']; ?>" width="100" alt="">
                    </td>
                    <td>
                        <?= $libro['nombre_libro']; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('editar/'.$libro['id_libro']); ?>" class="btn btn-info" type="button">Editar</a>
                        <a href="<?= base_url('borrar/'.$libro['id_libro']); ?>" class="btn btn-danger" type="button" onclick="return confirm('¿Desea eliminar?');">Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?= $pie ?>
