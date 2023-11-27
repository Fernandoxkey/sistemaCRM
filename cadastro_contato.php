<?php
// Arquivo para cadastrar um novo contato no banco de dados
//exit("<pre>".print_r($_FILES,true)."</pre>");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $estagio = $_POST["estagio"];
    $anotacoes = $_POST["anotacoes"];
    $tarefas = $_POST["tarefas"];
    $idContato = isset($_POST["id"]) ? $_POST["id"] : null;

    // Configurações do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crm";

    $retorno = [];

    try {
        $conn = new PDO('mysql:host=localhost;dbname=crm', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(@$_FILES["arquivo"]["name"]) {
            //exit("<pre>".print_r($_FILES,true)."</pre>");
            $target_dir = "uploads/";
            $name_file = basename($_FILES["arquivo"]["name"]);
            $target_file = $target_dir . md5($name_file.time());
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_dir.$name_file,PATHINFO_EXTENSION));

            /*$check = getimagesize($_FILES["arquivo"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $msg = "Arquivo não é uma imagem.";
                $uploadOk = 0;
            }*/

            if (file_exists($target_file)) {
                $msg = "Desculpe, arquivo já existe.";
                $uploadOk = 0;
            }

            if ($_FILES["arquivo"]["size"] > 5000000) {
                $msg = "Desculpe, o formato deste arquivo muito grande.";
                $uploadOk = 0;
            }

            if(
                $imageFileType != "jpg" && 
                $imageFileType != "png" && 
                $imageFileType != "jpeg" && 
                $imageFileType != "gif" && 
                $imageFileType != "pdf" && 
                $imageFileType != "txt" && 
                $imageFileType != "doc" && 
                $imageFileType != "docx" && 
                $imageFileType != "csv" && 
                $imageFileType != "xlsx" && 
                $imageFileType != "xls") {
                $msg = "Desculpe, somente extensões JPG, JPEG, PNG, GIF, DOC, TXT, XLS, CSV, PDF são válidas.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                //$msg = 'Desculpe, ocorreu um erro de ulpoad do aquivo!';
            } else {
                if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file.".".$imageFileType)) {
                    //echo "The file ". htmlspecialchars( basename( $_FILES["arquivo"]["name"])). " has been uploaded.";
                    //$retorno = ['erro'=>false, 'msg'=>'Contato cadastrado com sucesso!'];
                } else {
                    $msg = 'Desculpe, ocorreu um erro de ulpoad do aquivo!';
                }
            }
        }

        if(@$_POST["id"]){

            if(@$_FILES["arquivo"]["name"] && $uploadOk == 1) {
                $stmt = $conn->prepare("SELECT * FROM contato WHERE id = '".$_POST["id"]."' LIMIT 1");
                $stmt->execute();
                $contato = $stmt->fetch(PDO::FETCH_ASSOC);
                @unlink($contato["arquivo"]);
                $arquivo = $target_file.".".$imageFileType;
            }

            $stmt = $conn->prepare("UPDATE contato SET nome = :nome, telefone = :telefone, email = :email, estagio = :estagio, anotacoes = :anotacoes, tarefas = :tarefas, arquivo = :arquivo WHERE id = :id");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':estagio', $estagio);
            $stmt->bindParam(':anotacoes', $anotacoes);
            $stmt->bindParam(':tarefas', $tarefas);
            $stmt->bindParam(':arquivo', $arquivo);
            $stmt->bindParam(':id', $_POST["id"]);
            $stmt->execute();

            $msg_retorno = 'Contato alterado com sucesso!';
            if(isset($uploadOk) && @$uploadOk == 0)
                $msg_retorno = $msg_retorno.' '.$msg;

            $retorno = ['erro' => false, 'msg'=>$msg_retorno];
        
        } else {

            $arquivo = NULL;
            if(@$_FILES["arquivo"]["name"] && $uploadOk == 1) {
                $arquivo = $target_file.".".$imageFileType;
            }

            $stmt = $conn->prepare("INSERT INTO contato (nome, telefone, email, estagio, anotacoes, tarefas, arquivo) VALUES (:nome, :telefone, :email, :estagio, :anotacoes, :tarefas, :arquivo)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':estagio', $estagio);
            $stmt->bindParam(':anotacoes', $anotacoes);
            $stmt->bindParam(':tarefas', $tarefas);
            $stmt->bindParam(':arquivo', $arquivo);
            $stmt->execute();

            $msg_retorno = 'Contato cadastrado com sucesso!';
            if(isset($uploadOk) && @$uploadOk == 0)
                $msg_retorno = $msg_retorno.' '.$msg;

            $retorno = ['erro' => false, 'msg'=>$msg_retorno];
        }

    } catch(PDOException $e) {
        //exit("<pre>".print_r($e->getMessage(),true)."</pre>");
        $retorno = ['erro'=>true, 'msg'=>"Erro: " . $e->getMessage()];
        
    }
    echo json_encode($retorno);
}

