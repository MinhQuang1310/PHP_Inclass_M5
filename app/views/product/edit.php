<?php
include_once 'C:/xampp/htdocs/Sang5/app/views/share/header.php'
    ?>

<?php
if (isset ($errors)) {
    echo "<ul>";
    foreach ($errors as $err) {
        echo "<li>" . $err . "</li>";
    }
    echo "</ul>";
}
?>

<div class="p-5">
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Sua San Pham</h1>
    </div>
    <form class="user" action="/Sang5/Product/save" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$product->id?>" > 
        <div class="form-group">
            <input type="text" value="<?=$product->name ?>" class="form-control form-control-user" id="name"
                aria-describedby="name" placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <input type="text" value="<?=$product->description ?>" class="form-control form-control-user" id="description"
                placeholder="Description" name="description">
        </div>
        <div class="form-group">
            <input type="text" value="<?=$product->pricec ?>" class="form-control form-control-user" id="pricec"
                placeholder="Price" name="pricec">
        </div>
        <div class="form-group">
            <?php
            if (!empty ($product->image)) {
                echo "<img src='/Sang5/" . $product->image . "' alt='' style='width: 100px; height: 100px;' />";
            } else {
                echo "No Image";
            }
            ?>
            <input type="file" value="<? $product->image ?>" id="image" name="image">
        </div>
        <hr>
        <button class="btn btn-primary">
            Edit Product
        </button>

    </form>
</div>

<?php
include_once 'C:/xampp/htdocs/Sang5/app/views/share/footer.php'
    ?>