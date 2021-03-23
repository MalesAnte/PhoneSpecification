<?php
session_start();
include("dp.php"); 
 
include("model/user.class.php"); 
if (!User::jePrijavljen()) header("Location: login.php");

$prijavljeni_korisnik = User::$prijavljeniKorisnik;
if($prijavljeni_korisnik["typeOfUser"] !='korisnik'){
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHONE SPECIFICATION | all in one place</title>
    <link rel="stylesheet" href="styleee.css">
    <link rel="shortcut icon" href='slike/logo.jpg'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=sqap" 
    rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <a href="index.php"></a>
    <a href="ponuda.php"></a>
    <a href="login.php"></a>
    
    <style>
        body{
            background-color:lavender;
        }
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
            </div>
                <div class="container">
                <p class="text-light" style="right:20px;">
                <b><?php echo ($prijavljeni_korisnik["firstName"]. " ".$prijavljeni_korisnik["surName"]);?></b>
                <p><a href="logout.php">ODJAVI SE</a></p>
                </p>
            </div>
        </nav>
</header>
<br><br><br>
<!--- PONUDA --->
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-2" style="background-color:lightcyan;">
                <h5><b>FILTER PRODUCT </b></h5>
                <h6 class="text-info">Brand </6>
                <ul class="list-group">
                    <?php
                        $sql="SELECT DISTINCT Brand FROM ponuda ORDER BY Brand";
                        $result=$konekcija->query($sql);
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input ponuda_check" value="<?= $row['Brand']; ?>" id="brand"><?= $row['Brand']; ?>
                                </label>
                            </div>
                    </li>
                    <?php } ?>
                </ul>

                <h6 class="text-info">Memorija</6>
                <ul class="list-group">
                    <?php
                        $sql="SELECT DISTINCT Memorija FROM ponuda ORDER BY Memorija";
                        $result=$konekcija->query($sql);
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input ponuda_check" value="<?= $row['Memorija']; ?>" id="memorija"><?= $row['Memorija']; ?>
                                </label>
                            </div>
                    </li>
                    <?php } ?>
                </ul>

                <h6 class="text-info">Ram</6>
                <ul class="list-group">
                    <?php
                        $sql="SELECT DISTINCT Ram FROM ponuda ORDER BY Ram";
                        $result=$konekcija->query($sql);
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input ponuda_check" value="<?= $row['Ram']; ?>" id="ram"><?= $row['Ram']; ?>
                                </label>
                            </div>
                    </li>
                    <?php } ?>
                </ul>

                <h6 class="text-info">Procesor</6>
                <ul class="list-group">
                    <?php
                        $sql="SELECT DISTINCT Procesor FROM ponuda ORDER BY Procesor";
                        $result=$konekcija->query($sql);
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input ponuda_check" value="<?= $row['Procesor']; ?>" id="procesor"><?= $row['Procesor']; ?>
                                </label>
                            </div>
                    </li>
                    <?php } ?>
                </ul>

                <h6 class="text-info">Baterija</6>
                <ul class="list-group">
                    <?php
                        $sql="SELECT DISTINCT Baterija FROM ponuda ORDER BY Baterija";
                        $result=$konekcija->query($sql);
                        while($row=$result->fetch_assoc()){
                    ?>
                    <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input ponuda_check" value="<?= $row['Baterija']; ?>" id="baterija"><?= $row['Baterija']; ?>
                                </label>
                            </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-10" style="background-color:lightcyan";>
                <h5 class="text-center" id="textChange"> <b>PONUDA </b></h5>
                <div class="text-center">
                    <img src="slike/loading.gif" id="loader" width="200" style="display:none">
                </div>
                <br>
                <div class="row" id="result">
                        <?php
                            $sql="SELECT * FROM ponuda";
                            $result=$konekcija->query($sql);
                            while($row=$result->fetch_assoc()){
                        ?>

                        <div class="col-md-3 mb-2">
                            <div class="card-deck">
                                <div class="card border-secondary">
                                    <img src=" <?= $row['Slika']; ?>" class="card-img-top">
                                    <div class="card-img-overlay">
                                    <br><br><br><br><br><br><br><br>
                                        <h6 style="margin-top:175px" class="text-light bg-info text-center rounded p-1"> <?= 
                                            $row['Ime'];
                                        ?></h6>
                                    </div>
                                    <br><br>
                                    <div class="card-body">
                                        <h4 class="card-title text-danger">CIJENA: <?= $row['Cijena'] ?> Kn</h4><br>
                                        <h6 class="text-center">SPECFIKACIJE</h6>
                                        <hr>
                                        <p>
                                            <b>MEMORIJA: </b><?= $row['Memorija']; ?> <br>
                                            <b>RAM: </b><?= $row['Ram']; ?> <br>
                                            <b>PROCESOR: </b><?= $row['Procesor']; ?> <br>
                                            <b>BATERIJA: </b><?= $row['Baterija']; ?> <br>
                                            <b>ZASLON: </b><?= $row['Zaslon']; ?> <br>
                                        </p>
                                        <hr>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".ponuda_check").click(function(){
                $("#loader").show();
                var action='data';
                var brand=get_filter_text('brand');
                var memorija=get_filter_text('memorija');
                var ram=get_filter_text('ram');
                var procesor=get_filter_text('procesor');
                var baterija=get_filter_text('baterija');
                var zaslon=get_filter_text('zaslon');
                $.ajax({                              
                    url:'action.php',
                    method:'POST',
                    data:{action:action,brand:brand,memorija:memorija,ram:ram,procesor:procesor,baterija:baterija,zaslon:zaslon},
                    success:function(response){
                        $("#result").html(response);
                        $("#loader").hide();
                        $("#textChange").text("Filtrirani proizvodi");
                    }
                });
            });
            function get_filter_text(text_id){
                var filterData=[];
                $('#'+ text_id + ':checked').each(function(){
                    filterData.push($(this).val());
                });
                return filterData;
            }
        });
    </script>
</body>
</html>