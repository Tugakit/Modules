cd C:\
mkdir Sauvegarde
cd C:\Sauvegarde
Copy-Item C:\temp\Copie C:\Sauvegarde -Recurse
cd C:\Sauvegarde\Copie
Copy-Item C:\Sauvegarde\copie\tmp20150112 C\Sauvegarde\copie\FromSDCard
Copy-Item C\Sauvegarde\copie\xyz C:\Sauvegarde\copie\FromSIMCard
New-Item C:\Sauvegarde\copie\Copie.cat
New-Item C:\Sauvegarde\copie\SDCard.cat
New-Item C:\Sauvegarde\copie\SIMCard.cat
Get-ChildItem -path C:\Sauvegarde\copie -Recurse -File | Add-Content C:\Sauvegarde\copie\Copie.cat
Get-ChildItem -path C:\Sauvegarde\FromSDCard -Recurse -File | Add-Content C:\Sauvegarde\copie\SDCard.cat
Get-ChildItem -path C:\Sauvegarde\FromSIMCard -Recurse -File | Add-Content C:\Sauvegarde\copie\SIMCard.cat
Move-Item C:\Sauvegarde\copie\SIMCard.cat C:\Sauvegarde