<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crm";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $retorno = ['erro' => true, 'msg' => 'Erro desconhecido'];

    try {
        $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $contatos = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($contatos === false || $contatos <= 0) {
            $retorno = ['erro' => true, 'msg' => 'ID de contato inválido'];
        } else {
            // Excluir o contato do banco de dados com base no ID
            $stmt = $conn->prepare("DELETE FROM contato WHERE id = :id");
            $stmt->bindParam(':id', $contatos, PDO::PARAM_INT);
            $stmt->execute();

            // Verifique se um registro foi afetado
            if ($stmt->rowCount() > 0) {
                $retorno = ['erro' => false, 'msg' => 'Contato excluído com sucesso'];
            } else {
                $retorno = ['erro' => true, 'msg' => 'Contato não encontrado'];
            }
        }
    } catch (PDOException $e) {
        $retorno = ['erro' => true, 'msg' => 'Erro no banco de dados: ' . $e->getMessage()];
    }

    echo json_encode($retorno);
}
?>