cd C:\
Copy-Item C:\Users\Rui-Pedro.PINHEIRO-D\Desktop\Modules\MA-18\MyCorp C:\EvalMA18\
New-Item C:\EvalMA18\Factures -ItemType Directory
New-Item C:\EvalMA18\Projets -ItemType Directory
New-Item C:\EvalMA18\Factures\2013 
New-Item C:\EvalMA18\Factures\2014 
New-Item C:\EvalMA18\Factures\2015
New-Item C:\EvalMA18\Projets\2013
New-Item C:\EvalMA18\Projets\2014 
New-Item C:\EvalMA18\Projets\2015

Copy-Item C:\EvalMA18\ C:\EvalMA18\Factures\2013 -Include *"fact_13"
Copy-Item C:\EvalMA18\ C:\EvalMA18\Factures\2014 -Include *"fact_14"
Copy-Item C:\EvalMA18\ C:\EvalMA18\Factures\2015 -Include *"fact_15"

Copy-Item C:\EvalMA18\ C:\EvalMA18\Projets\2013 -Include *"journal" "13"
Copy-Item C:\EvalMA18\ C:\EvalMA18\Projets\2014 -Include *"journal" "14"
Copy-Item C:\EvalMA18\ C:\EvalMA18\Projets\2015 -Include *"journal" "15"

Cd C:\EvalMA18\Factures\2014\

Get-ChildItem -Include *"C-F" "***T" /// ?