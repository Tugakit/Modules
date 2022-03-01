cd C:\

# Si le dossier ESSAIS est encore présent, dans le cas ou il en a pas de dossier l'erreur est ignorée
Remove-Item \ESSAIS\ -Recurse -ErrorAction Ignore

New-Item \ESSAIS -ItemType "directory"
New-Item \ESSAIS\A -ItemType "directory"
New-Item \ESSAIS\B -ItemType "directory"
New-Item \ESSAIS\B\B1 -ItemType "directory"
New-Item \ESSAIS\B\B2 -ItemType "directory"
New-Item \ESSAIS\B\B2A -ItemType "directory"
New-Item \ESSAIS\B\B2B -ItemType "directory"
New-Item \ESSAIS\B\B2C -ItemType "directory"

# Ajout d'un fichier texte dans le dossier racine ESSAIS
New-Item \ESSAIS\ESSAI_1.txt
Copy-Item \ESSAIS\ESSAI_1.txt \ESSAIS\COPIE_ESSAI.txt
Copy-Item \ESSAIS\COPIE_ESSAI.txt \ESSAIS\TEST_1.TXT