<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=projetoPW', 'root', '7#544!2ovRoj');

if (isset($_GET['cod_cliente'])) {
    $cod_cliente = (int)$_GET['cod_cliente'];
    //mount form whit data
    $sql = $pdo->prepare("SELECT * FROM tab_cliente WHERE cod_cliente = $cod_cliente");
    $sql->execute();
    $clientes = $sql->fetchAll();

    //montar formulário com os dados dos alunos
    foreach ($clientes as $cliente) {
        echo "<form method='POST'>";
        echo "<legend class='row justify-content-center'>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div class='container'>";

        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $cliente['nome'] . "'>";
        echo "</div>";

        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='cpf' value='" . $cliente['cpf'] . "'>";
        echo "</div>";
        
        echo "<div>";
        echo "Email: <input type='text' class='form-control' name='email' value='" . $cliente['email'] . "'>";
        echo "</div>";

        echo "<div>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='LIMPAR'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
        echo "</div>";

    }

    //$pdo->exec("DELETE FROM `tab_aluno` WHERE `cod_aluno` = $cod_aluno");
    //echo "<h1>Usuário com id = $cod_aluno deletado com sucesso!</h1>";
}

if (isset($_POST['nome'])) {
    //$sql = $pdo->prepare("INSERT INTO tab_aluno VALUES (null, ?, ?, ?, ?, ?)");
    //$sql->execute(array($_POST['nome'], $_POST['matricula'], $_POST['nota1'], $_POST['nota2'], $_POST['nota3']));
    //alterando dados da tabela tab_aluno com os dados do form
    $sql = $pdo->prepare("UPDATE tab_cliente SET nome = ?, cpf = ?, email = ? WHERE cod_cliente = $cod_cliente");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<div class='container'>";

    echo "<h1>Cliente com id = $cod_cliente alterado com sucesso!</h1>";
    //fazer botao para voltar para a pagina de listagem
    echo "<a href='index.php'>Voltar</a>";
    echo "</div>";


    //echo "<h1>Alterado com sucesso!</h1>";
}