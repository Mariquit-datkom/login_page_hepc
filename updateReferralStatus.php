<?php
require_once 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ojt_referral_id']) && isset($_POST['status'])) {
    $referralId = $_POST['ojt_referral_id'];
    $status = $_POST['status'];

    try {
        $sql = "UPDATE ojt_referral_list SET status = :status WHERE ojt_referral_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':status' => $status,
            ':id' => $referralId
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