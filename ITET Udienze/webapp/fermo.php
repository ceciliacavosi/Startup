<html>
	<head>
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
		<style>
			::-webkit-scrollbar {
				display: none;
			}
			html{
				font-family:arial;
			}
			.table-responsive{
				position: absolute;
				overflow-y: auto;
				top: 142px;
				bottom: 8px;
				left: 8px;
				width: calc(100% - 16px);
			}
			.itp{
				width: calc(100% - 16px);
				position: absolute;
				bottom: 8px;
			}
			.itpCella{
				text-align:center;
				height: 66px;
				color:#505050;
				background-color:whitesmoke;
				font-size:16px;
			}
			table{
				width:100%;
                border-collapse: collapse;
			}
			td,th{
				padding:24px;
				background:#eee;
			}

			.intestazionedata{
				background-color:#91BBFF;
				font-size:20px;
				height: 66px;
			}
			.intestazione{
				width:50%;
				background-color:#C1D9FF;
				font-size:16px;
				height: 66px;
				font-weight:bold; 
			}
			.cellaStudente{
				text-align:center;
				width:20%;
				color:#505050;
				background-color:gainsboro;
				font-size:20pt; 
			}
			.cellaPrenotazione{
				text-align:center;
				width:20%;
				color:#505050;
				background-color:whitesmoke;
				font-size:16pt;
			}
			#noudienze {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translateX(-50%) translateY(-50%);
				text-align: center;
			}
			
		</style>
	</head>
	
	<body>
		<?php
		if(file_exists("udienze.json")){
			?>
			<table>
				<tr>
				<th class=intestazionedata colspan=2><div style="float: left; width: calc(100%/3);"><?php echo date("d/m/Y"); ?></div>ITET Udienze<div style="float: right; width: calc(100%/3);"><?php echo date("H:i"); ?></div></th>
				</tr>
				<tr>
					<th class=intestazione>Studente</th>
					<th class=intestazione>Classe</th>
				</tr>
			</table>
			<div class="table-responsive">
				<table>
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
						<tr>
							<td class=cellaStudente><?php echo $udienza->studente; ?></td>
							<td class=cellaStudente><?php echo $udienza->classe; ?></td>
						</tr>
						<tr>
							<tr>
								<td colspan=2>
									<table class=secondaryTable>
										<?php
										foreach($udienza->prenotazioni as $prenotazione) {
											if(!mostraOrario($prenotazione->orario)) { continue; }
											$hasDrawn = true;
											?>
											<tr class="prenotazione">
												<td class=cellaPrenotazione><?php echo $prenotazione->orario; ?></td>
												<td class=cellaPrenotazione><?php echo "Prof. ".$prenotazione->docente; ?></td>
												<td class=cellaPrenotazione><?php echo materia($prenotazione->docente, $udienza->classe, $docenti); ?></td>
											</tr>
											<?php
										}
										?>
									</table>
								</td>
							</tr>
						</tr>
						<tr>
							<td colspan=2></td>
						</tr>
						<tr>
							<td colspan=2></td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
			<?php
		}

		if(!$hasDrawn) {
			?>
			<h1 id=noudienze>Nessuna udienza prorammata per questa giornata.</h1>
			<?php
		}
		?>
		<script>
			var flag=1;	
			setTimeout(check, 20000);
			
			function check() {
				if(flag!=0){
					flag=0;
					location.reload();
				}
			}
		</script>
	</body>
</html>
