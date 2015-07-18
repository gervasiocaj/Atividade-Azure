<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/myfunctions.js"></script>

    <link type="text/css" rel="stylesheet" href="style.css"/>
    <title>Envio Email</title>
</head>
<body role="document">
    <div class="container theme-showcase" role="main">

        <form method="post">
            <br>
            <div class="jumbotron">
                <h1>Pais &amp; Filhos</h1>
                <p>Sistema para encontrar os filhos de pais cadastrados no banco de dados. Atividade do projeto de capacitação Huawei, utilizando o Amazon AWS.</p>
            </div>

            <?php $conexao = pg_connect("host=equipe6.cvb4u98xthpb.ap-southeast-1.rds.amazonaws.com port=5432 dbname=equipe6 user=site password=asdf1234") 
                or die ("<br><div class=\"alert alert-warning\" role=\"alert\">Não foi possivel conectar ao servidor PostGreSQL</div>");
                // tenta conectar ao banco de dados e mata a pagina se nao for possivel
                // se a pagina nao morrer, a mensagem a seguir eh exibida

            ?>

            <div id="success-alert" class="alert alert-success" role="alert">Conexão efetuada com sucesso!!</div>
            <div class="page-header">
                <h1>Selecionar pais</h1>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php
                    
                    $result = pg_query("SELECT DISTINCT nome FROM tabela ORDER BY nome;");

                    if  ($result) {
                        echo "<select class=\"form-control\" name=\"nome_pessoa\">";
                            while ($row = pg_fetch_array($result)) {
                                echo "<option>" . $row["nome"] . "</option>";
                            }
                        echo "</select>";
                    }

                    ?>
                </div>

                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="Ver filhos" />
                </div>
            </div>
            
            <br>

            <?php if (isset($_POST['nome_pessoa']) ? $_POST['nome_pessoa'] : false): ?>
            
            <div class="page-header">
                <h1>Filhos de <?php echo $_POST['nome_pessoa']; ?> </h1>
            </div>

            <?php if (strcmp($_POST['nome_pessoa'], "Mr. Catra") == 0) {throw new Exception('Too many rows.');} ?>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $result = pg_query("SELECT filho FROM tabela WHERE nome = '" . $_POST['nome_pessoa'] . "' ORDER BY filho;");
                    while ($row = pg_fetch_array($result)) {
                        echo "<tr><td>" . $row["filho"] . "</td></tr>";
                    } 
                ?>
            </tbody>
            </table>

            <?php endif; ?>

        </form>
    </div>
</body>
</html>