<?php
    class PersonService {
        // private $database;

        public function login(){
            $db = new PDO('mysql:host=192.168.64.2;dbname=PORTODB;charset=utf8','root','');
            $db = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

            $nome = "Jair";
            $sobrenome = "Kobe";

            $r = $db->prepare("INSERT INTO Person(username,email) VALUES(:nome,:sobrenome)");
            $r->execute(array(':nome' => $nome, ':sobrenome' => $sobrenome));
            if($r->rowCount() > 0) {
                echo "<p>Linha inserida!</p>";	
            }
        }
    }
?>
