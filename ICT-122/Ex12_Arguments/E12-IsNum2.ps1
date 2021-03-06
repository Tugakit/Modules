<#
.NOTES
Name: E12-IsNum.ps1

.SYNOPSIS   
Le script vérifie que la 1ère valeur passée en paramètre est numérique
	
.DESCRIPTION

.PARAMETER 
strValue: la valeur a vérifiée
	
.EXAMPLE
E12-IsNum.ps1 12

#>
Function IsNum2() {

    # Impose une valeur de paramètre et permet qu'il soit transmis par un pipe
    # Force la réception de la valeur sous forme textuelle
    Param([Parameter(Mandatory=$True,ValueFromPipeline=$True)] [string]$strValue)
     
    $res = $strValue -match "^[-+]?([0-9]*\.?[0-9]*)$"
  
    #return the result     
    return $res
   
}

# Pour effectuer les tests demandés
$Args[0] | IsNum2
# Get-Command Get-Member | IsNum2
# $truc = 1234.23
# $truc | IsNum2
# IsNum2
 