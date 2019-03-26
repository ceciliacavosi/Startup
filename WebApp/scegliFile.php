<html>

<head>
    <title>Carica il file</title>
</head>

    <body>
        <img src="\Immagini\Pilati.jpg" id="img">
        <div id="div">
            <div id="div2">
            <?php

                if(!isset($_POST["Invia"])){
                    //viene mostrato il form
                    echo "<form action='".$_SERVER["PHP_SELF"]."' ENCTYPE='multipart/form-data' method='POST'>";
                    echo "<INPUT TYPE='file' NAME='file_caricato'>";
                    echo "<INPUT TYPE='submit' value='Upload file' NAME='Invia'>";
                    echo "</form>";
                }else{
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
                    }else{
                        //se tipo di file non consentito
                        echo "Estensione non consentita";
                    }
                }
                ?>
    </body>
    <style>
       #div {
           height: 20%;
           width: 30%;
           margin-top: 4%;
           margin-left: 33%;
           border: 5px ridge gray;
           background: #d5d5d5;
       }

       #div2 {
           text-align: center;
           margin-top: 15%;
           font-size: 15pt;
       }

       #img {
           margin-left: 43%;
           margin-top: 10%;
       }
    </style>
</html>