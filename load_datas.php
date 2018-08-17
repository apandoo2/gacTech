<?php
$databasehost = "localhost"; 
$databasename = "gac"; 
$databasetable = "detail_appel"; 
$databaseusername="root"; 
$databasepassword = ""; 
$fieldseparator = ";"; 
$lineseparator = "\n";
$csvfile = "tickets_appels_201202.csv";
$uploadcsvfile = "upload/tickets_appels_201202.csv";

//move csv file to upload directory after database is populated
function rename_win($oldfile,$newfile) {
    if (!rename($oldfile,$newfile)) {
        if (copy ($oldfile,$newfile)) {
            unlink($oldfile);
            return TRUE;
        }
        return FALSE;
    }
    return TRUE;
}
if(!file_exists($csvfile)) 
{
    die("CSV file already uploaded");
}
try 
{

    $pdo = new PDO(
        "mysql:host=$databasehost;dbname=$databasename", 
        $databaseusername, 
        $databasepassword,
        array
        (
        PDO::MYSQL_ATTR_LOCAL_INFILE => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    )
    );
} 
catch (PDOException $e) 
{
    die("error");
}
$affectedRows = $pdo->exec
    (
        "LOAD DATA LOCAL INFILE "
        .$pdo->quote($csvfile)
        ." INTO TABLE `$databasetable` FIELDS TERMINATED BY "
        .$pdo->quote($fieldseparator)
        ." LINES TERMINATED BY "
        .$pdo->quote($lineseparator)
        ." IGNORE 3 LINES"
        . " (Compte_facture, Numero_facture,Numero_abonnee,@Date_facturation,Heure_facturation,Dure_vol_reel,Dure_vol_facturee,
    Type_facturation)set Date_facturation = FormatDate(@Date_facturation)"
  );

if ($affectedRows > 0) {
    echo "ok";
    //move csv file to upload directory /upload
    rename_win($csvfile, $uploadcsvfile);
} else {
  echo "An error has occured please try again.\n";
}
?>
