<?php

include 'vendor/autoload.php';

function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}

function searchStudente($udienze, $studente) {
    foreach($udienze as $key=>$udienza) {
        if($udienza["studente"] == $studente) {
            return $key;
        }
    }
    return -1;
}

$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('udienze.pdf');
$pdfText = explode("\n", $pdf->getText());

foreach($pdfText as $key=>$text) {
    if(
        $text == "--  -- " ||
        $text == "" ||
        $text == "Orario colloqui:" ||
        $text == "Posto Ora Studente" ||
        startsWith($text, "Stampato")
    )
    {
        unset($pdfText[$key]);
    }

}
unset($pdfText[$key]);
$pdfText = array_values($pdfText);

$udienze = [];
$i = 0;
$pdfText_2 = $pdfText;
while($i < count($pdfText_2)) {
    $docente = substr($pdfText_2[$i], 0, strpos($pdfText_2[$i++], "-")-1);
    $docente = ucwords(strtolower(substr($docente, strpos($docente, " ")+1)));
    $i++;
    
    do {
        if(!endsWith($pdfText_2[$i++], "posto")) {
            $pdfText_2[$i-1] = substr($pdfText_2[$i-1], 2);
            $orario = substr($pdfText_2[$i-1], 0, strpos($pdfText_2[$i-1], " "));
            $pdfText_2[$i-1] = substr($pdfText_2[$i-1], strpos($pdfText_2[$i-1], " ")+1);
            $studente = ucwords(strtolower(substr($pdfText_2[$i-1], 0, strpos($pdfText_2[$i-1], "-")-1)));
            $pdfText_2[$i-1] = substr($pdfText_2[$i-1], strpos($pdfText_2[$i-1], "-")+2);
            $classe=$pdfText_2[$i-1];

            $prenotazione = array(
                "docente"=>$docente,
                "orario"=>$orario,
            );
            echo $docente."<br>";

            if(searchStudente($udienze, $studente) == -1) {
                $udienza = array(
                    "studente"=>$studente,
                    "classe"=>$classe,
                    "prenotazioni"=>array(),
                );
                $udienze[] = $udienza;
            }

            $udienze[searchStudente($udienze, $studente)]["prenotazioni"][] = $prenotazione;
        }
        
    } while($i<count($pdfText_2) && !startsWith($pdfText_2[$i], "Prof"));
}

if(file_exists("udienze.json")) {
    unlink("udienze.json");
}
file_put_contents("udienze.json", json_encode(array("udienze"=>$udienze)));

    

//   |-----------------------------------------------------------------------------------------------------|
//   |echo "Hello World"; <-- Esempio di stampa                                                            |
//   |$Udienza->prof = 2; <--- modifica del valore contenuto in una classe                                 |
//   |$Udienza->function(); <-- richiamare la funzione functione presente nella classe Udienza             |
//   |-----------------------------------------------------------------------------------------------------|
//   |foreach (array_expression as $value)  <-- mette in value l'elemento corrente                         |
//   |   //statement                                                                                       |
//   |                                                                                                     |
//   |foreach (array_expression as $key => $value) <-- mette in value l'attuale indice                     |
//   |    //statement                                                                                      |
//   |                                                                                                     |
//   |   unset($value); <-- break the reference with the last element, va sempre fatto dopo un foreach     |
//   |                                                                                                     |
//   |-----------------------------------------------------------------------------------------------------|
//   |                                                                                                     |
//   |    explode() <-- trasforma una stringa in un array                                                  |
//   |    inplode() <-- contrario di explode()                                                             |
//   |                                                                                                     |
//   |    $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";  |                                        |
//   |    $pieces = explode(" ", $pizza);                         |-----> esempio explode()                |
//   |    echo $pieces[0]; // piece1                              |                                        |
//   |    echo $pieces[1]; // piece2                              |                                        |
//   |                                                                                                     |
//   |-----------------------------------------------------------------------------------------------------|
?>