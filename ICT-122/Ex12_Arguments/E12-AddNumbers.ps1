<#
.NOTES
	Name: E12-AddNumbers.ps1
	Author: 
	Requires: 
	Version History:
#>

function IsNum($inputNum) {
    #declaration
    $valTest = $inputNum
    #write-host $valTest
    $res = $valTest -match "^[-+]?([0-9]*\.?[0-9]*)$"

    #return the result
    # write-host $res
    return $res
   
}

if($Args.Length -eq 0) {
    Write-Warning "Script lancé sans paramètre."
} else {
    # La var somme est définie pour permettre la plus grande représentation
    [double]$doubleSum = 0
    # On parcourt tous les arguments
    for ($i = 0; $i -lt $Args.Length; $i++) {
        # Si numérique on fait la somme
        if (IsNum($Args[$i])) {
            $doubleSum += [double]$Args[$i]
        }
    }
    # Il ne reste plus qu'à afficher la somme
    Write-Host "La somme des nombres passés en paramètre vaut: $doubleSum"
}