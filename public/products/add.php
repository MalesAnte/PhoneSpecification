<?php
include("../dp.php"); 
include("../model/product.class.php");
Product::saveProduct();
header("Location: ../administration.php");
?>