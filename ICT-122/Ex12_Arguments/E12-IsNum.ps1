<#

.SYNOPSIS   
    Le script vérifie que la 1ère valeur passée en paramètre est numérique.

.DESCRIPTION
    Le script vérifie que la 1ère valeur passée en paramètre est numérique.

.EXAMPLE
    E12-IsNum.ps1 12
    true

.EXAMPLE
    E12-IsNum.ps1 12.3.2
    false

.NOTES
    Name: E12-IsNum.ps1

#>
# Set-Location $PSScriptRoot

function IsNum([string]$strValue) {

    # Force la réception de la valeur sous forme textuelle
    # Param([string]$strValue)

   $res = $strValue -match "^[-+]?([0-9]*\.?[0-9]*)$"
   
    #return the result     
    return $res
}
IsNum $Args[0]