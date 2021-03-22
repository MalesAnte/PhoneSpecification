<?php 
include("dp.php");  
include("model/product.class.php"); 
 

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 

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

<br><br><br>
<!--- PONUDA --->
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <h6 class="text-center text-light bg-primary text-center rounded p-1" id="textChange"><b> ZA PREGLED SPECIFIKACIJA MOBITELA MOLIMO DA SE PRIJAVITE! </b></h6>
                <hr>
                <div class="text-center">
                        <img src="slike/loading.gif" id="loader" width="200" style="display:none">
                </div>
                <div class="row" id="result">
                        <?php
                            $sql="SELECT * FROM ponuda";
                            $result=$konekcija->query($sql);
                            while($row=$result->fetch_assoc()){
                        ?>

                        <div class="col-md-3 mb-4">
                            <div class="card-deck">
                                <div class="card border-secondary">
                                    <img src=" <?= $row['Slika']; ?>" class="card-img-top">
                                    <div class="card-img-overlay">
                                    <br><br><br><br><br><br>
                                        <h6 style="margin-top:175px" class="text-light bg-info text-center rounded p-1"> <?= 
                                            $row['Ime'];
                                        ?></h6>
                                    </div>
                                    <br>
                                    <div class="card-body">
                                        <h4 class="card-title text-danger">CIJENA: <?= $row['Cijena'] ?> Kn</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                </div>
            </div>
        </div>
</div>

 
</div> 
    

</body>
</html>