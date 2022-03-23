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
foreach ($usersResults as $result) : ?>
<article>
    <form class='form' method='POST' action="index.php?action=updateUser"?>
        <div class="container">
            <p for="code" >ID: <?=$result['id']; ?></p>

            <label for="brand"><b>Email</b></label>
            <input type="text" value='<?=$result['userEmailAddress']; ?>' placeholder="Enter brand" name="inputBrand" required>

            <label for="model"><b>Password hashée</b></label>
            <input type="text" value='<?=$result['userHashPsw']; ?>' placeholder="Enter model" name="inputModel" required>

            <label for="snowLength"><b>Type d'utilisateur</b></label>
            <input type="number" value='<?=$result['userType']; ?>' placeholder="Enter snow length" name="inputSnowLength" required>

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
