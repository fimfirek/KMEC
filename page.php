<?php 
require_once 'config.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Eshop</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        </div>
        <div class="container-eshop">
        <div class="navbar"> 
            <div class="navbar-button">Domov</div>
            <div class="navbar-button">Kategorie</div>
            <div class="navbar-button">Kontakt</div>

            <button id="page-account-button"><a href="account.php">Moj ucet</a></button>
            <button id="page-account-button2"><a href="logout.php">Odhlasit sa</a></button>
        </div>

            <div class="blur">
                <div class="container-products">
            

<?php
    $sqlSelect = "SELECT * FROM produkty";
    $result = mysqli_query($conn, $sqlSelect);

    if(mysqli_num_rows($result) >= 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $idProduct = $row['id'];
            $sqlTitle = "SELECT title FROM produkty WHERE id='$idProduct'";
            $sqlPrice = "SELECT price FROM produkty WHERE id='$idProduct'";
            $sqlImage = "SELECT 'image' FROM produkty WHERE id='$idProduct'";

        
            $imageResult = mysqli_query($conn, $sqlImage);
            $titleResult = mysqli_query($conn, $sqlTitle);
            $priceResult = mysqli_query($conn, $sqlPrice);
            
            $imageRow= mysqli_fetch_assoc($imageResult);
            $titleRow = mysqli_fetch_assoc($titleResult);
            $priceRow = mysqli_fetch_assoc($priceResult);

            $title = $row['title'];
            $price = $row['price'];
            $imagePath = $row['image'];
            
                echo 
                '<div class="post-box">' .
                    '<div class="image-box">' .
                    '<img height="100%" width="100%" src="data:image;base64,'.$imagePath.'">' .
                    '</div>'  .
                    '<div class ="heading-post">' . $title . '</div>'.
                    '<div class ="price-post">' . $price . ' $</div>'
                .'</div>';
        
        }
    }
?>
                </div>
            </div>
        </div>

    </body>
