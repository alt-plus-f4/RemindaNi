<?php

class DataBase{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct(){
        $conf = parse_ini_file('config.ini');
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $this->servername = $conf['db_servername'];
        $this->username = $conf['db_username'];
        $this->password = $conf['db_password'];
        $this->databasename = $dbname = $conf['db_name'];
    }

    function dbConnect(){
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data){
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $username, $password){
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "SELECT * FROM " . $table . " WHERE username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {

            session_start();

            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];

        } else return false;

        return true;
    }

    function signUp($table, $email, $username, $password, $discord, $name){
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $discord = $this->prepareData($discord);
        $name = $this->prepareData($name);

        $this->sql = "INSERT INTO `$table` (`id`, `username`, `password`, `email`, `discord`, `name`) VALUES (NULL, '$username','$password','$email','$discord','$name')";

        if (mysqli_query($this->connect, $this->sql)) {

            $this->sql = "SELECT `id` FROM $table WHERE `username` = '$username'; ";

            $result = mysqli_query($this->connect, $this->sql);
            $row = mysqli_fetch_assoc($result);

            session_start();

            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];

            

            return true;
                
        } else return false;
    }

    function delete($id){

        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->databasename);

        $this->sql = "DELETE FROM `ass` WHERE `ass`.`id` = $id; ";

        if(mysqli_query($this->con, $this->sql))
            return true;

        else return false;            
    }
}

?>