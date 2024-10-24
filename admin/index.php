<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Login</title>
</head>

<body class="bg-light">

    <section class="vh-100">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-6 col-lg-4 text-center">

                    <div class="mb-4">
                        <img src="../assets/img/logo-01.png" alt="Livraria da Vila" class="img-fluid">
                    </div>

                    <div class="bg-white p-4 rounded shadow-sm">
                        <form action="login.php" method="post">

                            <h3 class="fw-bold mb-4" style="letter-spacing: 1px;">Login</h3>

                            <div class="form-outline mb-4">
                                <input type="text" id="usuario" name="usuario" placeholder="Usuário"
                                    class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="senha" name="senha" placeholder="Senha"
                                    class="form-control form-control-lg" />
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                            <div class="mt-3">
                                <?php
                                if (isset($_SESSION['loginVazio'])) {
                                    echo '<div class="alert alert-warning mt-2">' . $_SESSION['loginVazio'] . '</div>';
                                    unset($_SESSION['loginVazio']);
                                }
                                if (isset($_SESSION['naoAutorizado'])) {
                                    echo '<div class="alert alert-danger mt-2">' . $_SESSION['naoAutorizado'] . '</div>';
                                    unset($_SESSION['naoAutorizado']);
                                }
                                if (isset($_SESSION['loginErro'])) {
                                    echo '<div class="alert alert-danger mt-2">' . $_SESSION['loginErro'] . '</div>';
                                    unset($_SESSION['loginErro']);
                                }
                                if (isset($_SESSION['logOFF'])) {
                                    echo '<div class="alert alert-info mt-2">' . $_SESSION['logOFF'] . '</div>';
                                    unset($_SESSION['logOFF']);
                                }
                                ?>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-5pN9FTxOT8N8RY9Pyo6zU7pDydG6NQH2T2h6MtrwF+0J64xlIklRVR2bkE6wS70yD" crossorigin="anonymous"></script>

</body>

</html>
