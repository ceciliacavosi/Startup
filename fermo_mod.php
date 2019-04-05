<html>
	<head>
	<?php require("css.php");?>
	<button class="hamburger">&#9776;</button>
	<button class="cross">&#735;</button>
	<button class="hamburger">&#9776;</button>
	<button class="cross">&#735;</button>
	<div class="menu">
		<ul>
				<li><a href="index.html">Home</a></li>
				<li><a class="udienze">Udienze</a>
					
					<ol>
						<li class="subMenu"><a href="sceglifile.php" target="_blank">Carica File</a></li>
					
					
						<li class="subMenu"><a href="scorrevole.php" target="_blank">Scorrevole</a></li>
				
					</ol>
					</li>
		</ul>
	</div>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="index.js"></script>
	
	<title>Udienze attuali</title>
	<div class="intestazionedata" style="float: left; width: calc(100%/3);" id="clock" class="clock"></div>
	
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

		function insertionSort($my_array)
	{
		for($i=0;$i<count($my_array);$i++){
			$val = $my_array[$i];
			$j = $i-1;
			while($j>=0 && $my_array[$j] > $val){
				$my_array[$j+1] = $my_array[$j];
				$j--;
			}
			$my_array[$j+1] = $val;
		}
		return $my_array;
	}
		
		?>
		<meta charset=utf8>
		
	</head>
	
	<body background="Immagini/sfondo.jpg" onload="getData()" >
		<br>
		<br>
		<br>
		<br>
		<?php
		if(file_exists("udienze.json")){
            ?>
            <?php
					$hasDrawn = false;

					foreach($udienze as $udienza){
						
						$show = false;
						foreach($udienza->prenotazioni as $prenotazione) {
							if(mostraOrario($prenotazione->orario)) {
								$show = true;
							}
						}

						if(!$show) { continue; }
						?>
		<br>
		<div class="celle">
			<div class="studente">
				<p><b><?php 
				$array = array($udienza->studente); //parametro da passare non corretto
				print_r(insertionSort($array));
				?>
				<br>
				<?php  echo $udienza->classe;?>
				</b></p>
			</div>
						
				<div class="professore">
					<p>
					
					<?php
					$a;
					$b; 
					foreach($udienza->prenotazioni as $prenotazione) {
					?>
						<img class="img2" src="Immagini/freccia.png"><?php echo " ".$prenotazione->orario;
						echo " prof. " .$prenotazione->docente;?> &nbsp;
						<b><?php echo materia($prenotazione->docente, $udienza->classe, $docenti);	
						?></b>
						<br>
						<?php
					}
				?> &nbsp;&nbsp;&nbsp;
					
					</p>
				</div>
							
					<?php
						}
					?>
			</div>
		</div>
            <?php 
        }
		?>

        <style>
		body{
			background:"sfondo.jpg";
			background-repeat:no-repeat;
			background-attachment:fixed;
		}

		.img2{
			
			width:20px;
			
		}
		.intestazionedata{
				text-align: center;
			    font-size:20px;
				height: 50px;
			}
            .studente{
				position:relative;
				top:1em;
				height: 60px;
                width: 350px;
                border: 1px ridge transparent;
                font-size: 11pt;
				background: gray;
				-webkit-border-radius: 10px;
				color:whitesmoke;
				font-family:verdana;
				z-index:1;
				
				}

            .professore{
				position:relative;	
				top:-0em;
				font-family:times;
                color: slategrey;			
                width: 600px;
                border: 1px ridge transparent;
                font-size: 15pt;
                background: lightblue;
				-webkit-border-radius: 10px;			
			    z-index:0;
			}

		#img2{
    		margin-bottom: 30px;
    		margin-left: 20px;
				}
			}
			.celle{
		   

				
			}
			.clock{
				color:darkslategray;
				font-size: 18px;
				font-family: Arial;
			}


        </style>
		<script language="javascript">
		function confronto($stringa1, $stringa2){
			
		}
		function getData(){
			var data=new Date();
			var year=data.getYear();
			var month=data.getMonth();
			var day=data.getDate();
			var hour=data.getHours();
			var minute=data.getMinutes();
			var second=data.getSeconds();
			var weekDay=data.getDay();
			switch(weekDay){
				case 0:
				weekDay="Domenica";
				break;
				case 1:
				weekDay="Luned&#236;";
				break;
				case 2:
				weekDay="Marted&#236;";
				break;
				case 3:
				weekDay="Mercoled&#236;";
				break;
				case 4:
				weekDay="Gioved&#236;";
				break;
				case 5:
				weekDay="Venerd&#236;";
				break;
				case 6:
				weekDay="Sabato";
				break;
			}
			if(day<10){
				day="0"+day;
			}
			if(hour<10){
				hour="0"+hour;
			}
			if(minute<10){
				minute="0"+minute;
			}
			if(second<10){
				second="0"+second;
			}
			var ref=document.getElementById('clock');
			switch(month+1){
				case 1:
				ref.innerHTML=weekDay+" "+day+" "+"Gennaio"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 2:
				ref.innerHTML=weekDay+" "+day+" "+"Febbraio"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 3:
				ref.innerHTML=weekDay+" "+" "+day+" "+"Marzo"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;
				break;
				case 4:
				ref.innerHTML=weekDay+" "+day+" "+"Aprile"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 5:
				ref.innerHTML=weekDay+" "+day+" "+"Maggio"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 6:
				ref.innerHTML=weekDay+" "+day+" "+"Giugno"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 7:
				ref.innerHTML=weekDay+" "+day+" "+"Luglio"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 8:
				ref.innerHTML=weekDay+" "+day+" "+"Agosto"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 9:
				ref.innerHTML=weekDay+" "+day+" "+"Settembre"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 10:
				ref.innerHTML=weekDay+" "+day+" "+"Ottobre"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 11:
				ref.innerHTML=weekDay+" "+day+" "+"Novembre"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
				case 12:
				ref.innerHTML=weekDay+" "+day+" "+"Dicembre"+" "+(year+1900)+" "+" "+hour+":"+minute+":"+second;;
				break;
			}
			window.setTimeout("getData()",1000);
		}
		</script>
	</body>

	<?php 
	$today = date("G-i");
	$data = $prenotazione->orario;
	
	$today_t = strtotime($today);
	$data_t = strtotime($data);
	
	if($today_t < $data_t){
		//stampa tutto
	}
	else{
		echo "Nessuna sostituzione disponibile";
	}
	?>
</html>