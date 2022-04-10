<?php

function smtpmailer($to, $body){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
    // $mail->SMTPDebug  = 1;
    
    $mail->Host = "";
    $mail->Port = ;  
    $mail->Username = "";
    $mail->Password = "";

    $mail->IsHTML(false);
    $mail->From="";
    $mail->FromName="";
    $mail->Sender="";
    $mail->AddReplyTo("", "");
    $mail->Subject = "";
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send())
    {
        $error ="Please try Later, Error Occured while Processing...";
        return $error; 
    }
    else 
    {
        $error = "Thanks You !! Your email is sent.";  
        return $error;
    }
}

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

    function logIn($table, $email, $password){
        $email = $this->prepareData($email);
        $password = $this->prepareData($password);
        $this->sql = "SELECT * FROM " . $table . " WHERE email = '" . $email . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {

            session_start();
            
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['id'] = $row['id'];

        } else return false;

        return true;
    }

    function signUp($table, $email, $name, $password){
        $name = $this->prepareData($name);
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $status = 1;
        $secret = sha1($email.time());

        $this->sql = "SELECT * FROM $table WHERE `name` = '$name' OR 'email' = '$email'; "; // No repeating emails or usernames

        $result = mysqli_query($this->connect, $this->sql);

        if(mysqli_num_rows($result) != 0)
            return false;

        else{
            $this->sql = "INSERT INTO `$table` (`id`, `name`, `password`, `email`, `status`, `secret`, `discord_id`) VALUES (NULL, '$name','$password','$email','$status','$secret', 0)";

            if (mysqli_query($this->connect, $this->sql)) {
    
                $this->sql = "SELECT * FROM $table WHERE `email` = '$email'; ";
    
                $result = mysqli_query($this->connect, $this->sql);
                $row = mysqli_fetch_assoc($result);
    
                session_start();
                
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['id'] = $row['id'];
    
                return true;
                    
            }
            else return "Error!";
        }
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