<?php
/**
 * Author: Pascal.benzonana@cpnv.ch
 * Project  : snowsSeller.php
 * Updated by : 2022 - André MOTTIER
 *              Add CRUD for snows table
 */

$title="Nos snowboards";
// Tampon de flux stocké en mémoire
ob_start();
?>

<article>
    <header>
        <h2> Nos snows</h2>

        <div class="table-responsive">
            <table class="table textcolor">
                <tr>
                    <th>Code</th><th>Marque</th><th>Modèle</th><th>Longueur</th><th>Prix</th><th>Disponibilité</th><th>Photo</th>Actif<th></th><th></th><th> <a href="index.php?action=addSnow"><i class="far fa-plus"></i></a></th>
                </tr>

                <?php
                foreach ($snowsResults as $result) : ?>
                    <tr>
                        <td><a href="index.php?action=displayASnow&code=<?= $result['code']; ?>"><?= $result['code']; ?></a></td>
                        <td><?= $result['brand']; ?></td>
                        <td><?= $result['model']; ?></td>
                        <td><?= $result['snowLength']; ?> cm</td>
                        <td>CHF <?= $result['dailyPrice']; ?>.- par jour</td> <!-- Prices are not float -->
                        <td><?= $result['qtyAvailable']; ?></td>
                        <td><img src="<?= $result['photo']; ?>" style="height: 20px"></td>
                        <td><?= $result['active']; ?></td>
                        <td><i class="far fa-file-times"></i></td>
                        <td><i class="far fa-edit"></i></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </header>
</article>
<hr/>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
