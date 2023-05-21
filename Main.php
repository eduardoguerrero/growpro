<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use Growpro\Task;

require_once 'vendor/autoload.php';

$regex = new Task();

$text = "Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)\n";

print_r($regex->getIdentifierNumeric($text));

print_r($regex->replacePattern($text));

$datasetList = [
    [
        'data' => [
            ['user' => 'Oscar', 'age' => 18, 'scoring' => 40],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ],
        'sortBy' => ['age' => 'DESC', 'scoring' => 'DESC']
    ],
    [
        'data' => [
            ['name' => 'cat', 'age' => 5, 'weight' => 3, 'height' => 24],
            ['name' => 'elephant', 'age' => 10, 'weight' => 10, 'height' => 3100],
        ],
        'sortBy' => ['age' => 'DESC', 'height' => 'DESC']
    ]
];

foreach ($datasetList as $data) {
    print_r($regex->sortByCriterion($data['data'], $data['sortBy']));
}
