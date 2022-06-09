param([string]$baseRep="C:\TMP122")                                                                                                                              

 Import-Csv $pSScriptRoot\Liste_Eleves.csv -Delimiter ";" | Foreach-Object{
            
 if ($_.Classe -eq "") {  
                $msg_erreur = " Repertoire [ " + $_.Nom + " ] : Classe pas spécifiée "                                 
                write-warning $msg_erreur                
                }    
 else{
            Set-Location $baseRep       
            # Création du repertoire utilisateur et copie de la structure SKEL 

            if(!(Test-Path -Path $_.Classe )){ New-Item -type directory $_.Classe }
   
            Set-Location $_.Classe
  
            if(!(Test-Path -Path $_.Nom)) {
        
            New-Item -type directory $_.Nom
   
            Copy-Item $pSScriptRoot\SKEL\* -Destination $_.Nom -Recurse

            }                                                                                                   
         }                                                                                             
   }