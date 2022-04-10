<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

error_reporting(E_ALL);

define('OAUTH2_CLIENT_ID', '961919958978297906');
define('OAUTH2_CLIENT_SECRET', 'QmvXsCgA4gBQvN9jFH2QKMp7xShqGNeE');

$authorizeURL = 'https://discord.com/api/oauth2/authorize';
$tokenURL = 'https://discord.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';
$revokeURL = 'https://discord.com/api/oauth2/token/revoke';

$conf = parse_ini_file('config.ini'); // Configs
$servername= $conf['db_servername'];
$username = $conf['db_username'];
$password= $conf['db_password'];
$dbname= $conf['db_name'];
session_start();


// Start the login process by sending the user to Discord's authorization page
if(get('action') == 'login') {

  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'https://remindani.coderr.tech/login-discord.php',
    'response_type' => 'code',
    'scope' => 'identify guilds'
  );

  // Redirect the user to Discord's authorization page
  header('Location: https://discord.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}


// When Discord redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get('code')) {

  // Exchange the auth code for a token
  $token = apiRequest($tokenURL, array(
    "grant_type" => "authorization_code",
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => 'https://remindani.coderr.tech/login-discord.php',
    'code' => get('code')
  ));
  $logout_token = $token->access_token;

  $_SESSION['access_token'] = $token->access_token;
}

if(session('access_token')) {
  $user = apiRequest($apiURLBase);

  $id = $_SESSION['id'];
  
  $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed: " . $conn->connect_error);

  $query = mysqli_query($conn, "SELECT `status` FROM `users` WHERE `users`.`id` = $id");
    
  $res = mysqli_fetch_row($query);
  $status = $res[0];

  if($status == 1)
    $status = 3;
  else if($status == 2)
    $status = 4;
  else
    header("Location: index.php");

  if($res != NULL){
    $discord_id = (int)$user->id;
    $query = mysqli_query($conn, "UPDATE `users` SET `status` = $status, `discord_id` = $discord_id WHERE `users`.`id` = $id;");
    $conn->close();
    $_SESSION['status'] = $status;

  }
  else
      header("Location: index.php");
    
  header("Location: index.php"); 

}


if(get('action') == 'logout') {
  // This should logout you
  logout($revokeURL, array(
    'token' => session('access_token'),
    'token_type_hint' => 'access_token',
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
  ));
  unset($_SESSION['access_token']);
  header('Location: ' . $_SERVER['PHP_SELF']);
  die();
}

function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);


  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

  $headers[] = 'Accept: application/json';

  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return json_decode($response);
}

function logout($url, $data=array()) {
    $ch = curl_init($url);
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
        CURLOPT_POSTFIELDS => http_build_query($data),
    ));
    $response = curl_exec($ch);
    return json_decode($response);
}

function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}

// TODO: ADD REMINDANI DISCORD BOT
?>