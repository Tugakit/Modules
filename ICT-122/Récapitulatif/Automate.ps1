<#
.SYNOPSIS   
    Simulate a vending machine

.DESCRIPTION
    Simulate a vending machine, selling goods at a fixed price (5). Stock is not managed
	
.PARAMETER coin
    Amount inserted into the vending machine

.EXAMPLE
    PS>.\Automate.ps1 2 # ajoute 2 francs et affiche le montant total

.EXAMPLE
    PS>.\Automate.ps1 -stop # interrompt la procédure

.EXAMPLE
    PS>.\Automate.ps1 –select 4 # Sél. une boisson, « 4 » étant la position

.NOTES
    Name: Automate.ps1 
    Author: JCT and more
    Requires: Tested with PowerShell v4 only. 
#>
param([float] $coin, [int] $selection, [switch] $stop)
set-location $PSScriptRoot


$file = "totalAmount.txt"
[float] $totalAmount = Get-Content -Path $file -First 1
if ($coin) {
    if (($coin -eq 0.5) -or ($coin -eq 1) -or ($coin -eq 2) -or ($coin -eq 5)) {
        $totalAmount=$totalAmount+$coin        
        $totalAmount > $file
        Write-Host $totalAmount
    }
    else {
        Write-Host "Pièce non reconnue"
    }
}

if ($selection) {
    if (($selection -lt 0) -or ($selection -gt 20)) {
        Write-Host "Position non reconnue"
    } else {
        if ($totalAmount -ge 5) {
            $totalAmount=$totalAmount-5        
            $totalAmount > $file
            Write-Host "Veuillez récupérer votre produit"
        } else {
            Write-Host "Solde insuffisant"
        }
    }
}

if ($stop) {
    Write-Host "Interruption > Monnaie retournée: $totalAmount"
    $totalAmount=0;
    $totalAmount > $file
}

Write-Host "Total en caisse: $totalAmount"