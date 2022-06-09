#Corrigé de l'exercice 06-v3

#Définit que le premier paramètre sera attribué à la varialbe $Parametre01
param(
#$Parametre01
#La ligne en commentaire ci-dessous, permettrait de rendre le parametre obligatoire en position 1, ce qui signifie que le script lancer sans paramètre demanderait à l'utilisateur de renseigner le paramètre.
[Parameter(Mandatory=$True)] [string]$Parametre01
)
write-host "demo" -ForegroundColor $Parametre01

#Test l'existence du dossier ESSAIS, si il existe, supprime la strucutre et son contenu de manière récursive
IF (test-path $Parametre01\ESSAIS) {
    Remove-Item $Parametre01\ESSAIS –recurse
}

#Création de la structure et des différents fichiers
New-Item -type directory $Parametre01\ESSAIS

#Définit l'emplacement de travail actif dans le dossier voulu par l'utilisateur
Set-Location $Parametre01\ESSAIS

New-Item -type file ESSAI_1.txt
Copy-Item ESSAI_1.txt COPIE_ESSAI.txt
Copy-Item ESSAI_1.txt TEST_1.txt

New-Item -type directory A
New-Item -type directory B
Set-Location B
New-Item -type directory B1
New-Item -type directory B2
Set-Location B2
New-Item -type directory B2A
New-Item -type directory B2B
New-Item -type directory B2C
# Set-Location ..\..\..\

sleep 2
