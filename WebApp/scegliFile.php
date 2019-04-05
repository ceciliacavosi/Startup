				<html>
					<style>
						#div {
							height: 20%;
							width: 30%;
							margin-top: 4%;
							margin-left: 33%;
							border: 5px ridge grey;
							background: dimgrey;
						}

						#div2 {
							text-align: center;
							margin-top: 15%;
							font-size: 15pt;
							color:white;
						}

						#img {
							margin-left: 41.8%;
							margin-top: 10%; 
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
					<head>
						<title>Carica il file</title>
						<button class="hamburger">&#9776;</button>
						<button class="cross">&#735;</button>
						<div class="menu">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a class="udienze">Udienze</a>
								<ol>
									<li class="subMenu"><a href="sceglifile.php" target="_blank">Carica File</a></li>
									<li class="subMenu"><a href="scorrevole.php" target="_blank">Scorrevole</a></li>
									<li class="subMenu"><a href="fermo.php" target="_blank">Fermo</a></li>
								</ol>
								</li>
							</ul>
						</div>
						<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
						<script src="index.js"></script>
						<th class="intestazionedata" id="clock" colspan=3></th>
					</head>
					<body  background="Immagini/sfondo.jpg";>
						<a href="https://www.istitutopilati.it" target="_blank">
							<img src="Immagini\Pilati.jpg" id="img">
						</a>
						<div id="div">
						<div id="div2">
<?php
	if(!isset($_POST["Invia"])){
        //viene mostrato il form
        echo "<form action='".$_SERVER["PHP_SELF"]."' ENCTYPE='multipart/form-data' method='POST'>";
        echo "<INPUT TYPE='file' NAME='file_caricato'>";
        echo "<INPUT TYPE='submit' value='Upload file' NAME='Invia'>";
        echo "</form>";
        }
		else{
            //trasferisco il tipo, il percorso completo (nome_tmp) e il nome del file in 3 variabili di comodo
            $tipo=explode(".", $_FILES["file_caricato"]["name"])[count(explode(".", $_FILES["file_caricato"]["name"]))-1];
            $nome=$_FILES["file_caricato"]["name"];
			$nome_tmp=$_FILES["file_caricato"]["tmp_name"];
            //verifico il tipo di file, se si tratta di un immagine (jpg, gif o png)
            if(($tipo=="pdf")){
                 //Con move_uploaded_file il file verrà caricato dal client al server
                //nel percorso specificato come secondo parametro
                move_uploaded_file($nome_tmp,"./".$nome);
                echo "Il file è stato caricato correttamente";
                header("webapp/generatoreJSON.php");
            }
			else{
                //se tipo di file non consentito
                echo "Estensione non consentita";
            }
        }
?>
					</body>
				</html>