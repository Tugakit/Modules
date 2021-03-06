<#
.NOTES
	Name: E10-menuRepertoire.ps1
	Author: Roberto Ferrari (ETML)
	Modif : JCT/AMR
	Requires: PowerShell v2 
	Version History:1.0
	
.DESCRIPTION
	Create a menu to manage folders and files

.PARAMETER help
	If present the script will display the help menu

.PARAMETER strDirectory
	Directory in which the operations will be executed
    	If absent, the current directory will be used

.EXAMPLE
	.\menuRepertoire.ps1 [-help]

.EXAMPLE
	.\menuRepertoire.ps1 [-strDirectory <string[]>] 


#>
# parametres
param([string]$strDirectory=".", [switch]$help)

# Variables
# *****************************************************************************
# Creation du menu
[string]$strMenu=
@"
    Que voulez-vous faire ?
    1 Afficher le nom du répertoire
    2 Lister les fichiers du répertoire
    3 Informations sur un fichier
    4 Changement de répertoire
    5 Premières lignes d'un fichier
    0 sortie
"@


function Display-Help()
{
$strHelpText = @"
PARAMETRES
help = if present the script will display the help

DESCRIPTION
Create a menu to manage folders and files

"@
    Write-Host $strHelpText
}


# efface l'ecran de toutes anciennes commandes
Clear-Host

# affiche l'aide si demande
if ($help)
{
Display-Help
}

# teste si le repertoire n'est pas vide
elseif($strDirectory -eq "")
{
# message d'erreur pour repertoire invalide
Write-Warning "`n erreur répertoire !"
}
# teste si le repertoire existe
elseif(!(Test-Path $strDirectory -PathType Container))
{
# message d'erreur pour repertoire invalide
Write-Warning "`n répertoire introuvable !"
}
# parametres ok -> traitement
else
{
# propose le menu tant que l'utilisateur ne veut pas mettre fin a programme
do
{
# affiche le menu
Write-Host $strMenu
# recuperation du choix de l'utilisateur
$intResponse = Read-Host "donnez votre choix ?"
#traitements selon le choix de l'utilisateur
switch ($intResponse)
{
0 # sortie
{
# quitte le menu en vidant l'ecran et en affichant un message
Clear-Host
Write-Host "Fin du programme menuRepertoire"
}
1 # affiche le repertoire courant
{
# recupere l'objet dossier, et affiche son nom
Write-Output "`nNom du dossier: $((Get-Item $($strDirectory)).Name)"
}
2 # affiche le contenu du repertoire
{
# message et contenu du repertoire
Write-Host "`nVoici la liste des objets contenu dans le répertoire :
$strDirectory" -ForegroundColor blue
Get-ChildItem $strDirectory
}
3 # informations sur un fichier
{
# demande du nom du fichier a l'utilisateur
$strFileName = Read-Host "`nEntrez un nom de fichier "
# verifie si le fichier existe
if (Test-Path $strFileName )
{
# affiche les infos du fichier
Get-ItemProperty $strFileName
}
# le fichier n'existe pas
else
{
# message d'erreur
Write-Warning "`nFichier incorrect ou inexistant"
}
}
4 # changement de repertoire
{
# demande le nom du repertoire a l'utilisateur
$strDestDirName = Read-Host "Entrez le repertoire de destination"
# verifie si le repertoire existe
if (Test-Path $strDestDirName -PathType Container )
{
# aller dans le repertoire
Set-Location $strDestDirName
# cet emplacement est la nouvelle reference
$strDirectory = $strDestDirName
}
# le repertoire n'existe pas
else
{
# message d'erreur
Write-Warning "`nNom de répertoire incorrect ou inexistant"
}
}
5 # premieres lignes d'un fichier
{
# demande le nom du fichier a l'utilisateur
$strFileName = Read-Host "Entrez un nom de fichier "
# verifie si le fichier existe
if (Test-Path $strFileName -PathType Leaf)
{
# demande le nombre de lignes a afficher a l'utilisateur
$intNbrLines = Read-Host "Entrez un nombre de lignes à afficher:"
# verifie si la valeur entree est un nombre 
if ($intNbrLines –is [int])
{
# affiche les lignes demandees
Get-Content $strFileName -TotalCount $intNbrLines
}
# ce n'est pas un nombre
else
{
# message d'erreur
Write-Warning "`nNombre de lignes incorrect"
}
}
# le fichier n'existe pas
else
{
# message d'erreur
Write-Warning "`nFichier incorrect ou inexistant"
}
}
Default # gestion des cas imprevus par le menu
{
# message d'erreur pour choix invalide
Clear-Host
Write-Warning "`nChoix impossible ... recommencez !"
}
} # end switch
}
while($intResponse -ne 0)
} # end else (traitement)
# *****************************************************************************
# Nom: Display-Help
# But: affiche l'aide a l'ecran
# Arg: -
# *****************************************************************************
function Display-Help()
{
$strHelpText = @"
SYNTAXE
menuRepertoire.ps1 [-strDirectory <string[]>] [-help]
"@
Write-Host $strHelpText
} # Display-Help()