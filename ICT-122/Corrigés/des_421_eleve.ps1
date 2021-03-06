# Jeu du 421 avec stats
# Date de création : 22/03/16
# Date de modification : 29/04/16
# Auteur PBA 
# Function get-number-dice
# avec résultats statistiques dans une Form
# avec résultats lancers dans ISE

[System.Reflection.Assembly]::LoadWithPartialName("System.windows.forms")

Function get-number-dice { 
  
    #Initialisation des variables  
    $de1, $de2, $de3 =0;
    $coups = 0;
    $gagne = 0;

    # 1er tirage des dés
    $de1 = Get-Random -minimum 1 -maximum 7;
    $de2 = Get-Random -minimum 1 -maximum 7; 
    $de3 = Get-Random -minimum 1 -maximum 7;

    # Lancement du jeu
    #for ($coups=1; $coups-lt 6; $coups++)
    while ($coups -lt 6)
    {
        $coups++;
        if ($de1-gt 4) 
        {
            $de1 = Get-Random -minimum 1 -maximum 7;
        }
        if ($de2-gt 2)
        {
            $de2 = Get-Random -minimum 1 -maximum 7;
        }
        if ($de3-gt 1)
        {
            $de3 = Get-Random -minimum 1 -maximum 7;
        }
        
        if ($de1-eq 4 -and $de2-eq 2 -and $de3-eq 1)
        {    
            write-host "bravo vous avez le 421 en" $coups;
            $gagne = 1;
            break;
        }
        else
        {   write-host $de1 "-" $de2 "-" $de3; }

    }

    if ($gagne -eq 1)
    {    
        write-host "bravo vous êtes un champion, vous avez tiré 421 en " $coups "coups";
        $global:nb_gagnants++; 
    }
    else
    {   
        write-host "pas de chance, vous avez utilisé tous vos coups";
        $global:nb_perdants++; 
    }
}

$global:nb_perdants =0;
$global:nb_gagnants =0;
# Création de la boîte de dialogue
$objForm = New-Object System.Windows.Forms.Form
$objForm.width = 360
$objForm.height = 180
$objForm.Text = "Stats du jeu 421"

# Textes 
$objGagne = new-object System.Windows.Forms.Label
$objGagne.Location = new-object System.Drawing.Size(180,80)
$objGagne.size = new-object System.Drawing.Size(100,20)
$objGagne.Text = "Gagnés : "+$global:nb_gagnants
$objForm.Controls.Add($objGagne)

$objPerdu = new-object System.Windows.Forms.Label
$objPerdu.Location = new-object System.Drawing.Size(40,80)
$objPerdu.size = new-object System.Drawing.Size(100,20)
$objPerdu.Text = "Perdus : "+$global:nb_perdants
$objForm.Controls.Add($objPerdu)

# Lancement du jeu
$objBtnLance = new-object System.Windows.Forms.Button
$objBtnLance.Location = new-object System.Drawing.Size(40,20)
$objBtnLance.Size = new-object System.Drawing.Size(100,40)
$objBtnLance.Text = "Lancer les dés"
$objBtnLance.Add_Click({
    get-number-dice(1);
    #Mise à jour des compteurs de résultats
    $objPerdu.Text = "Perdus : "+$nb_perdants 
    $objGagne.Text = "Gagnés : "+$nb_gagnants
})
$objForm.Controls.Add($objBtnLance)

# Sortie du jeu
$objBtnQuit = new-object System.Windows.Forms.Button
$objBtnQuit.Location = new-object System.Drawing.Size(180,20)
$objBtnQuit.Size = new-object System.Drawing.Size(100,40)
$objBtnQuit.Text = "Quitter"
$objBtnQuit.Add_Click({
	$objForm.Close()
})
$objForm.Controls.Add($objBtnQuit)

# Faire apparaitre la boit de dialogue
[void] $objForm.ShowDialog()


