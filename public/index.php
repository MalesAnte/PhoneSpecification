<?php 

include("dp.php");

$upit = "SELECT * FROM korisnik";

$rezultat = mysqli_query($konekcija, $upit);
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHONE SPECIFICATION | all in one place</title>
    <link rel="shortcut icon" href='slike/logo.jpg'>
    <link rel="stylesheet" href="css/styleee.css">
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
    <div class="header">
        <div class="container">
            <br>
            <div class="row">
                <div class="col-6">
                    <h1>Dobro do??li na stranicu<br>PHONE SPECIFICATION</h1>
                    <p>STRANICA JE JO?? U IZRADI</p>
                    <br>
                    <h5>Viziju projekta mo??ete pogledati <a href="https://drive.google.com/file/d/1jCNbJBS2SSJpoAOb9UJVLzTsT5MiIMOo/view?usp=drivesdk">Ovdje.</a></h5>
                </div>
                
            </div>
        </div>
    </div>

    <br><br><br>

    <!--- TEHNOLOGIJE --->

    <div class="small-container">
        <h2 class="title">TEHNOLOGIJE</h2>
        <div class="row">
            <div class="col-4">
                <img src="slike/frontend.jpg.jpg">
                <h4>FRONTEND TEHNOLOGIJA</h4>
                <p>Za izgled stranice koristimo jezike kao ??to su HTML,CSS i JavaScript,ali koristimo i Bootstrap i VueJS</p>
            </div>
            <div class="col-4">
                <img src="slike/backend.jpg.jpg">
                <h4>BACKEND TEHNOLOGIJA</h4>
                <p>Za stvaranje stranice koristimo JavaScript i framework Laravel, a za spremanje podataka kotistimo MySQL.</p>
            </div>
        </div>
    </div>
    <!---O NAMA --->
    <div class="onama">
        <h2 class="title">O NAMA</h2>
        <div class="small-container">
            <div class="row">
                <div class="col-4">
                    <img src="slike/Domagoj.jpg.jpg">
                    <h3>Domagoj Vukadin</h3>
                    <p>Student 3. godine Informatika, 20 godina</p>
                    <p> 2014-2018.- Srednja ??kola Kupres</p>
                    <p>2018.- FPMOZ</p>
                    <br>
                    <i class="fa fa-instagram" aria-hidden="true"><a href="https://www.instagram.com/domacc_/"><b>  domacc_</b></a></i><br>
                    <i class="fa fa-facebook-official" aria-hidden="true"><a href="https://www.facebook.com/domagoj.vukadin.5"><b>  Domgoj Vukadin</b></a></i>
                </div>
                <div class="col-4">
                    <img src="slike/AnteMales.jpg.jpeg">
                    <h3>Ante Male??</h3>
                    <p>Student 3. godine Informatika, 20 godina</p>
                    <p> 2014-2018.- Srednja ??kola Kupres</p>
                    <p>2018.- FPMOZ</p>
                    <br><br><br><br>
                    <i class="fa fa-instagram" aria-hidden="true"><a href="https://www.instagram.com/ante.males_99/"><b>  ante.males_99</b></a></i><br>
                    <i class="fa fa-facebook-official" aria-hidden="true"><a href="https://www.facebook.com/antemales3"><b>  Ante Male??</b></a></i>
                </div>
            </div>
        </div>
    </div>

<!--- ikone --->

</body>
</html>