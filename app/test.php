<?php 


$estates = array(" jhjh ", " jjjjj");

$filteredEstates = array_map(function($estate) {
    return trim($estate);
}, $estates);

var_dump($filteredEstates);
