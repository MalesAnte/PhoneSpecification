<?php 

require ("dp.php");
if(isset($_POST['btn-reg-confirm'])){
    $email=$konekcija->real_escape_string($_POST['email']);
    $query="SELECT email FROM users WHERE email = '$email'";
    $result=$konekcija->query($query);
    if($_POST['firstName'] == "" || $_POST['surName'] == "" ||$_POST['address'] == "" ||$_POST['phone'] == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['password-second'] == ""){
        $error="Molimo ispunite sva polja za unos podataka!";
    }else if($result->num_rows>0){
        $error="Korisnik već postoji!";       
    }else if($_POST["password"] != $_POST["password-second"]){
        $error="Molimo unesite iste lozinke kako bi se registrirali!" ;
    }else if(strlen($_POST['password'])<5){
        $error ="Lozinka mora sadržati barem 5 znakova!";
    }else{
        $sql="INSERT INTO users values(null,'";
        $sql.=$_POST["firstName"] ."','";
        $sql.=$_POST["surName"] ."','";
        $sql.=$_POST["address"] ."','";
        $sql.=$_POST["phone"] ."','";
        $sql.=$_POST["email"] ."','";
        $sql.=md5($_POST["password"]) ."','korisnik')";
        $result=mysqli_query($konekcija,$sql);
        $message="Uspješno ste se registrirali!";
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

<br><br><br><br><br><br><br>
<!--- PRIJAVA --->

<div class="prijava">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="form-container">
                    <div class="center">
                        <h1>Registriraj se!</h1>
                        <?php if(isset($error)):?>
                            <div class="alert alert-danger"><?php echo ($error)?></div>
                        <?php endif ?>
                        <?php if(isset($message)):?>
                            <div class="alert alert-success"><?php echo ($message)?></div>
                        <?php endif ?>
                        <form method="POST" action="register.php">
                            <div class="txt_field">
                                <span></span>
                                <input type="text" name="firstName" >
                                <label>Ime</label>
                            </div>
                            <div class="txt_field">
                                <span></span>
                                <input type="text" name="surName" >
                                <label>Prezime</label>
                            </div>
                            <div class="txt_field">
                                <span></span>
                                <input type="text" name="address" >
                                <label>Adresa</label>
                            </div>
                            <div class="txt_field">
                                <span></span>
                                <input type="text" name="phone" >
                                <label>Telefon</label>
                            </div>
                            <div class="txt_field">
                                <span></span>
                                <input type="text" name="email" >
                                <label>Email</label>
                            </div>
                            <div class="txt_field">
                                <span></span>
                                <input type="password" name="password" >
                                <label>Lozinka</label>
                            </div>
                            <div class="txt_field">
                                <span></span>
                                <input type="password" name="password-second" >
                                <label>Ponovite vašu lozinku</label>
                            </div>
                            <input type="submit" name="btn-reg-confirm" value="Registriraj se">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>