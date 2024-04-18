<?php

    $conn = mysqli_connect('localhost','root','','kmec');

    if ($conn->connect_error) {
        if(!$conn){
            echo '<div class ="alert-box">
            <div class ="alert">Connected successfully</div>
          </div>';
        }
    }
    

    if(isset($_POST['name']) && isset($_POST['password'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sqlControl = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn,$sqlControl);

        if(mysqli_num_rows($result) > 0){
            echo '<div class ="alert-box">
            <div class ="alert">Duplikatny mail!</div>
            </div>';
        }
        else {
            $sql = "INSERT INTO user (name,email,password) VALUES ('$name','$email','$password')";
            $result = mysqli_query($conn,$sql);
    
            $sqlImg = "INSERT INTO profile_picture (status) VALUES (1)";
            $resultImg = mysqli_query($conn,$sqlImg);
    
                
            header('Refresh: 2; URL = index.php'); // presmerovanie na prihlasenie
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Create Account</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="bck">

        <img class="img1" src="img1.jpg">

        <div class="container">
        <div class="FlexText">
            <div class="HeadingLogin">Create your account</div>
            <div class="SubHeadingLogin">Create your account</div>
        </div>
        
        <form id="newsletterForm2"action="" method="post">
            <div class="input-box">
                <input id="log-reg-page" type="text" name="name" placeholder="Name" required>
                <input id="log-reg-page" type="varchar" name="email" placeholder="Email" required>
                <input id="log-reg-page" type="text" name="password" placeholder="Password" required>
            </div>
            <div class="button-box">
            <button id="main" type="submit">
                    Create account
                </button>
                </form>
                <div class="sub-button-box">
                    <div class="text-register">are you allready an user?</div>
                    <button id="second"><a href="index.php">
                        Log in 
                    </button>
                </div>
                </div>
        <div class="buttons">
            </div>
        </div>
    </div>

        <script href="script.js"></script>
    </body>
</html>