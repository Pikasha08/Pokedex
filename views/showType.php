<?php

function showType($type)
{
    $answer = "";

    try
    {
        $answer = showAllPokemons(getPokemonByType($type['idType']));
    }
    catch (Exception $e)
    {

    }

    return $answer;
}