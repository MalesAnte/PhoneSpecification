<?php
session_start();
include("dp.php"); 
include("model/user.class.php");

if (!User::jePrijavljen()) header("Location: login.php");
$prijavljeni_korisnik = User::$prijavljeniKorisnik;
if($prijavljeni_korisnik["typeOfUser"] !='administrator'){
    header("Location:login.php");
}

$sql="SELECT * FROM users";
$results=mysqli_query($konekcija,$sql);
$users=$results->fetch_all(MYSQLI_ASSOC);

$sql="SELECT * FROM ponuda";
$results=mysqli_query($konekcija,$sql);
$products=$results->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHONE SPECIFICATION | all in one place</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" href='slike/logo.jpg'>

    <link rel="stylesheet" href="css/dashboardd.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://kit.fontawesome.com/47f0b88d10.js"></script>
</head>
<body>
<div class="modal" tabindex="-1" role="dialog" id="addNewProduct">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Dodavanje proizvoda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="products/add.php" method="POST" id="addUserForm" enctype="multipart/form-data">
                        <div class="row mb-3 gx-3">
                            <div class="form-group col ">
                                <input type="hidden" name="idKorisnika" />
                                <input type="text" name="brand" id="brand" class="form-control form-control-sm" placeholder="Brand" required>
                            </div>
                            <div class="form-group col">                           
                                <input type="text" name="ime" id="ime" class="form-control form-control-sm" placeholder="Ime" required>
                            </div>
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="form-group col">
                                <input type="text" name="cijena" id="cijena" class="form-control form-control-sm" placeholder="Cijena" required>
                            </div>
                            <div class="form-group col">
                                <input type="text" name="zadnja_kamera" id="zadnja_kamera" class="form-control form-control-sm" placeholder="Zadnja kamera" required>
                            </div>
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="form-group col">
                                <input type="text" name="prednja_kamera" id="prednja_kamera" class="form-control form-control-sm" placeholder="Prednja kamera" required>
                            </div>
                            <div class="form-group col">
                                <input type="text" name="ram" id="ram" class="form-control form-control-sm" placeholder="RAM" required>
                            </div>
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="form-group col">
                                <input type="text" name="memorija" id="memorija" class="form-control form-control-sm" placeholder="Memorija" required>
                            </div>
                            <div class="form-group col">
                                <input type="text" name="procesor" id="procesor" class="form-control form-control-sm" placeholder="Procesor" required>     
                            </div>
                        </div>
                        <div class="row mb-3 gx-3">
                            <div class="form-group col">
                                <input type="text" name="baterija" id="baterija" class="form-control form-control-sm" placeholder="Baterija" required>
                            </div>
                            <div class="form-group col">
                                <input type="text" name="zaslon" id="zaslon" class="form-control form-control-sm" placeholder="Zaslon" required>
                            </div>
                        </div>
                        <div class="row mb-3 gx-3">                           
                            <div class="form-group col">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="image">Odaberite sliku</label>
                                    <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="inputGroupFileAddon01">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mr-2"style="float:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                            <input type="submit" class="btn btn-primary"></input>                        
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
    <!--Delete Warning-->
    <div class="modal" tabindex="-1" role="dialog" id="deleteWarningProd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Upozorenje!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <p class="text-primary">Da li ste sigurni da želite izbrisati proizvod?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                <a href="#" id="modalDelete" class="btn btn-primary">Da</a>
            </div>
        </div>
    </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="editProduct">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Uređivanje proizvoda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <input type="text" name="brand" id="brand" class="form-control form-control-sm" placeholder="Brand" required>
                        </div>
                        <div class="col">
                            <input type="text" name="ime" id="ime" class="form-control form-control-sm" placeholder="Ime" required>
                        </div>
                    </div>
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <input type="text" name="cijena" id="cijena" class="form-control form-control-sm" placeholder="Cijena" required>
                        </div>
                        <div class="col">
                            <input type="text" name="zadnjakamera" id="zadnjakamera" class="form-control form-control-sm" placeholder="Zadnja kamera" required>
                        </div>
                    </div>
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <input type="text" name="prednjakamera" id="prednjakamera" class="form-control form-control-sm" placeholder="Prednja kamera" required>
                        </div>
                        <div class="col">
                            <input type="text" name="ram" id="ram" class="form-control form-control-sm" placeholder="Ram" required>
                        </div>
                    </div>
                    <div class="row mb-3 gx-3">
                    <div class="col">
                            <input type="text" name="memorija" id="memorija" class="form-control form-control-sm" placeholder="Memorija" required>
                        </div>
                        <div class="col">
                            <input type="text" name="procesor" id="procesor" class="form-control form-control-sm" placeholder="Procesor" required>
                        </div>
                    </div>
                    <div class="row mb-3 gx-3">
                        <div class="col">
                            <input type="text" name="baterija" id="baterija" class="form-control form-control-sm" placeholder="Baterija" required>
                        </div>
                        <div class="col">
                            <input type="text" name="zaslon" id="zaslon" class="form-control form-control-sm" placeholder="Zaslon" required>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                    <button type="button" class="btn btn-primary">Spremi proizvod</button>
                </div>
            </div>
        </div>
    </div>
    <!--Add New User Modal-->  
    <div class="modal" tabindex="-1" role="dialog" id="addNewUser">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width:300px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Dodavanje korisnika</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="users/add.php" method="POST" >
                    <div class="modal-body">
                        <div class="row mb-1">
                            <div class="form-group col ">
                                <input type="text" name="firstName"  class="form-control form-control-sm" placeholder="Ime" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col ">
                                <input type="text" name="lastName"  class="form-control form-control-sm" placeholder="Prezime" required>                           
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col ">
                                <input type="text" name="address"  class="form-control form-control-sm" placeholder="Adresa" required>                           
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col ">
                                <input type="text" name="phone"  class="form-control form-control-sm" placeholder="Telefon" required>                           
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col">
                                <input type="email" name="email"  class="form-control form-control-sm" placeholder="E-mail" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col">
                                <input type="password" name="password"  class="form-control form-control-sm" placeholder="Lozinka" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col">
                                <label>Uloga korisnika:</label>
                                <select class="form-control" name="typeOfUser" required>
                                    <option value="korisnik">Korisnik</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="superadministrator">Superadministrator</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="mr-2 pb-3"style="float:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                            <button type="submit" name="insertdata" class="btn btn-primary">Spremi</button>                        
                        </div>
                    
                    </div>
                </form>                
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="deleteWarning">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Upozorenje!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <p class="text-primary">Da li ste sigurni da želite izbrisati korisnika?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                <a href="#" id="modalDelete" class="btn btn-primary">Da</a>
            </div>
        </div>
    </div>    
</div>
    <!--Edit Modal-->
    <div class="modal" tabindex="-1" role="dialog" id="editmodal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width:300px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Uređivanje korisnika</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="users/update.php" method="POST" >
                    <div class="modal-body">
                        <div class="row mb-1">
                            <div class="form-group col ">
                            <input type="hidden" name="update_id" id="update_id">
                                <input type="text" name="firstName" id="firstName" class="form-control form-control-sm" placeholder="Ime" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col ">
                                <input type="text" name="lastName" id="lastName" class="form-control form-control-sm" placeholder="Prezime" required>                           
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col ">
                                <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Adresa" required>                           
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col ">
                                <input type="text" name="phone" id="phone" class="form-control form-control-sm" placeholder="Telefon" required>                           
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col">
                                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="E-mail" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col">
                                <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Lozinka" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="form-group col">
                                <label>Uloga korisnika:</label>
                                <select class="form-control" name="typeOfUser" required>
                                    <option value="korisnik">Korisnik</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="superadministrator">Superadministrator</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="mr-2 pb-3"style="float:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                            <button type="submit" name="updatedata" class="btn btn-primary">Spremi</button>                        
                        </div>
                    
                    </div>
                </form>                
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
            </div>
                <div class="container">
                <p class="text-light">
                <b><?php echo ($prijavljeni_korisnik["firstName"]. " ".$prijavljeni_korisnik["surName"]);?></b>
                <p><a href="logout.php">ODJAVI SE</a></p>
                </p>
            </div>
        </nav>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-2">
                <div class="left-sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#pregled">
                           <b> Pregled sustava </b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#korisnici">
                            <b>Korisnici</b>
                        </a>
                    </li>
                    <li class="nav-item">
                            <a type="button" class="nav-link text-primary" data-toggle="modal" data-target="#addNewUser">
                                <b>Dodavanje korisnika</b>
                            </a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="#proizvodi">
                            <b>Proizvodi</b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a type="button" class="nav-link text-primary" data-toggle="modal" data-target="#addNewProduct">
                            <b>Dodavanje proizvoda</b>
                        </a>
                    </li>   
                    
                </ul>
                </div>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="container">
                    <div class="card mt-5" id="pregled" style="scroll-margin-top:80px;">
                        <h5 class="card-header bg-info" style="color:white;" >Pregled sustava</h5>
                        <div class="card-body">
                            <div class="container">
                                <div class="row" style="width:70%; margin:auto;">
                                    <div class="col-md-6">
                                        <div class="box" style="margin:0 auto;">
                                            <h2 style="color:gray;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-people-fill mr-1" viewBox="0 0 16 16">
                                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                                </svg>
                                                <?php 
                                                    $sql="SELECT COUNT(*) as total FROM users";
                                                    $result = mysqli_query($konekcija, $sql);
                                                    $usersCount= mysqli_fetch_assoc($result);
                                                    echo ($usersCount['total']);
                                                ?>
                                            </h2>
                                            <h4 style="color:gray;">Korisnici</h4>                            
                                        </div>
                                    </div>
                                    <div class="col-md-6" >
                                        <h2 style="color:gray;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                            </svg>
                                            <?php 
                                                $sql="SELECT COUNT(*)as total FROM ponuda ";
                                                $result = mysqli_query($konekcija, $sql);
                                                $productsCount= mysqli_fetch_assoc($result);
                                                echo ($productsCount['total']);
                                            ?>
                                        </h2>
                                        <h4 style="color:gray;">Proizvodi</h4>                            
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card mt-5" id="korisnici" style="scroll-margin-top:80px;">
                        <h5 class="card-header bg-info" style="color:white;">Korisnici</h5>
                        <div class="card-body" style="overflow-x:auto;">                         
                            <table class="table">
                                <thead class="thead-light ">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Ime</th>
                                        <th scope="col">Prezime</th>
                                        <th scope="col">Adresa</th>
                                        <th scope="col">Telefon</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Korisnik</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($users as $user):
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center"><?=$user['id']?></td>
                                        <td class="align-middle text-center"><?=$user['firstName']?></td>
                                        <td class="align-middle text-center"><?=$user['surName']?></td>
                                        <td class="align-middle text-center"><?=$user['address']?></td>
                                        <td class="align-middle text-center"><?=$user['phone']?></td>
                                        <td class="align-middle text-center"><?=$user['email']?></td>
                                        <td class="align-middle text-center"><?=$user['typeOfUser']?></td>
                                        <td class="align-middle text-center">
                                            <a href="#" class="btn btn-success  editbtn " title="Uređivanje profila">Uredi</a>
                                            <a  type="button" title="Brisanje profila" class="btn btn-danger text-white" data-toggle="modal" data-id="<?= $user["id"] ?>" data-target="#deleteWarning">Izbriši</a>
                                        </td>
                                    </tr>
                                    <?php endforeach?>
                                </tbody>
                            </table>    
                        </div>
                    </div> 
                    <div class="card mt-5" id="proizvodi" style="scroll-margin-top:80px;">
                        <h5 class="card-header bg-info" style="color:white;">Proizvodi</h5>
                        <div class="card-body" style="overflow-x:auto;">                                       
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Slika</th>
                                        <th scope="col">Ime mobitela</th>
                                        <th scope="col">RAM</th>
                                        <th scope="col">Memorija</th>
                                        <th scope="col">Procesor</th>
                                        <th scope="col">Cijena</th>
                                        <th scope="col">Baterija</th>
                                        <th scope="col">Zaslon</th>
                                        <th scope="col">Uredi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($products as $product):
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center"><?=$product['ID']?></td>
                                        <td class="align-middle text-center"><img src="<?=$product['Slika']?>" alt="" style="width:70px;height:70px;"></td>
                                        <td class="align-middle text-center"><?=$product['Ime']?></td>
                                        <td class="align-middle text-center"><?=$product['Ram']?></td>
                                        <td class="align-middle text-center"><?=$product['Memorija']?></td>
                                        <td class="align-middle text-center"><?=$product['Procesor']?></td>
                                        <td class="align-middle text-center"><?=$product['Cijena']?> Kn</td>
                                        <td class="align-middle text-center"><?=$product['Baterija']?></td>
                                        <td class="align-middle text-center"><?=$product['Zaslon']?></td>
                                        <td class="align-middle">
                                            <a href="#" class="btn btn-success mb-1" title="Uređivanje profila">Uredi</a>
                                            <a  type="button" class="btn btn-danger text-white delete-product" data-toggle="modal" data-id="<?= $product["ID"] ?>" data-target="#deleteWarningProd">Izbriši</a>
                                        </td>
                                    </tr>
                                    <?php endforeach?>
                                </tbody>
                            </table>    
                        </div>                    
                    </div>   
                </div>
            </main>
        
        </div>
    </div>  
    <script>
        $(document).ready(function(){
            $('#deleteWarningProd').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#modalDelete').attr('href', 'products/delete.php?id=' + id);
            });
            $('#deleteWarning').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#modalDelete').attr('href', 'users/delete.php?id=' + id);
            });
            $('.editbtn').on('click',function(){
                $('#editmodal').modal('show');
                $tr=$(this).closest('tr');
                var data=$tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);
                $("#update_id").val(data[0]);
                $("#firstName").val(data[1]);
                $("#lastName").val(data[2]);
                $("#address").val(data[3]);
                $("#phone").val(data[4]);
                $("#email").val(data[5]);
                $("#password").val(data[6]);
                $("#typeOfUser").val(data[7]);
            });
            $('.editbtnProd').on('click',function(){
                $('#editProduct').modal('show');
                $tr=$(this).closest('tr');
                var data=$tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);
                
            });

        });
    
    </script>  
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>