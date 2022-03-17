<?php
/**
 * Author: Pascal.benzonana@cpnv.ch
 * Project  : snowsSeller.php
 * Updated by : 2022 - André MOTTIER
 *              Add CRUD for snows table
 */
require "gabarit.php";
$title="Users list";
// Tampon de flux stocké en mémoire
ob_start();
?>

<article>
    <header>
        <h2> Utilisateurs</h2>

        <div class="table-responsive">
            <table class="table textcolor">
                <tr>
                    <th>Email</th><th>UserType</th> <a href="index.php?action=addUser"><i class="far fa-plus"></i></a></th>
                </tr>

                <?php
                foreach ($usersResults as $result) : ?>
                    <tr>
                        <td><a href="index.php?action=displayAUser&code=<?= $result['code']; ?>"><?= $result['code']; ?></a></td>
                        <td><?= $result['id']; ?></td>
                        <td><?= $result['userEmailAddress']; ?></td>
                        <td><?= $result['userHashPsw']; ?></td>
                        <td><?= $result['userType']; ?></td>
                        <td><a href="index.php?action=deleteSnow&code=<?= $result['code']; ?>"><i class="far fa-file-times"></i></a></td>
                        <td><a href="index.php?action=editSnow&code=<?= $result['code']; ?>"><i class="far fa-edit"></i></td>
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
