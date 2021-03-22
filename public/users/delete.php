<?php
include("../dp.php"); 
include("../model/user.class.php");
User::deleteUser($_GET["id"]);
header("Location: ../administration.php");
?>