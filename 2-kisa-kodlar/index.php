<?php
//1.
$array = ["pie", "banana", "apple", "strawberry"];
echo $array[2] . "<br>";

//2.
class Database
{
    private $host = 'localhost';
    private $database = 'task';
    private $username = 'root';
    private $password = '';
    private $connect;

    public function __construct()
    {
        try {
            $this->connect = new PDO(
                "mysql:host={$this->host};dbname={$this->database}",
                $this->username,
                $this->password
            );
            $this->connect->exec('SET CHARACTER SET utf8');
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Hata:" . $e->getMessage();
        }
    }
    public function row($sql, $data = [])
    {
        $query = $this->connect->prepare($sql);
        $query->execute($data);
        if ($query->execute($data)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function rows($sql, $data = [])
    {
        $query = $this->connect->prepare($sql);
        $query->execute($data);
        if ($query->execute($data)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function __destruct()
    {
        $this->connect = null;
    }
}
$Database = new Database();

//3.

//4

//5.
$text = 'apple';
$str = substr($text, 0, 3);
echo $str . "<br>";

//6.
/** * header('Location:redirect.php') */

//7.

//8.
/** * doğru */

//9.


//10.
/** form enctype="multipart/form-data", input:file name = image, input:submit name = submit*/
if (isset($_POST['submit'])) {
    $path = "public/upload";
    $name = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    $url = $path.'/'.$name;
    $upload = move_uploaded_file($temp, $url);
    if($upload){
        echo "Resim başarıyla yüklendi";
    }
}