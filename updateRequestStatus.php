<?php
require_once 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_no']) && isset($_POST['status'])) {
    $requestNo = $_POST['request_no'];
    $status = $_POST['status'];

    try {
        $sql = "UPDATE request_list SET request_status = :status WHERE request_no = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':status' => $status,
            ':id' => $requestNo
        ]);
        echo "Success";
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Database Error: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "Invalid Request";
}
?>