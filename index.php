<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD em PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

  <?php
    $pdo = new PDO("mysql:host=localhost;dbname=projetoPW", "root", "7#544!2ovRoj");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['excluir'])){
        $cod_cliente = (int) $_GET['excluir'];
        $pdo->exec("DELETE FROM tab_cliente WHERE cod_cliente = $cod_cliente");
        echo "<h2>O Cliente $cod_cliente foi excluido com sucesso</h2>";
    }


    if(isset($_POST['nome'])){
        $sql = $pdo->prepare("INSERT INTO `tab_cliente` VALUES (null, ?, ?, ?)");
        $nome = $_POST['nome'];
        $sql-> execute(array($_POST['cpf'], $_POST['email'], $nome));
        echo "<h2>Cliente $nome cadastrado com sucesso!</h2>";
    }
  ?>

    <div class="container">
        <form method="post">
        <legend>
            <h2 class="row justify-content-center">CADASTRO DE CLIENTES</h2>
        </legend>
        <fieldset>
            <div>
                Nome: <input type="text" name="nome" class="form-control">
            </div>

            <div>
                CPF: <input type="text" name="cpf" class="form-control">
            </div>

            <div>
                Email: <input type="text" name="email" class="form-control">
            </div>

            <div>
                <input type="submit" class="btn btn-warning" value="CADASTRAR">
                <input type="reset" class="btn btn-danger" value="LIMPAR">
            </div>
            </form>
        </fieldset>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
  <?php
    $sql = $pdo->prepare("SELECT * FROM `tab_cliente`");
    $sql->execute();
    $clientes = $sql->fetchAll();

    echo "<table class= 'table table-stripped table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col' colspan='2' class='text-center'>Ações</th>";
    echo "<th scope='col'>Nome</th>";
    echo "<th scope='col'>CPF</th>";
    echo "<th scope='col'>Email</th>";
    echo "</tr></thead><tbody>";

    foreach($clientes as $cliente){
        echo "<tr>";
        echo '<td allign=center>
        <a href="?excluir='.$cliente['cod_cliente'].'">( X )</a>
        </td>';
        echo '<td allign=center>
        <a href="alterar.php?cod_cliente='.$cliente['cod_cliente'].'">( Alterar )</a>
        </td>';

        echo "<td>" . $cliente['nome'] . "</td>";
        echo "<td>" . $cliente['cpf'] . "</td>";
        echo "<td>" . $cliente['email'] . "</td>";
        echo "</tr>";
        
    }
  ?>

</body>
    </html>