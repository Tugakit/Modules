<?php
$title ='Rent A Snow – Create';
ob_start();
?>
<h1>Create a Snow</h1>

<article>
    <form class='form'">

        <p>Pour créer un Snow, nous vous prions de renseigner les champs suivants:</p>
        <div class="container">
            <label for="code"><b>Code</b></label>
            <input type="text" placeholder="Enter code" name="inputCode" required>

            <label for="brand"><b>Brand</b></label>
            <input type="text" placeholder="Enter brand name" name="inputBrand" required>

            <label for="model"><b>Model</b></label>
            <input type="text" placeholder="Enter Snow model" name="inputModel" required>

            <label for="length"><b>Length</b></label>
            <input type="number" placeholder="Enter Snow length" name="inputLength" required>

            <label for="quantity"><b>quantity</b></label>
            <input type="text" placeholder="Enter available quantity" name="inputQuantity" required>

            <label for="description"><b>description</b></label>
            <input type="text" placeholder="Enter description" name="inputDescription">

            <label for="price"><b>price</b></label>
            <input type="number" placeholder="Enter price" name="inputPrice">

            <label for="photo"><b>photo</b></label>
            <input type="text" placeholder="Enter photo" name="inputPhoto">

            <p>En soumettant votre demande, vous validez les conditions générales d'utilisation.<a href="https://termsfeed.com/blog/privacy-policies-vs-terms-conditions/">CGU et vie privée</a>.</p>
            <button type="submit" class="registerbtn">Add</button>
        </div>
    </form>
</article>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
