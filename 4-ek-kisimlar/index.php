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
if ($products) {
    foreach ($products as $product) {
        echo "<pre>";
        echo $product['id'] . "<br>";
        echo $product['grup_adi'] . "<br>";
        echo $product['urun_adi'] . "<br>";
        echo $product['urun_birimi'] . "<br>";
        echo $product['urun_giren_stok'] - $product['urun_cikan_stok'];
        echo "</pre>";
    }
}

//3.
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
$array1 = ['cicek' => 'nergis', 'hayvan' => 'lemur', 'renk' => 'kırmızı'];
$array2 = ['elma', 'armut', 'portakal'];
$array1['sehir'] = 'Ankara';
$array2 = ['Ankara'];
print_r($array1);
print_r($array2);

//5.
echo "<br>";
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="hidden" name="user-id" class="user-id" value="1">
        <button type="button" class="btn btn-primary active"> Kullanıcı Durumunu Devre Dışı Bırak</button>
    </form>
    <script>
        let button = document.querySelector(".btn");
        button.addEventListener('click', Request);

        function changeStatus() {
            button.classList.remove('active');
            button.classList.add('passive');
            if (button.classList.contains('passive')) {
                Request(e);
            }
        }

        function Request(e) {
            e.preventDefault();
            let url = 'http://localhost/jr-full-stack/ek-kisimlar/ajax.php';
            let userId = document.querySelector('user-id');
            var formData = new FormData();
            formData.append('id', userId);

        }
    </script>
    <script src="../public/js/jquery-3.6.0.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
</body>
<!DOCTYPE html>

</html>