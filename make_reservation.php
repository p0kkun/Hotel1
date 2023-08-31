<?php
require 'header.php';
// 会員情報を取得
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$email = $_GET['email'];
$phone_number = $_GET['phone_number'];
// データベースへの接続
$pdo = new PDO('mysql:host=localhost;dbname=Hotel;charset=utf8', 'hoteluser', 'password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 選択された部屋の種類に基づいて部屋IDを取得
$selectedRoomType = $_POST['room_type'];
$query = "SELECT room_id FROM Rooms WHERE room_type = :room_type";
$statement = $pdo->prepare($query);
$statement->bindParam(':room_type', $selectedRoomType);
$statement->execute();
$roomID = $statement->fetchColumn();
// 予約情報を挿入
$query = "INSERT INTO Reservations (customer_id, room_id, check_in_date, check_out_date)
          VALUES (:customer_id, :room_id, :check_in_date, :check_out_date)";
$statement = $pdo->prepare($query);
$customer_id = 1;  // 仮の会員ID（実際のIDを指定する必要あり）
$check_in_date = '2023-08-26';  // チェックイン日を指定
$check_out_date = '2023-08-28';  // チェックアウト日を指定
$statement->bindParam(':customer_id', $customer_id);
$statement->bindParam(':room_id', $roomID);
$statement->bindParam(':check_in_date', $check_in_date);
$statement->bindParam(':check_out_date', $check_out_date);
$statement->execute();
// リダイレクト先のURLを指定してリダイレクト
header("Location: reservation_confirmation.php?first_name=$first_name&last_name=$last_name&email=$email&phone_number=$phone_number&room_type=$selectedRoomType");
exit();
require 'footer.php';
?>