<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Edite seus dados</h2>
        <?php
        if (session()->getFlashdata('status') === "error") {
            echo '<div class="alert alert-danger" role="alert">
                            Não foi possível atualizar dados do usuário!
                        </div>';
        };
        ?>
        <form method="post" action="<?= base_url('atualizar') ?>">
            <div class="form-group">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="<?= $usuario[0]['nome'] ?>">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="<?= $usuario[0]['email'] ?>">
            </div>
            <div class="mb-3">
                <input type="hidden" name="id" value="<?= $usuario[0]['id'] ?>">
                <label for="exampleInputPassword1" class="form-label">Nova senha</label>
                <input type="password" class="form-control" name="senha" id="exampleInputPassword1">
            </div>
            <!-- Adicione outros campos conforme necessário -->

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary mt-2">Enviar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>