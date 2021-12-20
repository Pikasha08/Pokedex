<?php

function showMove($move)
{
    if ($move['accuracy'] == 0)
    {
        $move['accuracy'] = "-";
    }
    if ($move['base_power'] == 0)
    {
        $move['base_power'] = "-";
    }

    $answer = '<tr>
            <td>
                <form action="" method="POST">
                    <input class="pokemon-button" type="submit" name="move" value="' . $move["name"] . '">
                </form>
            </td>
            <td>
                <form action="" method="POST">
                    <input class="pokeType-button" type="image" name="type" src="./img/types/' . $move["type"] . '_sprite.png" value="' . $move["type"] . '">
                    <input type="hidden" name="type" value="' . $move["type"] . '">
                </form>
            </td>
            <td>
                ' . $move["category"] . '
            </td>
            <td>
                ' . $move["power"] . '
            </td>
            <td>
                ' . $move["accuracy"] . '
            </td>
            <td>
                ' . $move["power_points"] . '
            </td>
        </tr>';

    // LIST OF POKEMON THAT POSSESSES THIS MOVE

    return $answer;
}