<?php
class Product{
    public static function getProducts (){
        global $konekcija;
        $upit = "SELECT * FROM ponuda";
        $rezultat = mysqli_query($konekcija, $upit);
        $lista = array();
        while ($redak = mysqli_fetch_assoc($rezultat))
            array_push($lista, $redak);
        return $lista;
    }
}
?>