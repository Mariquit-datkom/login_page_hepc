<?php 
require_once 'dbConfig.php';
require_once 'sessionChecker.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestNo = $_POST['request_no'];
        
    $stmt = $pdo->prepare("SELECT * FROM request_list WHERE request_no = :request_no");
    $stmt->execute(['request_no' => $requestNo]);
    $request = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>