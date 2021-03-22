<?php
include("../dp.php"); 
include("../model/user.class.php");
User::addUser();
header("Location: ../administration.php");
?>