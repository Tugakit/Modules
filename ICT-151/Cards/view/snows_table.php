<?php
/**
 * Author: A.Mottier
 * Project  : snowUser.php
 */

$title="Snows";

ob_start();
$rows=0; // Column count
?>

<article>
    <header>
        <h2> Nos snows</h2>

<table>

            <?php foreach ($snowsResults as $result) : ?>
    <tr>
       <td>
           <?= $result['code']; ?>
       </td>
        <td>
            <?= $result['brand']; ?>
        </td>
        <td>
            <?= $result['model']; ?>
        </td>

    </tr>
            <?php endforeach ?>
</table>

    </header>
</article>
<hr/>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
