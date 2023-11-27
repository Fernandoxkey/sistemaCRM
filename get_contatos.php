<?php
// Arquivo para obter a lista de contatos do banco de dados e retornar como JSON

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crm";

try {
    $conn = new PDO('mysql:host=localhost;dbname=crm', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $where = "";
    if (isset($_GET["status"]) || isset($_GET["id"]) || isset($_GET["q"])) {
         $where .= "WHERE";
        if (isset($_GET["status"])) {
            $where .= ' estagio = :status';
        }
        if (isset($_GET["id"])) {
            if($where != "WHERE")
                $where .= ' AND';
            $where .= ' id = :id';
        }
        if (isset($_GET["q"])) {
            if($where != "WHERE")
                $where .= ' AND';
            $where .= ' (nome like "%'.$_GET["q"].'%" OR telefone like "%'.$_GET["q"].'%" OR email like "%'.$_GET["q"].'%" OR anotacoes like "%'.$_GET["q"].'%" OR estagio like "%'.$_GET["q"].'%" OR tarefas like "%'.$_GET["q"].'%")';
        }
    }

    $stmt = $conn->prepare("SELECT * FROM contato " . $where . " ORDER BY estagio ASC, id DESC");

    if (isset($_GET["status"])) {
        $stmt->bindParam(':status', $_GET["status"]);
    }
    if (isset($_GET["id"])) {
        $stmt->bindParam(':id', $_GET["id"]);
    }

    $stmt->execute();

    $contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($contatos);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
