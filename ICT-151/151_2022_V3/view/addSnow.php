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
    <h1>Ajout de Snow</h1>
    <?php if (@$_GET['addSnowError'] == true) :?>
    <h5><span style="color:red">Ajout refusé</span></h5>
    <?php endif ?>
    <article>
        <form class='form' method='POST' action="index.php?action=addSnow">

            <div class="container">
                <label for="code"><b>Code</b></label>
                <input type="text" placeholder="Enter code" name="inputCode" required>

                <label for="brand"><b>Brand</b></label>
                <input type="text" placeholder="Enter brand" name="inputBrand" required>

                <label for="model"><b>Model</b></label>
                <input type="text" placeholder="Enter model" name="inputModel" required>

                <label for="snowLength"><b>Snow length</b></label>
                <input type="number" placeholder="Enter snow length" name="inputSnowLength" required>

                <label for="qtyAvailable"><b>Quantity Available</b></label>
                <input type="number" placeholder="Enter quantity available" name="inputQtyAvailable" required>

                <label for="description"><b>Description</b></label>
                <input type="text" placeholder="Enter description" name="inputDescription" required>

                <label for="dailyPrice"><b>Daily Price</b></label>
                <input type="number" placeholder="Enter daily price" name="inputDailyPrice" required>

                <label for="photo"><b>Photo</b></label>
                <input type="text" placeholder="Enter photo path" name="inputPhoto">

                <label for="active"><b>Active</b></label>
                <input type="number" placeholder="Enter active (0/1)" name="inputActive">
                <br><br>

                <button type="submit" class="btn btn-default">Add</button>
            </div>
        </form>

    </article>
<?php
  $content = ob_get_clean();
  require 'gabarit.php';
?>
