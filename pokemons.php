<?php

require_once './models/db.php';
require_once './views/showPokemons.php';
require_once './views/showPokemon.php';

$pokemons = array();

if (empty($_POST))
{
    $_POST['pokemons'] = "Pokemons";
}

if (isset($_POST["pokeSearch"]) && !empty($_POST["pokeSearch"]))
{
    $name = filter_input(INPUT_POST, 'pokeSearch', FILTER_SANITIZE_STRING);

    $pokemon = array();
    $name = strtolower($name);
    foreach (searchPokemonStartingWith($name) as $poke)
        array_push($pokemon, $poke);

    foreach (searchPokemonWith($name) as $poke)
        array_push($pokemon, $poke);

    $moves = array();
    foreach (searchMoveStartingWith($name) as $move)
        array_push($moves, $move);

    foreach (searchMoveWith($name) as $move)
        array_push($moves, $move);

    $types = array();
    foreach (searchTypeStartingWith($name) as $type)
        array_push($types, $type);

    foreach (searchTypeWith($name) as $type)
        array_push($types, $type);
    
    $sum = sizeof($pokemon) + sizeof($moves) + sizeof($types);

    var_dump($moves);
    var_dump($types);

    if (sizeof($pokemon) > 1)
    {
        echo "<h3>Recherche pour <b>'" . $_POST['pokeSearch'] . "'</b></h3>";

        $pokemons = array();
        foreach ($pokemon as $poke)
        {
            array_push($pokemons, getPokemonByID($poke['idPokemon'])[0]);
        }

        echo showAllPokemons($pokemons);
    }
    else if ($sum == 1)
    {
        if (sizeof($types) == 1)
        {
            require_once './views/showType.php';
            // GET TYPE CHART
            echo showType($types[0]);
        }
        else if (sizeof($moves) == 1)
        {
            require_once './views/showMove.php';
            echo showMove($moves[0]);
        }
        else if (sizeof($pokemon) == 1)
        {
            echo showPokemon($pokemon[0]);
        }
    }
}
else if (isset($_POST["move"]) && !empty($_POST["move"]))
{
    $name = strtolower(filter_input(INPUT_POST, 'move', FILTER_SANITIZE_STRING));
    
    $moves = array();

    showMove(getMoveIDByName($name)[0]);
}
else if (isset($_POST["pokemons"]) && !empty($_POST["pokemons"]))
{
    $pokemons = getAllPokemon();
    echo showAllPokemons($pokemons);
}
else if (isset($_POST["moves"]) && !empty($_POST["moves"]))
{
    echo showMoves();
}
else if (isset($_POST["type"]) && !empty($_POST["type"]))
{
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

    require_once './views/showType.php';
    echo showType(getTypeIDByName($type)[0]);
}
else
{
    echo "rien";
}
