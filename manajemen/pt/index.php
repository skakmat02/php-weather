<?php
    $json=file_get_contents("https://www.banpt.or.id/direktori/model/dir_aipt/get_hasil_pencarian.php?_=1565927492629");
    $data =  str_replace('\/','/',$json);
	//echo $data;

$json_string = file_get_contents("https://www.banpt.or.id/direktori/model/dir_aipt/get_hasil_pencarian.php?_=1565927492629");
$array = json_decode($json_string, true);

//echo "<style>table{width:100%;}table tr th{background-color:orange;color:black;}table tr td{background-color:green;color:white;} table tr td font{font-size:15px;} table td font{font-size:12px;} table td{background-color:white;} table td font{font-size:12px;} table td:hover{background-color:green;}</style>";

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">



<table id="asek" class="display" border="1" cellpadding="10">
    <thead><tr style="background-color:green;color:white"><th>No.</th><th>Perguruan Tinggi</th><th>Peringkat</th><th>No. SK</th><th>Tahun SK</th><th>Tanggal Kedaluwarsa</th><th>Status</th></tr></thead>
    <tbody>
    <?php $i=1; foreach($array['data'] as $key => $value): ?>
        <?php if($value[0] == "Universitas Pembangunan Nasional Veteran Jawa Timur"){ ?> <tr style="background-color:white;">
           <td><?php echo $i++; ?></td>
<td><?php echo $value[0]; ?></td>
             <td><?php echo "<strong><font style='color:"; if ($value[1] == 'A'){echo "green";}else{echo "black";} echo "'>".$value[1]."</font></strong>"; ?></td>
             <td><?php echo $value[2]; ?></td>
             <td><?php echo $value[3]; ?></td>
              <td><?php echo $value[5]; ?></td>

               <td><?php echo "<strong><font style='color:"; if ($value[6] == 'Masih berlaku'){echo "green";}else{echo "red";} echo "'>".$value[6]."</font></strong>"; ?></td>


        </tr> <?php }else{}  ?>

    <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#asek').DataTable(
      {
        "paging":   false,
        "ordering": false,
        "info":     false,
        "filter":   false
    }
    );
} );
</script>
