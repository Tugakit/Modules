<?php
  $title ='Rent A Snow - Login/Logout';

/* This file manages the form used to enable user being register on the platform
 * Title            : vue_login.php
 * Creation         : 12/03/19
 * Author           : nicolas.glassey@cpnv.ch
 * Update           : 31/01/19 - nicolas.glassey@cpnv.ch
 */
ob_start();
?>
    <h1>Modifier le Snow</h1>

        <?php
        foreach ($snowsResults as $result) : ?>
    <article>
            <form class='form' method='POST' action="index.php?action=updateSnow">
            <div class="container">
            <label for="code"><b>Code</b></label>
            <input type="text" value='<?=$result['code']; ?>' placeholder="Enter code" name="inputCode" HIDDEN required>

            <label for="brand"><b>Brand</b></label>
            <input type="text" value='<?=$result['brand']; ?>' placeholder="Enter brand" name="inputBrand" required>

            <label for="model"><b>Model</b></label>
            <input type="text" value='<?=$result['model']; ?>' placeholder="Enter model" name="inputModel" required>

            <label for="snowLength"><b>Snow length</b></label>
            <input type="number" value='<?=$result['snowLength']; ?>' placeholder="Enter snow length" name="inputSnowLength" required>

            <label for="qtyAvailable"><b>Quantity Available</b></label>
            <input type="number" value='<?=$result['qtyAvailable']; ?>' placeholder="Enter quantity available" name="inputQtyAvailable" required>

            <label for="description"><b>Description</b></label>
            <input type="text" value='<?=$result['description']; ?>' placeholder="Enter description" name="inputDescription" required>

            <label for="dailyPrice"><b>Daily Price</b></label>
            <input type="number" value='<?=$result['dailyPrice']; ?>' placeholder="Enter daily price" name="inputDailyPrice" required>

            <label for="photo"><b>Photo</b></label>
            <input type="text" value='<?=$result['photo']; ?>' placeholder="Enter photo path" name="inputPhoto">

            <label for="active"><b>Active</b></label>
            <input type="number" value='<?=$result['active']; ?>' placeholder="Enter active (0/1)" name="inputActive">
                <br>
                <br>
            <button type="submit" class="btn btn-default">Update</button>
        <?php endforeach ?>
            </div>
        </form>
    </article>
<?php
  $content = ob_get_clean();
  require 'gabarit.php';
?>
