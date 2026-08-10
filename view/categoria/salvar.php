<h3 class="mt-3 text-primary">
    Categoria
</h3>

<div class="card shadow mt-3"><!-- acrescentei um card com sombra aqui tbm -->
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="txtnome" class="col-sm-2 col-form-label">
                Nome
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Categoria"
                    value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="txtinformacoes" class="col-sm-2 col-form-label">
                Informações
            </label>
            <div class="col-sm-10">
                <textarea name="txtinformacoes" id="txtinformacoes" rows="3" placeholder="Informações aqui" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit"
                    class="btn btn-primary"
                    name="btnsalvar"
                    value="Cadastrar">
            </div>
            <!-- faltou um link aqui-->
            <a href="?p=categorias" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>

<?php
//verificar se o botão btnsalvar foi acionado
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $info = filter_input(INPUT_POST, 'txtinformacoes');
    //acesso à classe (em models)
    include_once '../models/Categoria.php';
    $cat = new Categoria();
    //enviando os dados do form aos atributos da classe
    $cat->setId(NULL);
    $cat->setNome($nome);
    $cat->setInformacoes($info);

    //efetivar o insert into
    //if ($cat->salvar()) { - com procedure
    if ($cat->inserir()) { //sem procedure
?>
        <div class="alert alert-primary mt-3" role="alert">
            Categoria - cadastro efetuado com sucesso.
        </div>
        <meta http-equiv="refresh" content="0.2;URL=?p=categorias">
    <?php
    } else {
    ?>
        <div class="alert alert-danger mt-3" role="alert">
            Categoria - erro ao cadastrar.
        </div>
        <meta http-equiv="refresh" content="0.2;URL=?p=categorias">
<?php
    }
}
