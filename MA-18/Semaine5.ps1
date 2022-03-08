cd C:\\
New-Item Fichiers -ItemType Directory
New-Item Fichiers/Texte -ItemType Directory
New-Item Fichiers/Texte/dir.txt
New-Item Fichiers/Texte/windows.txt
New-Item Fichiers/Texte/vide.txt
New-Item Fichiers/PDF -ItemType Directory
New-Item Scripts -ItemType Directory
New-Item Scripts/Test -ItemType Directory
New-Item Scripts/Production -ItemType Directory

Get-Content Fichiers/Texte/dir.txt | Add-Content Fichiers/Texte/texte.txt

New-Alias -Name "vider" Remove-Item

vider Fichiers/Texte/vide.txt