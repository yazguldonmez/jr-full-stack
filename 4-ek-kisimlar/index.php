<?php
require '../config.php';
//1.

//2.
/**  Tablo1 u_list: id, urun_adi, grup_id, urun_birimi
Tablo2 k_list: id, grup_adi, durum
Tablo3 g_list: id, urun_id, giren_stok, tarih
Tablo4 c_list: id, urun_id, cikan_stok , tarih
yukarıdaki tablolardan alttaki başlıkları elde edecek MySQL sorgusunu yazar
mısınız?
SORGU SONUCU İSTENİLEN BAŞLIKLAR:

urun_id, grup_adi, urun_adi, birimi, guncel_stok*/

$sql = $conn->prepare("SELECT urunler.id,
kategori.grup_adi,
urunler.urun_adi,
urunler.urun_birimi,
giren_stok.urun_giren_stok,
cikan_stok.urun_cikan_stok FROM urunler 
JOIN urun_kategori as kategori ON urunler.grup_id = kategori.id
LEFT JOIN urun_giren_stok as giren_stok ON giren_stok.urun_id = urunler.id
LEFT JOIN urun_cikan_stok as cikan_stok ON cikan_stok.urun_id = urunler.id");
$sql->execute();
$products = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>Grup adı</td>
                <td>Ürün adı</td>
                <td>Birim</td>
                <td>Guncel stok</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['grup_adi'] ?></td>
                    <td><?= $product['urun_adi'] ?></td>
                    <td><?= $product['urun_birimi'] ?></td>
                    <td><?= $product['urun_giren_stok'] - $product['urun_cikan_stok'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>

//3.
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="kullanici_adi" id="kullanici_adi">
        <input type="password" name="sifre" id="sifre">
        <input type="submit" name="submit" value="Giriş Yap">
    </form>
</body>

</html>
<?php
session_start();
function post($data)
{
    if (isset($_POST[$data])) {
        return strip_tags(trim($_POST[$data]));
    } else {
        return null;
    }
}
function add_session($key, $value)
{
    $_SESSION[$key] = $value;
}
function get_session($key)
{
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    } else {
        return null;
    }
}
if (isset($_POST['submit'])) {
    $username = post('kullanici_adi');
    $password = post('sifre');
    if ($username == null || $password == null) {
        echo "Lütfen tüm alanları doldurdurun";
    } else {
        $query = $conn->prepare('SELECT * FROM kullanicilar WHERE kullanici_adi = :kullanici_adi AND sifre = :sifre');
        $user = $query->execute([':kullanici_adi' => $username, ':sifre' => $password]);
        if ($query->rowCount()) {
            add_session('login', true);
            add_session('username', $username);
            add_session('password', $password);
        } else {
            echo "Kullanıcı adı veya şifre hatalı";
        }
    }
}

//4.
echo "<br>";
$array1 = ['cicek' => 'nergis', 'hayvan' => 'lemur', 'renk' => 'kırmızı'];
$array2 = ['elma', 'armut', 'portakal'];
$array1['sehir'] = 'Ankara';
array_push($array2, 'Ankara');
print_r($array1);
print_r($array2);

//5.
//kodlar app.js dosyasında...
echo "<br>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="user-id" class="user-id" value="3">
        <button type="button" class="btn btn-primary passive" value="p"> Kullanıcı Durumunu Devre Dışı Bırak</button>
    </form>
    <script src="../public/js/app.js"></script>
</body>
<!DOCTYPE html>

</html>