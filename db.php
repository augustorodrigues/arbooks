<?php
    function Conectar() {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "arbooks";

        // abrindo a conexão  
        try {
            $pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
            /*foreach($pdo->query('SELECT * FROM users') as $row) {
                //print_r($row);
                //var_dump($row);
                print "<br>";
            }*/
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() ."<br>";
            die();
        }
        
        return $pdo;
    }
    //Conectar();

    function BuscaUsuario($id) {
        // atribuindo acesso local as variáveis pela função
        //global $host, $user, $pass, $dbname, $pdo;
        $pdo = Conectar();
        
        //$query = $pdo -> query("SELECT * FROM users WHERE id_user = $id;");

        $query = $pdo -> prepare("SELECT * FROM users WHERE id_user =:id");
        $query -> bindValue(":id", $id);
        $query -> execute();

        echo $query -> rowCount();        
    }

    //BuscaUsuario(6);

    function InserirUsuario($name, $email, $password) {
        $pdo = Conectar();

        // Valida o email - vê se o email já não está cadastrado
        $validar = $pdo -> prepare("SELECT * FROM users WHERE email = :email;");
        $validar -> bindValue(":email", $email);
        $validar -> execute();

        if($validar -> rowCount() == 0) { // se não retornar valor nenhum, executa a inserção
            $query = $pdo -> prepare("INSERT INTO users VALUES (default, :name, :email, :password);");            
            $query -> bindValue(":name", $name);
            $query -> bindValue(":email", $email);
            $query -> bindValue(":password", $password);
            $query -> execute();

            echo "Usuário cadastrado com sucesso";
        } else {
            echo "Email já está em uso!";
        }

        

        //echo $query -> rowCount();
    }

    function AtualizarUsuario() {

    }

    function DeletarUsuario($id) {
        $pdo = Conectar();

        $query = $pdo -> prepare("DELETE FROM users WHERE id_users = :id");
        $query -> bindValue(":id", $id);
        $query -> execute();

    }


    //BuscaUsuario(2);

    //InserirUsuario("João","joao@teste.com","123456");

    

    // fechando a conexão
    $pdo = null;
?>