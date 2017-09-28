
<?php
//$msg = print_r($_GET, true);
//print_r($_GET);
//echo "<p> haaaaaaaaaaaaaaaaaaa $_POST </p>";
//error_log($msg, 3, "log.txt");

if(isset($_GET['choosen_route']))
{
    $choosen_route= $_GET['choosen_route'];
    echo "<p> haaaaaaaaaaaaaaaaaaa '{$choosen_route}' </p>";
    
    if ($choosen_route === "005") {
     echo "<p> lool </p>";
    }}
?>