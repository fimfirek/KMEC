
<?php
require_once 'config.php';

if (isset($_POST["title"])){
    $title = ($conn, $_POST["title"])
    $price = ($conn, $_POST["price"])
    $sqlInjectProdukty = "INSERT INTO produkty VALUES ('$title','$price')";
    $result = mysqli_query($conn,$sqlControl);
}

else{
    echo '<div class ="alert-box">
    <div class ="alert">NOT Successfull</div>
  </div>';
}

?>
<div class="post-box">
                    <div class="image-box"></div>
                    <div class="heading-post">Jordan 1 High Black</div>
                    <div class="price-post">180,00$</div>
</div>