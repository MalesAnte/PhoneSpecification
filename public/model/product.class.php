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
    
    public static function deleteProduct ($id) {
        global $konekcija;
        $id=intval($id);
        $sql="DELETE FROM ponuda WHERE ID=".$id;
        return mysqli_query($konekcija, $sql);
    }
    public static function saveProduct(){
        global $konekcija;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $brand=$_POST['brand'];
            $ime=$_POST['ime'];
            $cijena=$_POST['cijena'];
            $zadnja_kamera=$_POST['zadnja_kamera'];
            $prednja_kamera=$_POST['prednja_kamera'];
            $ram=$_POST['ram'];
            $memorija=$_POST['memorija'];
            $procesor=$_POST['procesor'];
            $baterija=$_POST['baterija'];
            $zaslon=$_POST['zaslon'];
            $target='../slike/'.basename($_FILES['image']['name']);
            $image=$_FILES['image']['name'];
            if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
                $sql="INSERT INTO ponuda VALUES (null,'".$brand."','".$ime."','".$cijena."','".$zadnja_kamera."','".$prednja_kamera."','".$ram."','".$memorija."','".$procesor."','".$baterija."','".$zaslon."','slike/".$image."')";
                mysqli_query($konekcija,$sql);
            }
        }
    }
}
?>