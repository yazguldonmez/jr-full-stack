<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <title>Document</title>
</head>
<?php
require '../config.php';
$query = $conn->prepare('SELECT * FROM kullanicilar 
JOIN kitaplar ON kitaplar.kullanici_id = kullanicilar.id');
$query->execute();
if ($query->rowCount()) {
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Henüz kayıt girilmemiş...";
}
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive pt-5">
                    <table class="table table-strapped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ad</th>
                                <th scope="col">Soyad</th>
                                <th scope="col">E-posta</th>
                                <th scope="col">Ödünç alınan kitap</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <th scope="row"><?= $user['id'] ?></th>
                                    <td>
                                        <?= $user['ad'] ?>
                                    </td>
                                    <td>
                                        <?= $user['soyad'] ?>
                                    </td>
                                    <td>
                                        <?= $user['e_mail'] ?>
                                    </td>
                                    <td>
                                        <?= $user['kitap_adi'] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../public/js/jquery-3.6.0.min.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
</body>

</html>