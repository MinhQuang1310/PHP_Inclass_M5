<?php
include_once 'C:/xampp/htdocs/php_inclass_m5/app/views/share/header.php'
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
        <h1 class="h4 text-gray-900 mb-4">Them San Pham</h1>
    </div>
    <form class="user" action="/php_inclass_m5/Product/save" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="name" aria-describedby="name"
                placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="description" placeholder="Description"
                name="description">
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="pricec" placeholder="Price" name="pricec">
        </div>
        <div class="form-group">
            <input type="file" id="image" name="image">
        </div>
        <hr>
        <button class="btn btn-primary">
            Add Product
        </button>

    </form>
</div>

<?php
include_once 'C:/xampp/htdocs/php_inclass_m5/app/views/share/footer.php'
    ?>