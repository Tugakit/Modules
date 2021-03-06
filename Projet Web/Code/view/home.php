<?php
/**
 * @file      home.php
 * @brief     This view is designed to display the home page
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

ob_start();
$title = "Accueil";
?>
            <div class="searchBar">
           <i class="fa fa-search"></i>
           <input placeholder="6456 Produits dans votre region"></input>
           <i class="fa fa-location-arrow"></i>
            <select name="region" id="region-select">
               <option value="">Votre region</option>
               <option value="Appenzell ">Appenzell </option>
               <option value="Argovie">Argovie</option>
               <option value="Bale">Bale</option>
               <option value="Berne">Berne</option>
               <option value="Fribourg">Fribourg</option>
               <option value="Geneve">Geneve</option>
               <option value="Glaris">Glaris</option>
               <option value="Grisons">Grisons</option>
               <option value="Jura">Jura</option>
               <option value="Lucerne">Lucerne</option>
               <option value="Nidwald">Nidwald</option>
               <option value="Obwald">Obwald</option>
               <option value="Saint-Gall">Saint-Gall</option>
               <option value="Schaffhouse">Schaffhouse</option>
               <option value="Schwytz">Schwytz</option>
               <option value="Soleure">Soleure</option>
               <option value="Tessin">Tessin</option>
               <option value="Thurgovie">Thurgovie</option>
               <option value="Uri">Uri</option>
               <option value="Valais">Valais</option>
               <option value="Vaud">Vaud</option>
               <option value="Zoug">Zoug</option>
               <option value="Zurich">Zurich</option>
            </select>
           <button>Rechercher</button>
        </div>
        
        <div class="categories">
         <h2>Catégories</h2>
            <div class="flex">
               <div class="container">
                  <!--Toutes les images sont en format carré et a 1500x1500--->
                  <img src="img/clothes.jpg"> 
                  <button>Vetements</button>
               </div>

               <div class="container">
                  <img src="img/car.jpg">
                  <button>Automobiles</button>
               </div>

               <div class="container">
                  <img src="img/services.jpg">
                  <button>Services</button>
               </div>

               <div class="container">
                  <img src="img/furniture.jpg">
                  <button href="#">Mobilier</button>
               </div>   
            </div>   
         </div>   

         <div class="starredUsers">
            <h2>Utilisateurs populaires</h2>
            <div class="flex">
               <div class="user">
                  <img src="img/user1.jpg">
                  <a>Username</a> <!-- TODO - Generer des noms/profils pour le prototype -->
               </div>

               <div class="user">
                  <img src="img/user2.jpg">
                  <a>Username</a> <!-- TODO - Generer des noms/profils pour le prototype -->
               </div>

               <div class="user">
                  <img src="img/user3.jpg">
                  <a>Username</a> <!-- TODO - Generer des noms/profils pour le prototype -->
               </div>

               <div class="user">
                  <img src="img/user4.jpg">
                  <a>Username</a> <!-- TODO - Generer des noms/profils pour le prototype -->
               </div>

               <div class="user">
                  <img src="img/user5.jpg">
                  <a>Username</a> <!-- TODO - Generer des noms/profils pour le prototype -->
               </div>
            </div>
         </div>
         <div class="hotarticles">
            <h2>Articles Populaires</h2>
            <div class="flex">
               <div class="container">
                  <img src="img/cam.jpg">
                  <a>Voiture Vintage</a>
               </div>
               <div class="container">
                  <img src="img/car1.jpg">
                  <a>Voiture Vintage</a>
               </div>
               <div class="container">
                  <img src="img/mic.jpg">
                  <a>Microphone de studio</a>
               </div>
               <div class="container">
                  <img src="img/phone.jpg">
                  <a>Iphone x</a>
               </div>
            </div>
         </div>
<?php
$content = ob_get_clean();
require "gabarit.php";
