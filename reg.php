<?php
include 'connect.php';

try{
   $username = htmlspecialchars($_POST['username']);
   $realname = htmlspecialchars($_POST['realname']);
   $password = htmlspecialchars($_POST['password']);
   $hash = password_hash($password, PASSWORD_DEFAULT);
   $sql = "INSERT INTO users (username, realname, password) values(:username,:realname,:password)";
   $query = $conn -> prepare($sql);
   if($query->execute([
    'username' => $username,
    'realname' => $realname,
    'password' => $hash,
])){
      echo "Registeration unsuccessfull";
      $sql = "SELECT * FROM users;";
    try {
        $query = $conn->prepare($sql);
        $query->execute();
    }
    catch (PDOException $e) {
        $conn = null;
        $query = null;
        die("Virhe: " . $e->getMessage());
    }
      $users = $query->fetchAll();
      session_start();
      $_SESSION['user'] = ["username"=> $username,"realname"=>$realname,"password"=> $hash];
      $_SESSION['users'] = $users;
      session_regenerate_id(True);
      header('Location: home.php');
   }else{
      throw new Exception("registeration unsuccessfull!!");
   }
  
}catch(PDOException $e){
    echo "Registeration unsuccessfull";
    header('Location: reg-form.php');
}
