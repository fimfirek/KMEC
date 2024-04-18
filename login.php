<?php
require_once 'config.php';
$conn = mysqli_connect('localhost', 'root', '', 'kmec');

if(isset($_POST['email']) && isset($_POST['password'])){
  function validate($data){
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
}

$email = validate($_POST['email']);
$password = validate($_POST['password']);

if(empty($email) || empty($password)){
    echo '<div class ="alert-box">
    <div class ="alert">Invalid login</div>
  </div>';
}

$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";

$result = mysqli_query($conn,$sql);


if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['email'] === $email && $row['password'] === $password){
        echo '<div class ="alert-box">
        <div class ="alert">Login Successfull</div>
      </div>';
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      header("Location: account.php");
    }
    
} else {
  header('Refresh: 10; URL = index.php'); // presmerovanie na prihlasenie
  echo '<div class ="alert-box">
  <div class ="alert">Login NOT Successfull</div>
</div>';
  exit(); // Make sure to exit after redirection
}
?>