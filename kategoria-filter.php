<?php 
require_once 'config.php';
require_once 'navbar.php';

$minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : 0;
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : 885.2;
$category = isset($_GET['category']) ? $_GET['category'] : null;

if (isset($_GET['minPrice']) || isset($_GET['maxPrice'])) {
    $sqlSelect = "SELECT * FROM produkty WHERE price BETWEEN ? AND ?";
    $stmt = mysqli_prepare($conn, $sqlSelect);
    mysqli_stmt_bind_param($stmt, "dd", $minPrice, $maxPrice);
} else {
    $sqlSelect = "SELECT * FROM produkty";
    $stmt = mysqli_prepare($conn, $sqlSelect);
}

if ($category) {
    $sqlSelect = "SELECT p.* FROM produkty p JOIN category c ON p.category = c.id WHERE c.name = ?";
    $stmt = mysqli_prepare($conn, $sqlSelect);
    mysqli_stmt_bind_param($stmt, "s", $category);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<div class="blur">
    <div class="filter-container">
        <form action="#" method="get">
            <label for="minPrice">Minimálna cena:</label>
            <input type="number" id="minPrice" name="minPrice" min="0" step="0.50" value="<?php echo $minPrice; ?>">
            <label for="maxPrice">Maximálna cena:</label>
            <input type="number" id="maxPrice" name="maxPrice" min="0" step="0.50" value="<?php echo $maxPrice; ?>">
            <button type="submit">Filter</button>
        </form>
    </div>       
    <div class="container-products">

<?php
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $price = $row['price'];
            $imagePath = $row['image'];
            
            echo 
            '<div class="post-box">' .
                '<div class="image-box">' .
                '<img height="100%" width="100%" src="data:image;base64,'.$imagePath.'">' .
                '</div>'  .
                '<div class ="heading-post">' . $title . '</div>'.
                '<div class ="price-post">' . $price . ' $</div>'.
                '<button id="page-account-button"><a href="product-page.php?category=' . $category . '">Produkt</a></button>'
            .'</div>';
        }
    } else {
        echo "No products found.";
    }
?>
    </div>
</div>
