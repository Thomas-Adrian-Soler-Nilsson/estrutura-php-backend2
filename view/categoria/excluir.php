    <?php
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        include_once '../models/Categoria.php';
        $cat = new Categoria();
        $cat->setId($id);

        if ($cat->crudPhp("E")) {
    ?>
            <div class="alert alert-primary" role="alert">
                Excluído com sucesso
            </div>
    <?php
        }
    }
    ?>
    <meta http-equiv="refresh" CONTENT="1;URL=?p=categorias">