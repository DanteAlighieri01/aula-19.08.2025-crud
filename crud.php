<?php
    session_start();
    if (!isset($_SESSION['pessoas'])){//se não foi iniciado
            $_SESSION['pessoas'] = [];
    }
    //! = ponto esclamação singnifica negação.
    $id_edição = null;
    $nome_edição = '';
    $email_edição = '';
    $celular_edição = '';
    $modo_edicao = false;
    //coração do crud
    //DELETE via Get
    if(isset($_GET['acao']) && $_GET['acao'] == 'deletar' && isset($_GET['id'])){
        $id_para_deletar = $_GET('id');
        foreach ($_SESSION['id'] as $indice => $pessoa) {
            if ($pessoa['id'] == $id_para_deletar) {
               unset($_SESSION['pessoas'][$indice]);
               break;
            }
        }
        header('location: index.php');
        exit; //break = para e exit = sai
    } 
    //Preparar a edição d
    if (isset($_GET['acao']) && $_GET['acao'] == 'editar' && isset($_GET['id'])) {
        $id_para_editar = $_GET['id'];
        foreach ($_SESSION['pessoas'] as $pessoa){
            if ($pessoa['id'] == $id_para_deletar){
                $id_edição = $pessoa['id'];
                $nome_edição = $pessoa['nome'];
                $email_edição = $pessoa['email'];
                $celular_edição= $pessoa['celular'];
                $modo_edicao= true; //tiva a edição mo form
                break;
            }
        }
    }
    //criar e atualizar via post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $celular = $_POSt['celular'];
        //atualizar
        if (isset($_POST['id']) && !empy($_POST['id'])) {
            $id_para_atualizar = $_POST['id'];
            foreach ($_SESSION['pessoa'] as $indice => $pessoa) {
             if($pessoa['id'] == $id_para_atualizar){
               $_SESSION[$pessoa][$indice]['nome'] = $nome;
               $_SESSION[$pessoa][$indice]['email'] = $email;
               $_SESSION[$pessoa][$indice]['celular'] = $celular;
               break;
              }
            }
        }
        //criar
        else {
            $nova_pessoa = [
                'id' => uniqid(),
                'nome' => $nome,
                'email'=> $email,
                'celular' => $celular
            ];
            $_SESSION['pessoas'][] = $nova_pessoa;
        }
        header('Loction: index.php');
        exit;
    }
?>
     <DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta nome="viewport" conte="width=device-whith, inicial-scala=1,0">
                <title>CRUD - PHP/Array</title>
                <style>
                    body{ font-family: Arial, sans-serif; margin: 20px;}
                    h1, h2{color: #333;}
                    .container { max-width: 800px; margin: auto;}
                    form{margin-bottom: 20px; padding: 20px;border: 1px solid #ccc; border-radius: 5px}
                    form div {margin-bottom: 10px;}
                    label{display: block;margin-bottom: 5px}
                    imput[type="text"],input[type="email"]{width: calc(100% - 16px); padding: 8px; border: 1px solid #ccc;border-radius: 3px;}
                    button {padding: 10px 15; background-color: #28a745; color: white; border: none;border-radius: 3px; cursor: pointer;}
                    button.update { background-color: #007bff}
                    table { width: 100%; border-collapse: collapse}
                    th, td{ border: 1px solid #ddd; padding: 8px; text-align: left;}
                    th { background-color: #f2f2f2;}
                    a { color: #dc3545; margin-left: 10px; }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Cadastro de Pessoas<h1>
                        <form action="index.php"method="POST">
                            <imput type="hiden"name="id" value="<?php echo $id_edição; ?>">
                            <div>
                                <label for="nome">Nome:</label>
                                <imput type="text"id="nome" name="nome" value="<?php echo htmlspecialchars($nome_edição);?>"requerid>
                            </div>
                            <div>
                                <label for="email">Email:</label>
                                <imput type="text"id="email" name="email" value="<?php echo htmlspecialchars($email_edição);?>"requerid>
                            </div><div>
                                <label for="celular">Celular:</label>
                                <imput type="text"id="celular" name="celular" value="<?php echo htmlspecialchars($celular_edição);?>"requerid>
                            </div>
                        </form>
                </div>
            </body>
            </html>