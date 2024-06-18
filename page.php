<?php 
require_once 'config.php';
require_once 'navbar.php';

$minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : 0;
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : 885.5;
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : '';

$sqlSelect = "SELECT * FROM produkty WHERE price BETWEEN ? AND ?";

switch($sortOrder) {
    case 'alphabetical_asc':
        $sqlSelect .= " ORDER BY title ASC";
        break;
    case 'alphabetical_desc':
        $sqlSelect .= " ORDER BY title DESC";
        break;
    case 'price_asc':
        $sqlSelect .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sqlSelect .= " ORDER BY price DESC";
        break;
    default:
        // No sorting applied
        break;
}

$stmt = mysqli_prepare($conn, $sqlSelect);
mysqli_stmt_bind_param($stmt, "dd", $minPrice, $maxPrice);
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
            <label for="sortOrder">Zoradiť podľa:</label>
            <select id="sortOrder" name="sortOrder">
                <option value="">Vyberte</option>
                <option value="alphabetical_asc" <?php if($sortOrder == 'alphabetical_asc') echo 'selected'; ?>>Od A po Z</option>
                <option value="alphabetical_desc" <?php if($sortOrder == 'alphabetical_desc') echo 'selected'; ?>>Od Z po A</option>
                <option value="price_asc" <?php if($sortOrder == 'price_asc') echo 'selected'; ?>>Od najnižšej po najvyššiu cenu</option>
                <option value="price_desc" <?php if($sortOrder == 'price_desc') echo 'selected'; ?>>Od najvyššej po najnižšiu cenu</option>
            </select>
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
                '<button id="page-account-button"><a href="product-page.php">Produkt</a></button>'
            .'</div>';
        }
    } else {
        echo "No products found.";
    }
?>
    </div>
</div>
