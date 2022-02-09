<?php

$title="Snows Details";
ob_start();
?>
<article>
    <header>
        <h2> Nos snows</h2>
        <div>

            <h1>Détails</h1>

        </div>
    </header>
</article>
<hr/>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>
