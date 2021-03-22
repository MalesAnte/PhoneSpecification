<?php
include("../dp.php"); 
include("../model/user.class.php");
User::updateUser();
header("Location: ../administration.php");
?>