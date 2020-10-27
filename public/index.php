<?php
require '../vendor/autoload.php';

$app = new \Slim\App();

$countries = array(
    array('name'=>'USA'),
    array('name'=>'india'),
    array('name'=>'argentina'),
    array('name'=>'Australi'),
);

$app->get('/countries', function($request, $response, $args) use ($countries){   // get the array data
return $response->withjson($countries);
});

function startsWith($string,$substring){
    $len = strlen($substring);
return (substr($string, 0, $len)==$substring);
}

$app->get('/countries/search', function($request, $response, $args) use ($countries){   // countries/search?term=a (search bu usin term 'a')
    $term = $request->getQueryParams()['term'];
    $filteredCountries = array();                                                       //countries/search?term=a         (search countries by using 'a')
    foreach($countries as $key => $value){
        if (startsWith(strtolower($value['name']), strtolower($term))){
            array_push($filteredCountries, $value);
        }
        
    };
    return $response->withjson($filteredCountries);
    });
   
$app->run();


?>