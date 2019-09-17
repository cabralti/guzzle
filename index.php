<?php

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Source\Support\Convert;

require_once __DIR__ . '/vendor/autoload.php';

$goutteClient = new Client();
$guzzleClient = new GuzzleClient();
$convert = new Convert();

$goutteClient->setClient($guzzleClient);
$response = $goutteClient->request('GET', 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm');

$rows = $response->filterXPath('//div[@id="content"]')->filter('table tr')->each(function ($tr, $i) {
    return $tr->filter('td')->each(function ($td, $i) {
        return trim($td->text());
    });
});

$convert->setColumns(array_shift($rows));
$convert->setRows($rows);

echo "<pre>";
print_r($convert->render());
echo "</pre>";