<?php
    session_start();

    include("dp.php");
    
    if(isset($_POST["action"])){
        $sql="SELECT * FROM ponuda WHERE Brand !=''";
        if(isset($_POST['brand'])){
            $brand=implode("','",$_POST['brand']);
            $sql .="AND Brand IN('".$brand."')";
        }
        if(isset($_POST['memorija'])){
            $memorija=implode("','",$_POST['memorija']);
            $sql .="AND Memorija IN('".$memorija."')";
        }
        if(isset($_POST['ram'])){
            $ram=implode("','",$_POST['ram']);
            $sql .="AND Ram IN('".$ram."')";
        }
        if(isset($_POST['procesor'])){
            $procesor=implode("','",$_POST['procesor']);
            $sql .="AND Procesor IN('".$procesor."')";
        }
        if(isset($_POST['baterija'])){
            $baterija=implode("','",$_POST['baterija']);
            $sql .="AND Baterija IN('".$baterija."')";
        }
        if(isset($_POST['zaslon'])){
            $zaslon=implode("','",$_POST['zaslon']);
            $sql .="AND Zaslon IN('".$zaslon."')";
        }
        $result=$konekcija->query($sql);
        $output='';
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $output .= '
                <div class="col-md-3 mb-2">
                <div class="card-deck">
                    <div class="card border-secondary">
                        <img src="'.$row['Slika'].'" class="card-img-top">
                        <div class="card-img-overlay">
                        <br><br><br><br><br><br><br><br>
                            <h6 style="margin-top:175px" class="text-light bg-info text-center rounded p-1"> 
                            '.$row['Ime'].'
                            </h6>
                        </div>
                        <br><br>
                        <div class="card-body">
                            <h4 class="card-title text-danger">CIJENA: '.$row['Cijena'].' Kn</h4>
                            <p>
                                <b>MEMORIJA:</b> '.$row['Memorija'].' <br>
                                <b>RAM: </b>'.$row['Ram'].' <br>
                                <b>PROCESOR: </b>'.$row['Procesor'].' <br>
                                <b>BATERIJA: </b>'. $row['Baterija'].'<br>
                                <b>ZASLON: </b>'. $row['Zaslon'].' <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                ';
            }   
        }else{
            $output.="<h3>No products found!</h3>";
        } 
        echo $output;
    }
?>