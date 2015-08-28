<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="Content-Type" content="text/html; charset=iso_1" />
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/myfunctions.js"></script>

    <link type="text/css" rel="stylesheet" href="style.css"/>
    <title>Atividade Azure</title>
</head>
<body role="document">
    <div class="container theme-showcase" role="main">

        <form method="post">
            <br>
            <div class="jumbotron">
                <h1>Pais &amp; Filhos</h1>
                <p>Sistema para encontrar os filhos de pais cadastrados no banco de dados. 
                Atividade do projeto de capacita��o Huawei, utilizando o Microsoft Azure.</p>
            </div>

            <?php 
            // http://drew5.net/code/managing-connectionstrings-and-variable-with-wordpress-on-azure/
            function connStrToArray($connStr){
                $connArray = array();
                $parts = explode(";", $connStr);
                foreach($parts as $part){
                    $temp = explode("=", $part);
                    $connArray[$temp[0]] = $temp[1];
                }
                return $connArray;
            }
              
            $conn_str = getenv("SQLCONNSTR_EQUIPE6DBSTR");
            $dbConn = connStrToArray($conn_str);
            $user = explode("@", $dbConn["User ID"]);
            
            $DB_HOST = $dbConn["Data Source"];
            $connectionOptions = array(
                'Database' => $dbConn["Initial Catalog"],
                'Uid' => $user[0],
                'PWD' => $dbConn["Password"]
            );

            $conn = sqlsrv_connect($DB_HOST, $connectionOptions) or die
                ('<br><div class="alert alert-warning" role="alert">N�o foi possivel conectar ao servidor SQL</div>');
            
            // tenta conectar ao banco de dados e mata a pagina se nao for possivel
            // se a pagina nao morrer, a mensagem a seguir eh exibida

            ?>

            <div id="success-alert" class="alert alert-success" role="alert">Conex�o efetuada com sucesso!!</div>
            <div class="page-header">
                <h1>Selecionar pais</h1>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" name="nome_pessoa">

                    <?php
                    $result = sqlsrv_query($conn, 'SELECT DISTINCT nome FROM tabela ORDER BY nome;');
                    if  ($result) {
                        while ($row = sqlsrv_fetch_array($result)) {
                            echo '<option>' . $row['nome'] . '</option>';
                        }
                    }
                    ?>

                    </select>
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

            <?php if (strcmp($_POST['nome_pessoa'], 'Mr. Catra') == 0) {throw new Exception('Too many rows.');} ?>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $result = sqlsrv_query($conn, "SELECT filho FROM tabela WHERE nome = '" . $_POST['nome_pessoa'] . "' ORDER BY filho;");
                    while ($row = sqlsrv_fetch_array($result)) {
                        echo '<tr><td>' . $row['filho'] . '</td></tr>';
                    } 
                ?>
            </tbody>
            </table>

            <?php endif; ?>

        </form>
    </div>
</body>
</html>
