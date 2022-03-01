<?php
/**
 * @file      gabarit.php
 * @brief     This view is designed to centralize all common graphical component like header and footer (will be call by all views)
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY & Pascal BENZONANA
 * @version   03-MAY-2020
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?=$title; ?></title>
    <meta charset="UTF-8">

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--
    Next Level CSS Template
    https://templatemo.com/tm-532-next-level
    -->
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" />
    <link rel="stylesheet" href="view/content/css/all.min.css" />
    <link rel="stylesheet" href="view/content/css/bootstrap.min.css" />
    <link rel="stylesheet" href="view/content/css/templatemo-style.css" />
</head>
<body>
<div class="row tm-brand-row">
    <div class="col-lg-4 col-10">
        <div class="tm-brand-container">
            <div class="tm-brand-texts">
                <h1 class="text-uppercase tm-brand-name">Next Level</h1>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-2 tm-nav-col">
        <div class="tm-nav">
            <nav class="navbar navbar-expand-lg navbar-light tm-navbar">
                <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto mr-0">
                        <li class="nav-item active">
                            <div class="tm-nav-link-highlight"></div>
                            <a class="nav-link" href="#"
                            >Home <span class="sr-only">(current)</span></a
                            >
                        </li>

                        <?php if (!isset($_SESSION['userEmailAddress']) || (!isset($_GET['action'])) || ((@$_GET['action'] == "logout"))) : ?>
                            <li class="nav-item">
                                <div class="tm-nav-link-highlight"></div>
                                <a class="nav-link" href="index.php?action=login">Login</a>
                            </li>
                            <li class="nav-item">
                                <div class="tm-nav-link-highlight"></div>
                                <a class="nav-link" href="index.php?action=register">Register</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <div class="tm-nav-link-highlight"></div>
                                <a class="nav-link" href="index.php?action=logout">Logout</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<?=$content; ?>

<div>
<!-- Page footer -->
<footer class="row tm-page-footer">
    <p class="col-12 tm-copyright-text mb-0">
        Copyright &copy; 2019 Next Level Company... Designed by
        <a href="https://fb.com/templatemo" rel="nofollow" class="tm-copyright-link">Template Mo</a>
    </p>
</footer>
</div>

<script src="view/content/js/jquery.min.js"></script>
<script src="view/content/js/parallax.min.js"></script>
<script src="view/content/js/bootstrap.min.js"></script>
</body>
</html>