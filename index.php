<?php
require_once 'config.php';
$conn = mysqli_connect('localhost', 'root', '', 'kmec');


$errorMessage = '';

if(isset($_POST['email']) && isset($_POST['password'])){
  function validate($data){
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
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
} 
else {
  $errorMessage = '<div class ="alert-box">
  <div class ="alert">Login NOT Successfull</div>
    </div>';
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="bck">

        <img class="img1" src="img1.jpg">

        <div class="container">
            <?php echo $errorMessage ?>
        <div class="FlexText">
            <div class="HeadingLogin">Wellcome back</div>
            <div class="SubHeadingLogin">Log in to your account</div>
        </div>  
        <form id="newsletterForm" action="" method="post">
            <div class="input-box">
                <input id="log-reg-page" type="text" name="email" placeholder="Email" required>
                <input id="log-reg-page" type="text" name="password" placeholder="Password" required>
            </div>
            <div class="button-box">
            <button id="main" type="submit">                    
                    Log in
                </button>
                </form>
                <div class="sub-button-box">
                    <div class="text-register">or if you are new here</div>
                    <button id="second"><a href="register.php">
                        Create account
                    </button>
                </div>
            </div>
   
    </div>

    </body>
</html>