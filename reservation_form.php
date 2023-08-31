<?php require 'header.php'; ?>
<title>予約フォーム</title>
</head>
<body>
    <h2>部屋を選んで予約してください</h2>
    <form method="POST" action="make_reservation.php">
        <label for="room_type">部屋の種類:</label>
        <select name="room_type" id="room_type">
            <?php
            // 部屋の種類一覧を取得
            $pdo = new PDO('mysql:host=localhost;dbname=Hotel;charset=utf8', 'hoteluser', 'password');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT DISTINCT room_type FROM Rooms";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $roomTypes = $statement->fetchAll(PDO::FETCH_COLUMN);
            // 選択肢を生成
            foreach ($roomTypes as $roomType) {
                echo "<option value=\"$roomType\">$roomType</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" name="submit" value="予約する">
    </form>
<?php require 'footer.php'; ?>