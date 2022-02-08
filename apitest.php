<?php

$anArray = ["greeting" => "hello",
            "status" => "yo I am working"
];

$anotherArray = ["greeting" => "Yo",
                "status" => "I am not working"
];

$andAnother = ["greeting" => "Bye",
                "status" => "I quit"
];

$whole = [$anArray, $anotherArray, $andAnother];

header('Access-Control-Allow-Origin: *');

$serialisedData = json_encode($whole);

echo $serialisedData;