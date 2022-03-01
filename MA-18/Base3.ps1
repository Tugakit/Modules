Function Get-Folder($initialDirectory = "")
{
    [System.Reflection.Assembly]::LoadWithPartialName("System.windows.forms") | Out-Null

    $foldername = New-Object System.Windows.Forms.FolderBrowserDialog #Création de la fenetre de selection du dossier de destination
    $foldername.Description = "Select a folder"
    $foldername.rootfolder = "MyComputer"
    $foldername.SelectedPath = $initialDirectory

    if ($foldername.ShowDialog() -eq "OK") {
        $folder += $foldername.SelectedPath
    }
    return $folder
}

$a = Get-Folder
cd $a

Remove-Item ESSAIS\ -Recurse -ErrorAction Ignore

New-Item ESSAIS -ItemType "directory"
New-Item ESSAIS\A -ItemType "directory"
New-Item ESSAIS\B -ItemType "directory"
New-Item ESSAIS\B\B1 -ItemType "directory"
New-Item ESSAIS\B\B2 -ItemType "directory"
New-Item ESSAIS\B\B2A -ItemType "directory"
New-Item ESSAIS\B\B2B -ItemType "directory"
New-Item ESSAIS\B\B2C -ItemType "directory"

# Ajout d'un fichier texte dans le dossier racine ESSAIS
New-Item ESSAIS\ESSAI_1.txt
Copy-Item ESSAIS\ESSAI_1.txt ESSAIS\COPIE_ESSAI.txt
Copy-Item ESSAIS\COPIE_ESSAI.txt ESSAIS\TEST_1.TXT