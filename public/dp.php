<?php 

$konekcija=mysqli_connect('localhost','root','','stranicapzi');
//$konekcija=mysqli_connect('localhost','fpmoz172021','csdigital2021','fpmoz172021');

if(!$konekcija){
    die ("Conection failed!" . mysqli_connect_error());
}

?>