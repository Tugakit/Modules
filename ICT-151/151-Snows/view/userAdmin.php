<?php
/**
 * Author: Pascal.benzonana@cpnv.ch
 * Project  : snowsSeller.php
 * Updated by : 2022 - André MOTTIER
 *              Add CRUD for snows table
 */
$title="Users list";
// Tampon de flux stocké en mémoire
ob_start();
?>
<article>
        <h2> Utilisateurs</h2>

        <div class="table-responsive">
            <table class="table textcolor">
                <tr>
                    <th>Id</th><th>Email</th><th>Hash</th><th>Type</th> <a href="index.php?action=register"><i class="far fa-plus"></i></a></th>
                </tr>

                <?php
                foreach ($usersResults as $result) : ?>
                    <tr>
                        <td><?= $result['id']; ?></td>
                        <td><?= $result['userEmailAddress']; ?></td>
                        <td><?= $result['userHashPsw']; ?></td>
                        <td><?= $result['userType']; ?></td>
                        <td><a href="index.php?action=deleteUser&id=<?= $result['id']; ?>"><i class="far fa-file-times"></i></a></td>
                        <td><a href="index.php?action=editUser&id=<?= $result['id']; ?>"><i class="far fa-edit"></i></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
</article>
<hr/>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
