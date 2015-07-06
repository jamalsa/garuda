<?php

require __DIR__ . '/vendor/autoload.php';

use Goutte\Client;

$client = new Client();

$crawler = $client->request('GET', 'https://www.garuda-indonesia.com/id/id/index.page');

$crawler->filter('#1410947344734 script')->each(function ($node) {
    $script = $node->text();

    $strStart = 'citylist = [';
    $startPos = strpos($script, $strStart);
    $endPos = strpos(substr($script, $startPos + strlen($strStart) - 1), "]");

    $stringData = substr($script, $startPos + strlen($strStart) - 1, $endPos + 1);

    $stringData = str_replace('value', '"value"', $stringData);
    $stringData = str_replace('label', '"label"', $stringData);
    $stringData = str_replace('desc', '"desc"', $stringData);
    $stringData = str_replace('country', '"country"', $stringData);

    $data = json_decode($stringData);
    var_dump($data);
});

