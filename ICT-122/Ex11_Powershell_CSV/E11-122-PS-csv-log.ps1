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

# $addUser="true";

if ($addUser) {

   Write-Host "Nouvel utilisateur"

   Write-Host "------------------"

   $Nom = Read-Host -Prompt "NOM" 

   $Prenom = Read-Host -Prompt "Prenom"

   $Classe = Read-Host -Prompt "Classe"

   $newRow = New-Object PsObject -Property @{ 'Nom' = $Nom ;'Prenom' = $Prenom ; 'Classe' = $Classe }                         

   $csvUsers += $newRow 

   $csvUsers | Write-Host # Affichage des objets

 #  $csvUsers | Out-File $pSScriptRoot\Liste_Eleves.csv  structure avec espaces et pas ';'
   
   $csvUsers | ConvertTo-Csv -NoTypeInformation -Delimiter ";" | % {$_.Replace('"','')} | Out-File $pSScriptRoot\Liste_Eleves.csv

 #  $csvUsers | Export-Csv $pSScriptRoot\Liste_Eleves.csv

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
                       
        
            $msg_erreur = (Get-Date).ToString() + " Repertoire [ " + $_.Nom + " ] : Classe pas spécifiée " 
        
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
