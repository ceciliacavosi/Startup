				<html>
					<head>
						<title>Udienze attuali</title>
<?php
	$udienze=array();
	$docenti=array();
	if(file_exists("udienze.json")){
		$udienze = json_decode(file_get_contents("udienze.json"))->udienze;
	}
	if(file_exists("docenti.json")){
		$docenti = json_decode(file_get_contents("docenti.json"))->docenti;
	}

	function materia($nomeCmp, $classeCmp, $docenti){
		foreach($docenti as $docente) {
			if($docente->nome == $nomeCmp) {
				foreach($docente->classi as $classe){
					if(strtoupper(str_replace(" ", "", $classe->classe)) == strtoupper(str_replace(" ", "", $classeCmp))){
							return $classe->materia;
					}
				}
			}
		}
	}
	function mostraOrario($orario) {
		$orarioOra = explode(":", $orario)[0];
		$orarioMinuti = explode(":", $orario)[1];

		$timeEvento = mktime($orarioOra, $orarioMinuti)."<br>";
		$timeNow = mktime(date("H"), date("i"))."<br>";
			
		return (($timeEvento > ($timeNow-15*60)) && ($timeEvento < ($timeNow+45*60)));
	}
?>
						<meta charset=utf8>
						<style>
							::-webkit-scrollbar {
								display: none;
							}

							html {
								font-family: arial;
							}

							.table-responsive {
								position: absolute;
								overflow-y: auto;
								top: 190px;
								bottom: 8px;
								left: 8px;
								width: calc(100% - 16px);
							}

							.itp {
								width: calc(100% - 16px);
								position: absolute;
								bottom: 8px;
							}

							.itpCella {
								text-align: center;
								height: 66px;
								color: #505050;
								background-color: whitesmoke;
								font-size: 16px;
							}

							table {
								width: 100%;
								border-collapse: collapse;
							}

							td,th {
								padding: 24px;
								background: #eee;
							}

							.intestazionedata {
								color: #000000;
								background-color: #91bbff;
								font-size: 27px;
								height: 66px;
								text-align: center;
							}

							.intestazione {
								text-align: left;
								width: 20%;
								background-color: #c1d9ff;
								font-size: 20px;
								height: 46px;
								font-weight:bold;
							}
		 
							#noudienze {
								position: absolute;
								top: 50%;
								left: 50%;
								transform: translateX(-50%) translateY(-50%);
								text-align: center;
							}

							.celladocente {
								text-align: left;
								width: 20%;
								background-color:whitesmoke;
								font-size: 22px;
								color: #494c4c;
								height: 46px;
							}

							.cellastudente {
								text-align: left;
								width: 20%;
								background-color: #c0f9f6;
								font-size: 25px;
								font-family:helvetica;
								height: 46px;
								color:dimgray;
							}
						
							.celle{
								background-color:#eeeeee;
							}
        
							.clock {
								text-align: center;
								color: darkslategray;
								font-size: 28px;
								font-family: Arial;
							}
		
							.cosa{
								background-color: #91bbff;
								position: fixed;
								z-index:4;
							}
        
							h3{
								margin-left: 40px;
								margin-top: 10px; 
								font-size: 20px;
							}

							ul {
								margin: 0px;
								padding: 0px;
								list-style: none;
								margin-left: 20px;
							}

							ul li {
								float: left;
								width: 200px;
								height: 40px;
								background-color:whitesmoke;
								opacity: .8;
								line-height: 40px;
								text-align: center;
								font-size: 20px;
							}

							ul li a {
								text-decoration: black;
								color: black;
								display: block;
							}

							ul li a:hover {
								background-color:lightgrey;
								color:grey;
							}

							ul li ul li{
								display: none;
							}

							ul li:hover ul li {
								display: block;
								margin-left:20px;
							}

							.black_bg {
								color: #EB5B2C;
								text-align: left;
								font-size: 50px;
								margin-top: 100px;
								margin-left: 40px;
								-webkit-text-stroke-width: 2px;
								-webkit-text-stroke-color: #EB5B2C;
							}

							.imgtext{
								font-size: 18px;
								font-weight: bolder;
							}

							#paragraph{
								font-size: 24px;
								color: #EB5B2C;
								padding-left: 20px;
								padding-top: 30px;
							}

							.clock{
								color:darkslategray;
								background:lightgrey;
								font-size: 18px;
								font-family: Arial;
							}

							.hamburger{
								background:none;
								position:absolute;
								top:15px;
								left:0px;
								line-height:45px;
								padding:0px 15px 0px 15px;
								color:black;
								border:0;
								font-size:1em;
								font-weight:bold;
								cursor:pointer;
								outline:none;
								z-index:10000000000000;
							}
			
		  
							.cross{
								background:none;
								position:absolute;
								top:15px;
								left:0;
								padding:0px 15px 0px 15px;
								color:black;
								border:0;
								font-size: 3em;
								line-height:65px;
								font-weight:bold;
								cursor:pointer;
								outline:none;
								z-index:10000000000000;
							}
							
							.udienze{
								cursor:pointer;
							}
							
							.menu{
								z-index:1000000;
								font-weight:bold;
								font-size:0.8em;
								width:200px;
								background:none;
								position:absolute;
								text-align:center;
							}
          
							.menu ul {
								margin: 0;
								padding: 0; 
								list-style-type: none;
								list-style-image: none;
							}
      
							.menu li {
								display:block;
								padding:15px 0 15px 0;
								border-bottom:black 1px solid;
							}
      
							.menu li:hover{
								display: block;
								background:whitesmoke; 
								filter: alpha (opacity=50);
								opacity:0.5; 
								padding:15px 0 15px 0;
								border-bottom:black 1px solid;
							}
							
							.menu ul li a {
								text-decoration:black;
								margin: 0px;
								color:black;
							}
							
							.menu ul li a:hover {  
								color: black; 
								text-decoration:black;
							}
							
							.menu a{
								text-decoration:none;
								color:black;
							}
							
							.menu a:hover{
								text-decoration:black;
								color:black;
							}
		  
							.glyphicon-home{
								color:black; 
								font-size:1em; 
								margin-top:5px; 
								margin:0 auto;
							}
       
							.dropbtn {
								background-color: #4CAF50;
								color: white;
								padding: 16px;
								font-size: 16px;
								border: none;
							}			 

							.dropdown {
								position: relative;
								display: inline-block;
							}

							.dropdown-content {
								display: none;
								position: absolute;
								background-color: #f1f1f1;
								min-width: 160px;
								box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
								z-index: 1;
							}

							.dropdown-content a {
								color: black;
								padding: 12px 16px;
								text-decoration: none;
								display: block;
							}

							.dropdown-content a:hover {
								background-color: #ddd;
							}

							.dropdown:hover .dropdown-content {
								display: block;
							}

							.dropdown:hover .dropbtn {
								background-color: #3e8e41;
							}
						</style>
					</head>
					<body onload="getData()">
<?php
	if (file_exists("udienze.json")) {
?>
						<table class=cosa>
							<tr>
								<th class="intestazionedata">
									<button class="hamburger">&#9776;</button>
									<button class="cross">&#735;</button>
									<div class="menu">
										<ul>
											<li><a href="index.php">Home</a></li>
											<li><a class="udienze">Udienze</a>
											<ol>
												<li class="subMenu"><a href="scorrevole.php" target="_blank">Scorrevole</a></li>
												<li class="subMenu"><a href="fermo.php" target="_blank">Fermo</a></li>
											</ol>
											</li>
										</ul>
									</div>
									<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
									<script src="index.js"></script>
								</th>
								<th class="intestazionedata" id="clock" colspan=3></th>
								<th class="intestazionedata">
									<a href="https://www.istitutopilati.it" target="_blank">
										<img href="https://www.istitutopilati.it" target="_blank" src="Immagini/Pilatis.png" alt="logoistituto" height="70" width="70" align="right" >
									</a>
								</th>
							</tr>
							<tr>
								<td class=intestazione>Studente</td>
								<td class=intestazione>Classe</td>
								<td class=intestazione>Orario</td>
								<td class=intestazione>Docente</td>
								<td class=intestazione>Materia</td>
							</tr>
						</table>
						<div class="table-responsive">
							<table>
<?php
	$hasDrawn = false;
	$i = 0;
    $array=array();
	for ($i = 0; $i < count($udienze); $i++) {
		$array[$i] = $udienze[$i];
	}
	for ($i = 0; $i < count($array); $i++) {
		$val = $array[$i];
		$j = $i - 1;
		while ($j >= 0 && $array[$j] > $val) {
			$array[$j + 1] = $array[$j];
			$j--;
		}
		$array[$j + 1] = $val;
	}
	$i_stud = 0;
	foreach ($array as $udienza) {
		$show = false;
		foreach ($udienza->prenotazioni as $prenotazione) {
			if (mostraOrario($prenotazione->orario)) {
				$show = true;
			}
		}
		////////////////////
		
	
/*
DEBUG
foreach ($udienza->prenotazioni as $prenotazione) {
	echo "PRIMA " . $prenotazione->docente . " - " . $prenotazione->orario . "<br/>";
}*/





//foreach ($udienza->prenotazioni as $prenotazione) {
for($i=0;$i<count($udienza->prenotazioni);$i++){

	for($j=0;$j<count($udienza->prenotazioni);$j++){
	
		//foreach ($udienza->prenotazioni as $prenotazione2) {
		


		$str_array = explode(":", $udienza->prenotazioni[$i]->orario);
		$str_array2 = explode(":", $udienza->prenotazioni[$j]->orario);

		$int_ora1=intval($str_array[0]);
		$int_ora2=intval($str_array2[0]);

		$int_min1=intval($str_array[1]);
		$int_min2=intval($str_array2[1]);



		if($int_ora1==$int_ora2){

			
			if($int_min1 < $int_min2){

				$tmp =  $udienza->prenotazioni[$i];
				$udienza->prenotazioni[$i]= $udienza->prenotazioni[$j];
				$udienza->prenotazioni[$j]=$tmp;
			}

		}
		else{

			if($int_ora1 < $int_ora2){
				$tmp =  $udienza->prenotazioni[$i];
				$udienza->prenotazioni[$i]= $udienza->prenotazioni[$j];
				$udienza->prenotazioni[$j]=$tmp;
			}


		}

	}


}

/*
DEBUG
foreach ($udienza->prenotazioni as $prenotazione) {
	echo "DOPO " . $prenotazione->docente . " - " . $prenotazione->orario . "<br/>";
}
*/


/////////////////////



		if (!$show) {
			continue;
		}
?>
								<!-- RIGA STUDENTE -->
								<tr>
									<td class=cellastudente><!-- CELLA STUDENTE -->
<?php
	if (count(explode(" ", $udienza->studente)) > 3) {
		$tmp = array();
		$tmp = explode(" ", $udienza->studente);
		echo $tmp[0], $tmp[1];
?>
									<br>
<?php
	echo $tmp[2], $tmp[3]; 
?>
									&nbsp;&nbsp;
<?php
	} 
	else {
		echo $udienza->studente; ?>&nbsp;&nbsp;
<?php
	}
?>
									</td>
									<td class=cellastudente ><!-- CELLA CLASSE --> 
<?php
	echo $udienza->classe;
?>
									</td>
									<td class=cellastudente></td>
									<td class=cellastudente></td>
									<td class=cellastudente></td>
								</tr>
								
								<!-- RIGA DOCENTE -->
            
<?php
	foreach ($udienza->prenotazioni as $prenotazione) {
		if (!mostraOrario($prenotazione->orario)) {
			continue;
		}
		$hasDrawn = true;
?>
								<tr>
									<td class=celladocente></td>
									<td class=celladocente></td>
									<td class=celladocente>&nbsp;&nbsp;
<?php 
	echo $prenotazione->orario; 
?>
									</td>
									<td class=celladocente>&nbsp;&nbsp;<b>
<?php 
	echo $prenotazione->docente; 
?>
									</b>
									</td>
									<td class=celladocente>
<?php 
	echo materia($prenotazione->docente, $udienza->classe, $docenti);
?>
									</td>
								</tr>
<?php
	}
?>
            
								<tr>
									<td class=celle colspan=5></td>
								</tr>
								<tr>
									<td class=celle colspan=5></td>
								</tr>

<?php
	}
?>
							</table>
						</div>
<?php
	}
	if (!$hasDrawn) {
?>
						<h1 id=noudienze>Nessuna udienza programmata in questo orario</h1>
<?php
	}
?>
						<script src="jquery.min.js"></script>
						<script>
							var $el = $(".table-responsive");
							var flag = 1;
							function anim() {
								var st = $el.scrollTop();
								var sb = $el.prop("scrollHeight")-$el.innerHeight();
								$el.animate({scrollTop: st<(sb/2) ? sb : 0}, 800*document.getElementsByTagName("tr").length, anim);
							}
							
							function check() {
								setInterval(keepchecking, 100);
							}
							
							function keepchecking() {
								if($el.scrollTop() == 0 && flag!=0){
									flag=0;
									location.reload();
								}
							}
							setTimeout(anim, 750);
							setTimeout(check, 5000);
        
							function getData() {
								var data = new Date();
								var year = data.getYear();
								var month = data.getMonth();
								var day = data.getDate();
								var hour = data.getHours();
								var minute = data.getMinutes();
								var second = data.getSeconds();
								var weekDay = data.getDay();
								switch (weekDay) {
									case 0:
										weekDay = "Domenica";
										break;
									case 1:
										weekDay = "Luned&#236;";
										break;
									case 2:
										weekDay = "Marted&#236;";
										break;
									case 3:
										weekDay = "Mercoled&#236;";
										break;
									case 4:
										weekDay = "Gioved&#236;";
										break;
									case 5:
										weekDay = "Venerd&#236;";
										break;
									case 6:
										weekDay = "Sabato";
										break;
								}
								if (day < 10) {
									day = "0" + day;
								}
								if (hour < 10) {
									hour = "0" + hour;
								}
								if (minute < 10) {
									minute = "0" + minute;
								}
								if (second < 10) {
									second = "0" + second;
								}
								var ref = document.getElementById('clock');
								switch (month + 1) {
									case 1:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + " Gennaio" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 2:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Febbraio" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 3:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + " " + day + " " + "Marzo" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;
										break;
									case 4:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Aprile" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 5:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Maggio" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 6:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Giugno" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 7:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Luglio" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 8:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Agosto" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 9:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Settembre" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 10:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Ottobre" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 11:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Novembre" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
									case 12:
										ref.innerHTML = "Udienze di" + " " + weekDay + " " + day + " " + "Dicembre" + " " + (year + 1900) + " " + " " + "Ore:" + " " + hour + ":" + minute + ":" + second;;
										break;
								}
								window.setTimeout("getData()", 1000);
							}
						</script>
					</body>	
				</html>