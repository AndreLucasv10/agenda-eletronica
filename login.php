<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Login</title>
  <style>
    .custom-container {
      max-width: 576px;
      width: 100%;
    }
  </style>
  <script src="./js/jquery-3.7.1.js"></script>
</head>

<body>
  <div id="login" class="">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
      <form class="custom-container" action="autenticacao.php" id="login" method="POST">
        <h1 class="text-center">Login</h1>
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuário</label>
          <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <div class="mb-3 form-check">
          <div class="d-flex justify-content-between">
            <div>
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Lembre-se de mim</label>
            </div>
            <div>
              <a id="registrar" class="btn btn-link">Registre-se</a>
            </div>
          </div>
        </div>
        <button onclick="event" type="submit" class="btn btn-primary d-grid gap-2 col-12 mx-auto" name="login" value="login">Entrar</button>
      </form>
    </div>
  </div>

  <div id="criar-conta" style="display: none;">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
      <form class="custom-container" id="registerForm" action="autenticacao.php" method="POST">
        <h1 class="text-center">Registrar</h1>
        <div class="mb-3">
          <label for="novo-usuario" class="form-label">Usuário</label>
          <input type="text" class="form-control" id="novo-usuario" name="novo-usuario" required>
        </div>
        <div class="mb-3">
          <label for="nova-senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="nova-senha" name="nova-senha" required>
        </div>
        <div class="mb-3">
          <label for="confirmar-senha" class="form-label">Confirmar Senha</label>
          <input type="password" class="form-control" id="confirmar-senha" name="confirmar-senha" required>
        </div>
        <div class="mb-3 form-check">
          <div class="d-flex justify-content-between">
            <div>
              <input type="checkbox" class="form-check-input" id="exampleCheck2">
              <label class="form-check-label" for="exampleCheck2">Lembre-se de mim</label>
            </div>
            <div>
              <a id="voltar" class="btn btn-link">Já tem uma conta?</a>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary d-grid gap-2 col-12 mx-auto" name="registrar">Registrar</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
</body>

</html>