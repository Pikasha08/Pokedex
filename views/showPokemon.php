<?php

require './views/showMoves.php';

function showPokemon($pokemon)
{
    try
    {
        $id = $pokemon['idPokemon'];
        $movesLearned = findMovesLearnedByPokemon($pokemon['idPokemon']);
        $pokemon = getPokemonByID($pokemon['idPokemon'])[0];
        $pokemon['name'][0] = strtoupper($pokemon['name'][0]);
        $answer = "<h3>" . $pokemon["name"] . "</h3>";

        $answer .= '<table>
        <tr>
            <td>
                <img class="pokemon-sprite" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $id . '.png" alt="pokemon image">
            </td>
            <td>
                <table>
                    <tr>
                        HP : ' . $pokemon['hp'] . '
                    </tr><br>
                    <tr>
                        Attack : ' . $pokemon['attack'] . '
                    </tr><br>
                    <tr>
                        Defense : ' . $pokemon['defense'] . '
                    </tr><br>
                    <tr>
                        Special Attack : ' . $pokemon['spA'] . '
                    </tr><br>
                    <tr>
                        Special Defense : ' . $pokemon['spD'] . '
                    </tr><br>
                    <tr>
                        Speed : ' . $pokemon['speed'] . '
                    </tr>
                </table>
                <td>
                    <form action="" method="POST">
                        <input class="pokeType-button" type="image" name="type" src="./img/types/' . $pokemon["type1"] . '_sprite.png" value="' . $pokemon["type1"] . '">
                        <input type="hidden" name="type" value="' . $pokemon["type1"] . '">
                    </form>
                    ';
                    if ($pokemon["type2"] != "none")
                    {
                        $answer .= '<form action="" method="POST">
                        <input class="pokeType-button" type="image" name="type" src="./img/types/' . $pokemon["type2"] . '_sprite.png" value="' . $pokemon["type2"] . '">
                        <input type="hidden" name="type" value="' . $pokemon["type2"] . '">
                        </form>';
                    }
                    $answer .= '
                </td>
            </td>
        </tr>
        </table>';
        echo $answer;
        echo showMoves($movesLearned);
    }
    catch (Exception $e)
    {

    }
}