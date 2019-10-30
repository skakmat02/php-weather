<?php

$kota = $_GET['kota'];
$koneksi = mysqli_connect("localhost", "root", "asek4ever", "weather");

$cekdulu= "SELECT * FROM tb_kota WHERE kota LIKE '$kota'"; //username dan $_POST[un] diganti sesuai dengan yang kalian gunakan
$prosescek= mysqli_query($koneksi, $cekdulu);
if (mysqli_num_rows($prosescek)>0) { //proses mengingatkan data sudah ada

    $cekdulu2= "SELECT * FROM tb_kota WHERE kota LIKE '$kota' LIMIT 1";
    $prosescek2= mysqli_query($koneksi, $cekdulu2);
    foreach ($prosescek2 as $row) {
        $myData = file_get_contents("https://api.weather.com/v2/turbo/vt1observation?apiKey=d522aa97197fd864d36b418f39ebb323&format=json&geocode=".$row['lat']."%2C".$row['long']."&language=id-ID&units=m");
    }
    $myObject = json_decode($myData);
  //  echo $myData;?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

  <style>
  @import url(https://fonts.googleapis.com/css?family=Montserrat);
  @import url(https://fonts.googleapis.com/css?family=Advent+Pro:400,200);
  *{margin: 0;padding: 0;}


  .widget{
    box-shadow:0 40px 10px 5px rgba(0,0,0,0.4);
    margin:100px auto;
    height: 330px;
    position: relative;
    width: 500px;
  }

  .upper{
    border-radius:5px 5px 0 0;
    background:#f5f5f5;
    height:200px;
    padding:20px;
  }

  .date{
    font-size:55px;
  }
  .year{
    font-size:30px;
    color:#c1c1c1;
  }
  .place{
    color:#222;
    font-size:40px;
  }
  .lower{
    background:#e67354;
    border-radius:0 0 5px 5px;
    font-family:'Advent Pro';
    font-weight:200;
    height:130px;
    width:100%;
  }
  .clock{
    background:#e67354;
    border-radius:100%;
    box-shadow:0 0 0 15px #f5f5f5,0 10px 10px 5px rgba(0,0,0,0.3);
    height:150px;
    position:absolute;
    right:25px;
    top:-35px;
    width:150px;
  }

  .hour{
    background:#f5f5f5;
    height:50px;
    left:50%;
    position: absolute;
    top:25px;
    width:4px;
  }

  .min{
    background:#f5f5f5;
    height:65px;
    left:50%;
    position: absolute;
    top:10px;
    transform:rotate(100deg);
    width:4px;
  }

  .min,.hour{
    border-radius:5px;
    transform-origin:bottom center;
    transition:all .5s linear;
  }

  .infos{
    list-style:none;
  }
  .info{
    color:#fff;
    float:left;
    height:100%;
    padding-top:10px;
    text-align:center;
    width:25%;
  }
  .info span{
    display: inline-block;
    font-size:40px;
    margin-top:20px;
  }
  .weather p {
    font-size:20px;padding:10px 0;
  }
  .anim{animation:fade .8s linear;}

  @keyframes fade{
    0%{opacity:0;}
    100%{opacity:1;}
  }
  </style>


  <div class="widget">
    <div class="clock">
     <center><div style="font-size:18px;position: absolute;top:10%;left:9%"><?php
         foreach ($myObject as $keys => $values):
                $asek13=$values->icon; if($asek13==""){}else{echo "<img src='https://icons.wxug.com/i/c/v4/".$values->icon.".svg' style='width:120px'>";}
              endforeach;?></div></center>
    </div>
    <div class="upper">
      <div style="font-size:25px;" class="date"><?php echo date('h:i ;a'); ?></div>
      <div class="year"><?php echo date('d M Y'); ?></div>
      <div class="place update"><?php echo $kota; ?></div>
      <div style="font-size:18px;" class="place update"><?php
          foreach ($myObject as $keys => $values):
                 $asek12=$values->phrase; if($asek12==""){}else{ echo $values->phrase;}
               endforeach;?></div>
               <div style="font-size:15px;" class="place update"><?php
                   foreach ($myObject as $keys => $values):
                          $asek11=$values->uvIndex; if($asek11==""){}else{ echo "Indeks UV : ".$values->uvIndex." dari 10 (".$values->uvDescription.")";}
                        endforeach;?></div>
    </div>
    <div class="lower">
      <ul class="infos">
        <li class="info temp">
          <h3 class="title">Temperatur</h3>
          <span class='update'><?php
              foreach ($myObject as $keys => $values):
                     $asek1=$values->temperature; if($asek1==""){}else{ echo $values->temperature." <sup>o</sup>C";}
                     endforeach;?>
                   </span>
        </li>
        <li class="info weather">
          <h3 class="title">Suhu Tertinggi</h3>
          <span class='update'><?php
              foreach ($myObject as $keys => $values):
                     $asek2=$values->temperatureMaxSince7am; if($asek2==""){}else{ echo $values->temperatureMaxSince7am." <sup>o</sup>C";} endforeach; ?></span>

        </li>
        <li class="info wind">
          <h3 class="title">Angin</h3>
          <span class='update'><?php
              foreach ($myObject as $keys => $values):
                     $asek3=$values->temperature; if($asek3==""){}else{ echo $values->windSpeed." km/h";} endforeach; ?></span>
        </li>
        <li class="info humidity">
          <h3 class="title">Kelembaban</h3>
          <span class='update'><?php
              foreach ($myObject as $keys => $values):
                     $asek4=$values->temperature; if($asek4==""){}else{ echo $values->humidity." %";} endforeach; ?></span>
        </li>
      </ul>
    </div>
  </div>
<?php
} else {
    echo "<script>alert('Data Kota Tidak Ada');</script>";
}
?>
