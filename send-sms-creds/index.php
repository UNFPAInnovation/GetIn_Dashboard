<?php
require_once "vendor/autoload.php";
use League\Csv\Reader;
use League\Csv\Statement;

$dotenv = new Dotenv\Dotenv(__DIR__, 'example.env');
$dotenv->load();
$csv = Reader::createFromPath('/path/to/your/csv/file.csv', 'r');
$csv->setHeaderOffset(0); //set the CSV header offset
$stmt = (new Statement())->offset(10)->limit(25);

$records = $stmt->process($csv);
foreach ($records as $record) {
    //do something here
}

?>