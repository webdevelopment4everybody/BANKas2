<?php 
namespace App\DB;
use PDO;
use App\DB\Migration;
use App\DB\DataBase;
class JsonDb implements DataBase{
    public static $pdo;

        public function __construct(){
            $this->db();
        }

    public static function db() {
        $host = 'localhost';
        $db   = 'bankas2';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
        self::$pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $sql = "CREATE TABLE IF NOT EXISTS acc (
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            saskNr CHAR(20),
            id BIGINT(50) UNSIGNED PRIMARY KEY,
            amount DECIMAL(10,2) DEFAULT 0
             )";
        
        try {
        self::$pdo->exec($sql);
        // echo "Table ACC created successfully";
        }
        catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function create(array $userData) : void{
        $sql = "INSERT INTO acc (firstname, lastname, saskNr,id, amount)
        VALUES (:firstname, :lastname,:saskNr, :id,:amount)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($userData); 
    }
    public function update(string $userId, array $userData) : void{
       
        $sql = "UPDATE acc SET amount = ? WHERE id = $userId";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            $userData['amount']
        ]);
    }
    public function delete(string $userId) : void{
        $sql = "DELETE FROM acc WHERE id = ?";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$userId]);

    }
    public function show(string $userId):array{
        $sql = "SELECT * FROM acc WHERE id = ?";
      $stmt = self::$pdo->prepare($sql);
      $stmt->execute([$userId]);   
      return (array) $stmt->fetch();
    }
    public function showAll() : array{ 
        $sql= "SELECT * FROM acc";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
        return $this->sort((array)$stmt->fetchAll());
}

    private function save(){
        return json_decode(file_get_contents('./../db/data.json'),1);
    }
    private function sort(array $userData) {
        function bubleSort($array){
            $swapped;
            do{
                $swapped = false;
                for($i = 0; $i < count($array) - 1; $i++){
                    $firstElement = strnatcmp($array[$i]['lastname'], $array[$i+1]['lastname']);
                    $secondElement = strnatcmp($array[$i+1]['lastname'], $array[$i]['lastname']);
                    if($firstElement > $secondElement){
                        $temp = $array[$i];
                        $array[$i] = $array[$i + 1];
                        $array[$i + 1] = $temp;
                        $swapped = true;
                    }
                }
            }while($swapped);
            return $array;
        }
        return bubleSort($userData);
    }
}
