<?php

function showMoves($moves = null)
{
    if ($moves == null)
    {
        $moves = getAllMoves();
    }

    $answer = '<table>
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Category</th>
        <th>Power</th>
        <th>Accuracy</th>
        <th>PP</th>
    </tr>';

    foreach ($moves as $move) :
        $move["name"][0] = strtoupper($move["name"][0]);
        if ($move['accuracy'] == 0)
        {
            $move['accuracy'] = "-";
        }
        if ($move['base_power'] == 0)
        {
            $move['base_power'] = "-";
        }
        
        $answer .= '<tr>
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
                ' . $move["base_power"] . '
            </td>
            <td>
                ' . $move["accuracy"] . '
            </td>
            <td>
                ' . $move["power_points"] . '
            </td>
        </tr>';

    endforeach;
    $answer .= '</table>';
    return $answer;
}