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
	<div class="intestazionedata" style="float: left; width: calc(100%/3);"><?php echo date("H:i"); ?></div>
	
		<?php
		$udienze;
		$docenti;
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
		
	</head>
	
	<body background="Immagini/sfondo.jpg">
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
<div class="celle" align="center">
	<div class="studente">
		<p><b><?php echo $udienza->studente; echo "\t"; ?>
		<br>
		<?php  echo $udienza->classe;?>
		</b></p>
	</div>
				
		<div class="professore">
			<p><img class="img2" src="Immagini/freccia.png"><?php echo "".$prenotazione->orario; ?>
			
			<?php 
			
			echo "prof. ".$prenotazione->docente;	
			
			?> &nbsp;&nbsp;&nbsp;
			
			<b><?php echo materia($prenotazione->docente, $udienza->classe, $docenti); ?></b></p>
			<br>
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


        </style>
    </body>
 </html>