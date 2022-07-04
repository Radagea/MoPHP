<?php

/**
 * DmTA
 * It takes an array of DatinModels and make an Associative Array from that
 * @param  mixed $arr
 * @return Array its return an Associative Array
 */
function datinmodel_array(Array $array) : Array {
    $newArr = [];
    try {
        foreach ($array as $element) {
            if (!(is_a($element,'App\\App\\Packages\\Datin\\DatinModel'))) {
                throw new Throwable();
            }
            array_push($newArr,$element->getArray());
        }
    } catch (\Throwable $th) {
        echo 'One of the element is not DatinModel!';
    }
    return $newArr;
}

