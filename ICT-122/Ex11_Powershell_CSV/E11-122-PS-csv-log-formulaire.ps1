<#
.NOTES
Name: E11-122-PS-csv-log.ps1
Author: André Mottier
Date :16.05.2016

.SYNOPSIS   
Création dynamique d'une arborescence de repertoires 
	
.DESCRIPTION   
Création d'une arborescence de repertoires pour chaque utilisateur du fichier Liste_Eleves.csv
Permet également l'ajout d'utilisateurs a ce fichier

.PARAMETER init
.PARAMETER baseRep
.PARAMETER addUser
	
.EXAMPLE
[PS] C:\>.\E11-122-PS-csv-log.ps1
Dans le repertoire de base (Par défaut c:\TMP122):
Création de repertoire pour chaque classe
Création d'un repertoire pour chaque élève du fichier Liste_Eleves.csv dans la classe correspondante,
seulement dans le cas ou le repertoire n'existe pas déjà, 
puis copie de la structure du repertoire SKEL 

.EXAMPLE
[PS] C:\>.\E11-122-PS-csv-log.ps1 -init
Supprime le contenu du repertoire de base 
Puis recrée la structure d'arborescence dynamique d'après Liste_Eleves.csv

.EXAMPLE
[PS] C:\>.\E11-122-PS-csv-log.ps1 -baseRep C:\ESSAIS
Dans le repertoire de base C:\ESSAIS
Création de repertoire pour chaque classe
Création d'un repertoire pour chaque élève du fichier Liste_Eleves.csv dans la classe correspondante,
seulement dans le cas ou le repertoire n'existe pas déjà, 
puis copie de la structure du repertoire SKEL   

.EXAMPLE
[PS] C:\>.\E11-122-PS-csv-log.ps1 -addUser
Permet de saisir les données d'un utilisateur
puis de l'ajouter dans le fichier Liste_Eleves.csv

#>

# Parametres

param([string]$baseRep="C:\TMP122",[switch]$addUser,[switch]$init)

Clear-Host

$csvUsers = Import-Csv $pSScriptRoot\Liste_Eleves.csv -Delimiter ";"

# Ajout d'un nouvel utilisateur dans le fichier csv, puis suppression des guillemets

# $addUser=$true;

if ($addUser) {

function userAdd(){
  [PSObject]$csvUsers = Import-Csv $pSScriptRoot\Liste_Eleves.csv -Delimiter ";"

   $Nom=$txtNom.Text;
   $Prenom=$txtPrenom.Text;
   $Classe=$txtClasse.Text;

   $newRow = New-Object PsObject -Property @{ 'Nom' = $Nom ;'Prenom' = $Prenom ; 'Classe' = $Classe }                         

   $csvUsers += $newRow 

   $csvUsers | Write-Host # Affichage des objets
  
   $csvUsers | ConvertTo-Csv -NoTypeInformation -Delimiter ";" | % {$_.Replace('"','')} | Out-File $pSScriptRoot\Liste_Eleves.csv
  
   $frmAjout.Close()

}

 Add-Type -AssemblyName System.Windows.Forms
[System.Windows.Forms.Application]::EnableVisualStyles()

$frmAjout                        = New-Object system.Windows.Forms.Form
$frmAjout.ClientSize             = '260,249'
$frmAjout.text                   = "Ajout d`'utilisateur"
$frmAjout.TopMost                = $false

$lblNom                          = New-Object system.Windows.Forms.Label
$lblNom.text                     = "Nom"
$lblNom.AutoSize                 = $true
$lblNom.width                    = 25
$lblNom.height                   = 10
$lblNom.location                 = New-Object System.Drawing.Point(32,67)
$lblNom.Font                     = 'Microsoft Sans Serif,10'

$lblPrenom                       = New-Object system.Windows.Forms.Label
$lblPrenom.text                  = "Prenom"
$lblPrenom.AutoSize              = $true
$lblPrenom.width                 = 25
$lblPrenom.height                = 10
$lblPrenom.location              = New-Object System.Drawing.Point(32,98)
$lblPrenom.Font                  = 'Microsoft Sans Serif,10'

$lblClasse                       = New-Object system.Windows.Forms.Label
$lblClasse.text                  = "Classe"
$lblClasse.AutoSize              = $true
$lblClasse.width                 = 25
$lblClasse.height                = 10
$lblClasse.location              = New-Object System.Drawing.Point(33,130)
$lblClasse.Font                  = 'Microsoft Sans Serif,10'

$txtNom                          = New-Object system.Windows.Forms.TextBox
$txtNom.multiline                = $false
$txtNom.width                    = 100
$txtNom.height                   = 20
$txtNom.location                 = New-Object System.Drawing.Point(101,64)
$txtNom.Font                     = 'Microsoft Sans Serif,10'

$txtPrenom                       = New-Object system.Windows.Forms.TextBox
$txtPrenom.multiline             = $false
$txtPrenom.width                 = 100
$txtPrenom.height                = 20
$txtPrenom.location              = New-Object System.Drawing.Point(101,95)
$txtPrenom.Font                  = 'Microsoft Sans Serif,10'

$txtClasse                       = New-Object system.Windows.Forms.TextBox
$txtClasse.multiline             = $false
$txtClasse.width                 = 100
$txtClasse.height                = 20
$txtClasse.location              = New-Object System.Drawing.Point(100,127)
$txtClasse.Font                  = 'Microsoft Sans Serif,10'

$cmdAjout                        = New-Object system.Windows.Forms.Button
$cmdAjout.text                   = "Ajouter"
$cmdAjout.width                  = 60
$cmdAjout.height                 = 30
$cmdAjout.location               = New-Object System.Drawing.Point(29,168)
$cmdAjout.Font                   = 'Microsoft Sans Serif,10'

$frmAjout.controls.AddRange(@($lblNom,$lblPrenom,$lblClasse,$txtNom,$txtPrenom,$txtClasse,$cmdAjout))

$cmdAjout.Add_Click({ userAdd })

[void]$frmAjout.ShowDialog()

} else {

    # Suppression de l'arborescence avec le paramèter -init

    if ($init) { 
        Remove-Item $baseRep -Recurse 
        }    

    # Parcours du fichier csv et création des repertoires

    if(!(Test-Path -Path $baseRep)){ New-Item -type directory $baseRep }
  
    $csvUsers | Foreach-Object{

        Set-Location $baseRep

         # Traitement des erreurs de classe manquante (affichage et ecriture dans un fichier log )

        if ($_.Classe -eq "") {
        
            $d= Get-Date           
        
            $msg_erreur = $d.ToString() + " Repertoire [ " + $_.Nom + " ] : Classe pas spécifiée " 
        
            write-warning $msg_erreur 
        
            $msg_erreur >> $pSScriptRoot\csv_rep_error.log
        
        }
        else{

        write-host $_.Nom
        
            # Création du repertoire utilisateur et copie de la structure SKEL 

            if(!(Test-Path -Path $_.Classe )){ New-Item -type directory $_.Classe }
   
            Set-Location $_.Classe
  
            if(!(Test-Path -Path $_.Nom)) {
        
            New-Item -type directory $_.Nom
   
            Copy-Item $pSScriptRoot\SKEL\* -Destination $_.Nom -Recurse

            }

         }

    }   

}



Set-Location $pSScriptRoot
