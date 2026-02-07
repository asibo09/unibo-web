<?php
/*Scrivere il codice PHP valido (ovvero che esegua correttamente su server web Apache) che legga i dati che gli sono stati inviati tramite GET nelle variabili "A", "B" e "O".

In questa pagina, occorrerà:

Controllare che le variabili "A" e "B" non siano nulle e che siano valide, ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.
Controllare che la variabile "O" non sia nulla e che sia uguale a "i" o "u".
Leggere tutti i numeri appartenenti a ciascun insieme (A e B) su database e inserirli in due vettori distinti.
Creare un nuovo vettore contenente l'unione dei due insiemi se O vale u, altrimenti dovrà contenere l'intersezione dei due insiemi.
Inserire sul db il nuovo insieme, usando come id dell'insieme il successivo all'id massimo.
Dovete supporre che il db esista (nome database: giugno; nome tabella: insiemi; username: root, pw: ''), che il demone mysql sia in ascolto sulla porta 3306 e che la tabella "insiemi" sia strutturata e riempita secondo le istruzioni che trovate nel file "README_DB.txt".
Consegnato solamente il file vostraemailunibo.php
Esempi con i dati di esempio presenti nel file README_DB.txt:
Se A=1, B=2 e O=u i seguenti numeri dovranno essere inseriti all'interno del db (colonna valore): 19, 2, 14, 98, 1. Tutte queste righe avranno il valore 3 nella colonna insieme.
Se A=1, B=2 e O=i i seguenti numeri dovranno essere inseriti all'interno del db (colonna valore): 19. Questa riga avrà il valore 3 nella colonna insieme. */



//ricezione get dei 3 valori
$a_id = isset($_GET['A']) ? $_GET['A'] : null;
$b_id = isset($_GET['B']) ? $_GET['B'] : null;
$o_id = isset($_GET['O']) ? $_GET['O'] : null;

//verificare valori A e B che siano positivi e non nulli
if ($a_id == null || $b_id == null || !is_numeric($a_id) || !is_numeric($b_id) ) {
    die("Errore: paramentri A o B mancanti o non validi");
}

//verifica valore o che sia non nullo e uguale ad i o u
if ($o_id != "i" && $o_id != "u") {
    die("Errore: paramentro O mancante o non valido");
}

//connesione db
$host = "localhost";
$user = "root";
$pass = "";
$database ="giugno"
$port = 3306;

$conn = new mysqli($host, $user, $pass, $database, $port);
if ($conn->connect_error) {
    die("Connessione fallita al db");
}

//restituisce un array per leggere i valori di un insieme
function getInsieme($conn, $id) {
    $stmt = $conn->prepare( "SELECT valore FROM insiemi WHERE insieme = ?" );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $vettore = [];
    while ($row = $res->fetch_assoc()) {
        $vettore[] = $row['valore'];
    }
    $stmt->close();
}

$valori_A = getInsieme($conn, $a_id);
$valori_B = getInsieme($conn, $b_id);

if (empty($valori_A) || empty($valori_B)) {
    die("Errore: uno o entrambi gli insiemi non esistono");
}

//unione insiemi se o = u ; intersezione insiemi altrimenti
$risultato = [];
if ($o_id == "u") {
    $risultato = array_merge($valori_A, $valori_B);
} else {
    $risultato = array_intersect($valori_A, $valori_B);
}

//Inserire sul db il nuovo insieme, usando come id dell'insieme il successivo all'id massimo.
$res_max = $conn->query("SELECT MAX(insieme) as max_id FROM insieme");
$row_max = $res_max->fetch_assoc();
$nuovo_id = $row_max['max_id'] + 1;

$stmt_ins = $conn->prepare("INSERT INTO insiemi (insieme, valore) VALUES (?, ?)");
foreach ($risultato as $valore) {
    $stmt_ins->bind_param("ii", $nuovo_id, $valore);
    $stmt_ins->execute();
}

$stmt_ins->close();
$conn->close();
?>