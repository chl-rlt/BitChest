<?php

if( ! function_exists('getFirstCotation')) {

    /**
    * Renvoie la valeur de mise sur le marché de la crypto monnaie
    * @param $cryptoname {string} Le nom de la crypto monnaie
    */
    function getFirstCotation($crypto_name) {
        return ord(substr($crypto_name,0,1)) + rand(0, 10);
    }

}

if( ! function_exists('getCotationFor')) {

    /**
    * Renvoie la variation de cotation de la crypto monnaie sur un jour
    * @param $cryptoname {string} Le nom de la crypto monnaie
    */
    function getCotationFor($crypto_name) {
        return ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($crypto_name,0,1)) : ord(substr($crypto_name,-1))) * (rand(1,10) * .01);
    }

}
