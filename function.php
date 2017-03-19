<?php

/*
function curlprovince(){
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: a12ada3a1d42bbfbd24bfe4b70fedd8d"
        )
    ));
    
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    
    curl_close($curl);
    
    $decode = json_decode($response, true);
?>
	Nama Provinsi
    <select name="" id="">
    <?php for ($x = 0; $x <= 33; $x++) { ?>
		<option value="<?php print_r($decode['rajaongkir']['results'][$x]['province']);?>">
            <?php print_r($decode['rajaongkir']['results'][$x]['province']);?>
        </option>
    <?php } ?>
   </select>

<?php } //End Function curlprovince()

*/

function curlcity_asal(){
    global $key,$url;

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url"."city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $key"
        )
    ));
    
    $response 	= curl_exec($curl);
    $err      	= curl_error($curl);
    curl_close($curl);
    $decode 	= json_decode($response, true);
?>
<br>
	<p>Nama Kota/Kab asal</p>
    <select class="form-control" name="city_asal">
        <?php for ($x = 0; $x <= 500; $x++) {?>
            <option value="<?php print_r($decode['rajaongkir']['results'][$x]['city_id']);?>">
                <?php print_r($decode['rajaongkir']['results'][$x]['city_name']);?>
           	</option>
        <?php } ?>
   </select>

<?php } //End Function curlcity_asal



function curlcity_tujuan(){
	global $key,$url;

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url"."city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $key"
        )
    ));
    
    $response 	= curl_exec($curl);
    $err      	= curl_error($curl);
    curl_close($curl);
    $decode 	= json_decode($response, true);
?>
<br>
	<p>Nama Kota/Kab tujuan</p>
    <select class="form-control" name="city_tujuan" id="">
        <?php for ($x = 0; $x <= 500; $x++) { ?>
            <option value="<?php print_r($decode['rajaongkir']['results'][$x]['city_id']);?>">
                <?php print_r($decode['rajaongkir']['results'][$x]['city_name']);?>
           </option>
        <?php } ?>
   </select>
   <br>
<?php }//End function curlcity_tujuan



function hitung_ongkir(){ ?>

    <form action="" method="post">
        <?php curlcity_asal(); curlcity_tujuan();?>
        <p>Berat (Kg)</p>
       	<input class="form-control" type="number" name="weight">
       	<br>
        <input class="btn btn-success" type="submit" name="submit" value="Submit">
    </form>
    <hr>

<?php if (isset($_POST['submit'])) {
		global $key,$url;
        $asal   = $_POST['city_asal'];
        $tujuan = $_POST['city_tujuan'];
        $berat  = $_POST['weight'];
        
        /*
        echo "Asal " . $asal . "<br>";
        echo "Tujuan " . $tujuan . "<br>";
        echo "Berat " . $berat . "<br>";
        echo "<hr>";

        */
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url"."cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$asal&destination=$tujuan&weight=$berat&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $key"
            )
        ));
        
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        $decode = json_decode($response, true);
        for ($x = 0; $x <= 1; $x++) {
            print_r("<h3>JNE ".$decode['rajaongkir']['results'][0]['costs'][$x]['service']."</h3>");
            print_r("<h4>Rp ".$decode['rajaongkir']['results'][0]['costs'][$x]['cost'][0]['value']."</h4>");
            echo "<br>";
        }
    } 

} //End function hitung_ongkir()




//End PHP ?> 