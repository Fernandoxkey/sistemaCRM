<?php
// Arquivo para mover um contato para outro estágio do funil

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $estagio = $_POST["estagio"];


    $novoEstagio = $estagio;

    if($estagio == "Interesse")
        $novoEstagio = "Contato Feito";
    elseif($estagio == "Contato Feito")
        $novoEstagio = "Proposta";
    elseif($estagio == "Proposta")
        $novoEstagio = "Finalizado";
    else
        $novoEstagio = $estagio;

    // Configurações do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crm";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=crm', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
        $stmt = $conn->prepare("UPDATE contato SET estagio = :estagio WHERE id = :id");
        $stmt->bindParam(':estagio', $novoEstagio);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "Contato movido com sucesso!";
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}