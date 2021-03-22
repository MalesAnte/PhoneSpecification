<?php
session_start();

include("dp.php");

if(isset($_POST["btn-login-confirm"])){
    if($_POST['email-login']==""){
        $error="Molimo unseite e-mail adresu";
    }else if($_POST['password-login']==""){
        $error="Molimo unesite vašu lozinku";
    }else{
        $sql="SELECT * FROM users WHERE ";
        $sql.="email='".$_POST['email-login']."' AND ";
        $sql.="password='".md5($_POST['password-login'])."'";
        $result=mysqli_query($konekcija,$sql);
        if(mysqli_num_rows($result)==0){
            $error="Vaši korisnički podaci nisu ispravni molimo pokušajte ponovo.";
        }else{
            $user=mysqli_fetch_assoc($result);
            $type=$user["typeOfUser"];
            $_SESSION["token"]=$user["id"];
            if($type=='korisnik'){
                header("Location:user-login.php");
            }else if($type=='administrator'){
                header("Location:administration.php");
            }else{
                header("Location:login.php");
            }
            
        }
    }
}
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHONE SPECIFICATION | all in one place</title>
    <link rel="stylesheet" href="css/styleee.css">
    <link rel="shortcut icon" href='slike/logo.jpg'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=sqap" 
    rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <a href="index.php"></a>
    <a href="ponuda.php"></a>
    <a href="login.php"></a>
    <style>
        
        .nav-link{
            display: inline-block;
            color: white;
            text-decoration: none;
        }
        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 1.5px;
            background: white;
            transition: width .3s;
        }

        .nav-link:hover::after {
            width: 100%;
            transition: width .3s;
        }
        .navbar-toggler-icon{
            color:white;
        }
    </style>
</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#" class="ml-3"><img  src="slike/logo.jpg" alt="" style="width:50px;height:50px;"></a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="ponuda.php">MOBITELI</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link text-light" aria-current="page" href="login.php">PRIJAVI SE</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

<br><br><br><br>
    
<!--- PRIJAVA --->

<div class="prijava">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="form-container">
                    <div class="center">
                        <h1>Prijavi se!</h1>
                        <?php if(isset($error)):?>
                            <div class="alert alert-danger"><?php echo ($error)?></div>
                        <?php endif ?>
                        <form method="POST" action="login.php">
                            <div class="txt_field">
                                <span></span>
                                <input type="text" name="email-login" >
                                <label>Email</label>
                            </div>
                            <div class="txt_field">
                                <span></span>
                                <input type="password" name="password-login" >
                                <label>Lozinka</label>
                            </div>
                            <input type="submit" name="btn-login-confirm" value="Prijavi se">
                            <div class="registrirajse">
                                <p>Nemate račun? Registrirajte se <a href="register.php">ovdje</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>