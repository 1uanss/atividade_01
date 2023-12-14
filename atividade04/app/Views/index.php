<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <!-- As a heading -->
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Projeto</span>
            <ul class="nav justify-content-end nav-underline">
                <li class="nav-item">
                    <button data-bs-toggle="modal" data-bs-target="#userModal" class="nav-link active" aria-current="page">Adicionar usuário</button>
                </li>
            </ul>
        </div>
    </nav>

    <?php
    if (session()->getFlashdata('status') === "error") {
        echo '<div class="alert alert-danger" role="alert">
                            Não foi possível cadastrar o usuário!
                        </div>';
    };
    if (session()->getFlashdata('status') === "sucesso") {
        echo '<div class="alert alert-success" role="alert">
                            Usuário castrado!
                        </div>';
    };
    if (session()->getFlashdata('status') === "delete") {
        echo '<div class="alert alert-info" role="alert">
                            Usuário deletado!
                        </div>';
    };
    if (session()->getFlashdata('status') === "notdelete") {
        echo '<div class="alert alert-warning" role="alert">
                            Erro ao deletar o usuário!
                        </div>';
    };
    ?>

    <div class="container">
        <h1>Usuários</h1>

        <?php foreach ($usuarios as $usuario) : ?>
            <div class="card mt-4 mb-3">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="mr-auto">
                        <h5 class="card-title"><?php echo $usuario['nome']; ?></h5>
                        <p class="card-text">Email: <?php echo $usuario['email']; ?></p>
                        <p class="card-text">Data de Criação: <?php echo $usuario['user_date_created_account']; ?></p>
                    </div>
                    <div class="ml-auto">
                        <a href="<?=base_url('user/' . $usuario['id'])?>" class="btn btn-primary mr-2">Editar dados</a>
                        <a href="<?=base_url('delete/' . $usuario['id'])?>" class="btn btn-danger">Excluir dados</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>



    <!-- MODAL 1 -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('send') ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="inputNome" aria-describedby="emailHelp" name="nome" required>
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputSenha" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputSenha" name="senha" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar dados</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script>
        let reloadedRecently = sessionStorage.getItem('reloadedRecently');

        // Se não foi recarregada recentemente, redireciona e define o indicador de recarregamento
        if (!reloadedRecently) {
            sessionStorage.setItem('reloadedRecently', 'true');
            window.location.reload(true);
        }
        // Criar um objeto Date usando a string de data e hora
        setTimeout(function() {
            let divToRemove = document.querySelector('.alert');
            if (divToRemove) {
                divToRemove.remove();
            }
        }, 3000); // 3000 milissegundos (3 segundos)
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>