<?php

class User{
    public static $prijavljeniKorisnik;

    public static function jePrijavljen(){
        global $konekcija;
        $id = $_SESSION["token"];
        $upit = "SELECT * FROM users WHERE id=".$id;
        $rezultat = mysqli_query($konekcija, $upit);
        self::$prijavljeniKorisnik = mysqli_fetch_assoc($rezultat);
        if (self::$prijavljeniKorisnik) {
            return true;
        }
        return false;
    }
    public static function deleteUser ($id) {
        global $konekcija;
        $id=intval($id);
        $sql="DELETE FROM users WHERE id=".$id;
        return mysqli_query($konekcija, $sql);
    }
    public static function addUser(){
        global $konekcija;
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $typeOfUser=$_POST['typeOfUser'];
        $sql="INSERT INTO users VALUES (null,'".$firstName."','".$lastName."','".$address."','".$phone."','".$email."','".$password."','".$typeOfUser."')";
        $result=mysqli_query($konekcija,$sql);
    }
    public static function updateUser(){
        global $konekcija;
        $id=$_POST['update_id'];
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $typeOfUser=$_POST['typeOfUser'];

        $sql="UPDATE users SET firstName='$firstName',surName='$lastName',address='$address',phone='$phone',email='$email',password='$password',typeOfUser='$typeOfUser' WHERE id=".$id;
        $result=mysqli_query($konekcija,$sql);
    }
}
?>