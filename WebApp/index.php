<html>
    <style>
        *{
			font-family: "Open Sans", sans-serif;
		}

		body{
			background: linear-gradient(to bottom,white, grey);
		}

		img{
			margin-right: 30px;
			margin-top: 10px; 
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
			opacity:0.5;; 
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
		<title>Istituto Pilati</title>
		<span class="black_bg">Istituto Pilati</span>
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
	</head>
	<body onload="getData()" >
		<div id="clock" class="clock" align="right"></div>
		<hr> 
		<a href="https://www.istitutopilati.it" target="_blank">
			<img src="Immagini/Pilatis.png" alt="logoistituto" height="150" width="150" align="right" >
		</a>
		<br>
		<br>
		<br>
		<br>			
		<br>
		<br>
		<img class="img2" src="Immagini/Work.jpg" alt="lambdaImage" height="417" width="893">
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
						ref.innerHTML=day+" "+"Gennaio"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 2:
						ref.innerHTML=day+" "+"Febbraio"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 3:
						ref.innerHTML=weekDay+" "+day+" "+"Marzo"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;
						break;
					case 4:
						ref.innerHTML=day+" "+"Aprile"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 5:
						ref.innerHTML=day+" "+"Maggio"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 6:
						ref.innerHTML=day+" "+"Giugno"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 7:
						ref.innerHTML=day+" "+"Luglio"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 8:
						ref.innerHTML=day+" "+"Agosto"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 9:
						ref.innerHTML=day+" "+"Settembre"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 10:
						ref.innerHTML=day+" "+"Ottobre"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 11:
						ref.innerHTML=day+" "+"Novembre"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
					case 12:
						ref.innerHTML=day+" "+"Dicembre"+" "+(year+1900)+"<br>"+"<br>"+hour+":"+minute+":"+second;;
						break;
				}
				window.setTimeout("getData()",1000);
			}
		</script>
	</body>
</html>