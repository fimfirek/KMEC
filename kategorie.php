<?php 
require_once 'config.php';
require_once 'navbar.php';
?>
<div class="blur">
<div class="category-products">

<?php

$sqlSelect = "SELECT DISTINCT c.name AS category_name 
              FROM category c 
              INNER JOIN produkty p ON c.id = p.category";    
$result = mysqli_query($conn, $sqlSelect);

if(mysqli_num_rows($result) >= 1) {
    while($row = mysqli_fetch_assoc($result)) {
        $category_name = $row['category_name'];

        echo 
        '<div class="category-box">' .
        '<div class ="heading-post">' . $category_name. '</div>'.
        '<button id="page-account-button"><a href="kategoria-filter.php?category=' . urlencode($category_name) . '">Produkty</a></button>'
.'</div>';
    }
} else {
    echo "No categories found.";
}
?>
</div>
</div>
