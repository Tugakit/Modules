#Variables globales
$Money = 0
$Price = 0
$Position = 0

function IsNum($Args) {

   $res = $Args -match "^[-+]?([0-9]*\.?[0-9]*)$"
        
   return $res
}

function AddMoney($Args){
   if (isNum){
    $Money+=$Arg[0]
    return $Money
   }
} 

function Select(){
param(
[Parameter()] [Float]$Select
)
$Position = $Select
return $Select
}
$Position = $Select
Write-Host " Hello $Position"