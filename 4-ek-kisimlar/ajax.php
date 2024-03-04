<?php
require '../config.php';
$id = $_POST['id'];
$status = $_POST['passive'];
$query = $conn->prepare("UPDATE kullanicilar SET durum = :durum WHERE id = :id");
$result = $query->execute([':id' => $id, ':durum' => $status]);
if($result){
    echo "Kullanıcı devre dışı bırakıldı";
}else{
    echo "Bir hata oluştu";
}
