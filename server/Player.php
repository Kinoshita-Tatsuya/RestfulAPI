<?php
    class Player
    {       
        private $pdo = null;

        public function __construct()
        {
            $pdo_dsn = 'mysql:host=localhost;dbname=test_db;charset=utf8;';
            $pdo_user = 'kinoshita';
            $pdo_pass = 'kinopana874';
                            
            try
            {
                $this->pdo = new PDO($pdo_dsn,$pdo_user,$pdo_pass);
            }
            catch(PDOException $e)
            {
                exit($e->getMessage());
            }        
        }
        
        public function Get()
        {
            $query = $this->pdo->query('select * from player;');

            $names = array();

            foreach($query->fetchAll() as $row)
            {
                $names[] = array
                (
                    'id' => $row['id'],
                    'name' => $row['name']
                );                
            }

            echo json_encode($names,JSON_UNESCAPED_UNICODE);
        }

        public function Post($name)
        {            
            $stmt = $this->pdo->prepare("insert into player (name) values (:name);");
            $stmt->bindParam(':name',$name);
            $stmt->execute();
        }

        public function Delete($name)
        {
            $stmt = $this->pdo->prepare("delete from player where name = :name");
            $stmt->bindParam(':name',$name);
            $stmt->execute();
        }

        public function Put($name,$prevName)
        {
            $stmt = $this->pdo->prepare("update player set name = :name where name = :prevName");
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':prevName',$prevName);
            $stmt->execute();
        }
    }
?>