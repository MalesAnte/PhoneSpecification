<?php
include("../dp.php"); 
include("../model/product.class.php");
Product::deleteProduct($_GET["id"]);
header("Location: ../administration.php");
?>