param(
$Source,
$Destination
)

Remove-Item $Destination -Recurse -ErrorAction Ignore
Copy-Item $Source $Destination -Recurse