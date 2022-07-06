<?php

use App\App\Errors\MoError;

/**
 * DmTA
 * It takes an array of DatinModels and make an Associative Array from that
 * @param  mixed $arr
 * @return Array its return an Associative Array
 */
function datinmodel_array(Array $array) : Array {
    $newArr = [];
    foreach ($array as $element) {
        if (!(is_a($element,'App\\App\\Packages\\Datin\\DatinModel'))) {
            throw new MoError('Not only DatinModel on the array please check it!');
        }
        array_push($newArr,$element->getArray());
    }
    return $newArr;
}

