<?php

function showAllPokemons($pokemons)
{
    $answer = '<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Primary type</th>
        <th>Secondary type</th>
    </tr>';

    foreach ($pokemons as $pok) :
        $pok["name"][0] = strtoupper($pok["name"][0]);
        $spritePath = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $pok['idPokemon'] . '.png';

        $answer .= '<tr>
                <td>
                    <img class="pokemon-sprite" src="' . $spritePath . '" alt="pokemon image">
                </td>
                <td>
                    <form action="" method="POST">
                        <input class="pokemon-button" type="submit" name="pokeSearch" value="' . $pok["name"] . '">
                    </form>
                </td>
                <td>
                    <form action="" method="POST">
                        <input class="pokeType-button" type="image" name="type" src="./img/types/' . $pok["type1"] . '_sprite.png" value="' . $pok["type1"] . '">
                        <input type="hidden" name="type" value="' . $pok["type1"] . '">
                    </form>
                </td>
                <td>';
                    if ($pok["type2"] != "none")
                    {
                        $answer .= '<form action="" method="POST">
                        <input class="pokeType-button" type="image" name="type" src="./img/types/' . $pok["type2"] . '_sprite.png" value="' . $pok["type2"] . '">
                        <input type="hidden" name="type" value="' . $pok["type2"] . '">
                        </form>';
                    }
                $answer .= '</td>
        </tr>';
    endforeach;
    $answer .= '</table>';
    return $answer;
}


?>