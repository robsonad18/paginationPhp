<?php

require __DIR__ . '/vendor/autoload.php';

ini_set("display_errors", true);
error_reporting(E_ALL);

use App\Database;
use App\Front;
use App\Pagination;


$source = "http://localhost/projects/pagination-php";

$queryCount = Database::get()->prepare("SELECT COUNT(*) as 'qtd' FROM consultation");
$queryCount->execute();
$count = $queryCount->fetchAll(\PDO::FETCH_OBJ);

$Pagination = new Pagination($count[0]->qtd, $_GET['page'] ?? 0, 10);


$query = Database::get()->prepare("SELECT * FROM consultation ORDER BY id DESC LIMIT ".$Pagination->getLimit());
$query->execute();
$results = $query->fetchAll(\PDO::FETCH_ASSOC);

$listTr = [];
foreach($results ?? [] as $key => $value)
{
    $listTr[] = Front::render("tr-list", [
        "id" => $value['id'],
        "name" => $value['text_full_name']
    ]);
}

$layoutTable = Front::render("listing", [
    "trList" => implode('', $listTr),
    "count" => $count[0]->qtd
]);

$listButtons = [];
foreach($Pagination->getPages() as $key => $value)
{
    $listButtons[] = Front::render("button", [
        "number" => $value['page'],
        "SOURCE" => $source."?page=".$value['page']
    ]);
}

echo Front::render("home", [
    "table"     => $layoutTable,
    "buttons"   => implode("", $listButtons)
]);
