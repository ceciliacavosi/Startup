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
	<br>
	<div class="intestazionedata" id="clock" colspan=2>

	</div>
	
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
		function swap($a, $b){
			$tmp=$a;
			$a=$b;
			$b=$tmp;
		}
		?>
		<meta charset=utf8>
		
	</head>
	

	<body background="Immagini/sfondo.jpg" onload="getData()">
		<br>
		<br>
		<br>
		<br>
		<?php
		if(file_exists("udienze.json")){
            ?>
            <?php
					$hasDrawn = false;
					$i = 0;
					
					
					for($i = 0; $i < count($udienze); $i++){
						$array[$i]=$udienze[$i];
					}
					for($i = 0; $i < count($array); $i++){
						$val = $array[$i];
						$j = $i-1;
						 while($j>=0 && $array[$j] > $val){
							 $array[$j+1] = $array[$j];
							 $j--;
						 }
						 $array[$j+1] = $val;
					}

					$i_stud=0;
					foreach($array as $udienza){
						$show = false;
						foreach($udienza->prenotazioni as $prenotazione) {
							if(mostraOrario($prenotazione->orario)) {
								$show = true;
							}
						}

						if(!$show) { continue; }
						?>
<br>
<div class="celle" align="center">
	<div class="studente">
		<p><b><?php 
			
			echo $udienza->studente;
			
			
		?>
		&nbsp;
		<?php  echo $udienza->classe;
		
		?>
		</b></p>
	</div>
	<?php
		
	?>			
		<div class="professore">
			<p>
			
			<?php

			foreach($udienza->prenotazioni as $prenotazione) {
			
			
			?>
				<img class="img2" src="Immagini/freccia.png"><?php 
			
				echo " ".$prenotazione->orario;
				echo " docente " .$prenotazione->docente;?> &nbsp;
				
				<b><?php 
				echo materia($prenotazione->docente, $udienza->classe, $docenti);	
			?></b>
				<br>
				<?php

	}
		?> 
			
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
			background: #769eb8;
			background-repeat:no-repeat;
			
		}

		.img2{
			width:20px;
			align:center;
		}
		.intestazionedata{
			    background-color:#91BBFF;
				height: 66px;
				text-align: center;
			 	width : 100%;
			    font-size:38px;
				height: 50px;
				color : white;
				position: fixed;
				z-index:4;
			}
            .studente{
				position:relative;
				top:1em;
				height: 80px;
                width: 85%;
                border: 1px ridge transparent;
                font-size: 14pt;
				background: gray 20%;
				-webkit-border-radius: 10px;
				color:whitesmoke;
				font-family:verdana;
				z-index:1;
				
				}

            .professore{
				font-family:arial;
				position:relative;	
				top:-0em;
				width: 85%;
                border: 1px ridge transparent;
                font-size: 17pt;
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
				text-align:center;				
			 	font-family:times;
                color: slategrey;	
			}
			.clock{
				text-align: center;
				color:darkslategray;
				font-size: 28px;
				font-family: Arial;
			}


        </style>
	<script language="javascript">

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
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+" Gennaio"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 2:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Febbraio"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 3:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+" "+day+" "+"Marzo"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;
        break;
        case 4:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Aprile"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 5:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Maggio"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 6:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Giugno"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 7:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Luglio"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 8:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Agosto"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 9:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Settembre"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 10:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Ottobre"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 11:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Novembre"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
        case 12:
        ref.innerHTML="Udienze di"+" "+weekDay+" "+day+" "+"Dicembre"+" "+(year+1900)+" "+" "+"Ore:"+" "+hour+":"+minute+":"+second;;
        break;
    }
    window.setTimeout("getData()",1000);
}
</script>

    </body>
 </html>