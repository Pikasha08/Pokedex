<?php
require_once "connexionDB.php";

function addPokemon($idMov, $idPok)
{
    static $ps = null;
    $sql = 'INSERT INTO `pokemons_db`.`pokemonMoves` (`idMove`, `idPokemon`)';
    $sql .= ' VALUES (:IDMOVE, :IDPOKEMON)';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':IDMOVE', $idMov, PDO::PARAM_INT);
        $ps->bindParam(':IDPOKEMON', $idPok, PDO::PARAM_INT);

        $answer = $ps->execute();
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

function getAbilityIDByName($name)
{
    static $ps = null;
    $sql = 'SELECT * FROM `pokemons_db`.`abilities`';
    $sql .= ' WHERE name = :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        {
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

function getTypeIDByName($name)
{
    static $ps = null;
    $sql = 'SELECT * FROM `pokemons_db`.`types`';
    $sql .= ' WHERE name = :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        {
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

function getPokemonIDByName($name)
{
    static $ps = null;
    $sql = 'SELECT * FROM `pokemons_db`.`pokemon`';
    $sql .= ' WHERE name = :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        {
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

function getMoveIDByName($name)
{
    static $ps = null;
    $sql = 'SELECT * FROM `pokemons_db`.`moves`';
    $sql .= ' WHERE name = :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        {
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Updates the moves' descriptions
 * @param mixed $id Id of the move
 * @param mixed $desc Move's description
 */
function updateMove($id, $desc)
{
    static $ps = null;
    $sql = 'UPDATE `pokemons_db`.`moves` SET `description` = :DESCR';
    $sql .= ' WHERE idMove = :ID';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $id, PDO::PARAM_INT);
        $ps->bindParam(':DESCR', $desc, PDO::PARAM_STR);

        $answer = $ps->execute();
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the Pokemons in the database
 * @return false|array
 */
function getAllPokemon()
{
    static $ps = null;
    $sql = 'SELECT p.name, t1.name AS type1, t2.name AS type2, p.idPokemon';
    $sql .= ' FROM pokemons p';
    $sql .= ' JOIN types t1 ON p.primaryType = t1.idType';
    $sql .= ' JOIN types t2 ON p.secondaryType = t2.idType';
    $sql .= ' ORDER BY idPokemon LIMIT 151';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the moves in the database
 * @return false|array
 */
function getAllMoves()
{
    static $ps = null;
    $sql = 'SELECT m.name AS name, t.name AS type, m.idMove,';
    $sql .= ' m.base_power AS power, m.description AS description, m.accuracy AS accuracy, m.power_points AS power_points, m.category AS category, m.priority AS priority';
    $sql .= ' FROM moves m';
    $sql .= ' JOIN types t ON m.moveType = t.idType';
    $sql .= ' ORDER BY m.name LIMIT 151';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets the Pokemon with the corresponding ID
 * @param mixed $id ID of the pokemon
 * @return false|array
 */
function getPokemonByID($id)
{
    static $ps = null;
    $sql = 'SELECT p.name, t1.name AS type1, t2.name AS type2, p.idPokemon, p.stat_hp AS hp, p.stat_attack AS attack, p.stat_defense AS defense, p.stat_speAttack AS spA, p.stat_speDefense AS spD, p.stat_speed AS speed';
    $sql .= ' FROM pokemons p';
    $sql .= ' JOIN types t1 ON p.primaryType = t1.idType';
    $sql .= ' JOIN types t2 ON p.secondaryType = t2.idType';
    $sql .= ' WHERE p.idPokemon = :ID';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $id, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets the Pokemon with the corresponding ID
 * @param mixed $id ID of the pokemon
 * @return false|array
 */
function getPokemonByType($idType)
{
    static $ps = null;
    $sql = 'SELECT p.name, t1.name AS type1, t2.name AS type2, p.idPokemon';
    $sql .= ' FROM pokemons p';
    $sql .= ' JOIN types t1 ON p.primaryType = t1.idType';
    $sql .= ' JOIN types t2 ON p.secondaryType = t2.idType';
    $sql .= ' WHERE t1.idType = :ID OR t2.idType = :ID';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $idType, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the Pokemons starting with $name
 * @param mixed $name Beginning of the name
 * @return false|array
 */
function searchPokemonStartingWith($name)
{
    static $ps = null;
    $sql = 'SELECT idPokemon FROM pokemons';
    $sql .= ' WHERE name LIKE :NAME';
    $sql .= ' AND idPokemon < 10000';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $name = $name . "%";
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the moves starting with $name
 * @param mixed $name Beginning of the name
 * @return false|array
 */
function searchMoveStartingWith($name)
{
    static $ps = null;
    $sql = 'SELECT idMove FROM moves';
    $sql .= ' WHERE name LIKE :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $name = $name . "%";
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the types starting with $name
 * @param mixed $name Beginning of the name
 * @return false|array
 */
function searchTypeStartingWith($name)
{
    static $ps = null;
    $sql = 'SELECT idType FROM types';
    $sql .= ' WHERE name LIKE :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $name = $name . "%";
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the Pokemons with $name inside
 * @param mixed $name Part of the name
 * @return false|array
 */
function searchPokemonWith($name)
{
    static $ps = null;
    $sql = 'SELECT idPokemon FROM pokemons';
    $sql .= ' WHERE name LIKE :NAME';
    $sql .= ' AND idPokemon < 10000';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $name = "_%" . $name . "%";
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the moves with $name inside
 * @param mixed $name Part of the name
 * @return false|array
 */
function searchMoveWith($name)
{
    static $ps = null;
    $sql = 'SELECT idMove FROM moves';
    $sql .= ' WHERE name LIKE :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $name = "_%" . $name . "%";
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Gets all of the types with $name inside
 * @param mixed $name Part of the name
 * @return false|array
 */
function searchTypeWith($name)
{
    static $ps = null;
    $sql = 'SELECT idType FROM types';
    $sql .= ' WHERE name LIKE :NAME';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $name = "_%" . $name . "%";
        $ps->bindParam(':NAME', $name, PDO::PARAM_STR);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Get all moves a pokemon has
 * @param mixed $id Id of the Pokemon
 * @return false|array
 */
function findMovesLearnedByPokemon($id)
{
    static $ps = null;
    $sql = 'SELECT m.name AS name, t.name AS type, m.category AS category, m.base_power AS base_power, m.accuracy AS accuracy, m.power_points AS power_points FROM moves m';
    $sql .= ' JOIN pokemonMoves pm ON pm.idMove = m.idMove';
    $sql .= ' JOIN pokemons p ON p.idPokemon = pm.idPokemon';
    $sql .= ' JOIN types t ON m.moveType = t.idType';
    $sql .= ' WHERE p.idPokemon = :ID';
    $sql .= ' AND m.moveType = t.idType';
    $sql .= ' ORDER BY m.name';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $id, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Get all pokemons that learns a certain move
 * @param mixed $id Id of the Move
 * @return false|array
 */
function findPokemonsThatLearns($id)
{
    static $ps = null;
    $sql = 'SELECT p.idPokemon FROM pokemons p';
    $sql .= ' JOIN pokemonMoves pm ON pm.idPokemon = p.idPokemon';
    $sql .= ' JOIN moves m ON m.idMove = pm.idMove';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $id, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Get all moves a pokemon has
 * @param mixed $id Id of the Pokemon
 * @return false|array
 */
function getMovesByType($idType)
{
    static $ps = null;
    $sql = 'SELECT m.name, t.name, m.category, m.base_power, m.accuracy, m.power_points FROM moves m';
    $sql .= ' JOIN types t ON t.idType = m.moveType';
    $sql .= ' WHERE m.moveType = :ID';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $idType, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}


/**
 * Updates the moves' descriptions
 * @param mixed $instrument Nom de l'instrument
 * @return bool true si réussi
 */
function addMove($defenderType, $attackerType)
{
    static $ps = null;
    $sql = 'INSERT INTO `pokemons_db`.`abilities` (`idAbility`, `name`, `description`)';
    $sql .= ' VALUES (:IDABILITY, :NAME, :DESC)';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':IDABILITY', $defenderType, PDO::PARAM_INT);
        $ps->bindParam(':NAME', $attackerType, PDO::PARAM_STR);
        $ps->bindParam(':DESC', $attackerType, PDO::PARAM_STR);

        $answer = $ps->execute();
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Get the weaknesses of a type
 * @param mixed $id Id of the type
 * @return false|array
 */
function typeIsWeakTo($idType)
{
    static $ps = null;
    $sql = 'SELECT t.name AS type, t1.name AS weakness';
    $sql .= ' FROM types t';
    $sql .= ' JOIN weaknesses w ON w.defendingType = t.idType';
    $sql .= ' JOIN types t1 ON w.attackingType = t1.idType';
    $sql .= ' WHERE :ID = t.idType';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $idType, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}


/**
 * Get the resistances of a type
 * @param mixed $id Id of the type
 * @return false|array
 */
function typeResists($idType)
{
    static $ps = null;
    $sql = 'SELECT t.name AS type, t1.name AS resistance';
    $sql .= ' FROM types t';
    $sql .= ' JOIN resistances r ON r.defendingType = t.idType';
    $sql .= ' JOIN types t1 ON r.attackingType = t1.idType';
    $sql .= ' WHERE :ID = t.idType';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $idType, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}


/**
 * Get the immunities of a type
 * @param mixed $id Id of the type
 * @return false|array
 */
function typeIsImmunedTo($idType)
{
    static $ps = null;
    $sql = 'SELECT t.name AS type, t1.name AS immunity';
    $sql .= ' FROM types t';
    $sql .= ' JOIN immunities i ON i.defendingType = t.idType';
    $sql .= ' JOIN types t1 ON i.attackingType = t1.idType';
    $sql .= ' WHERE :ID = t.idType';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $idType, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Get the immunities of a type
 * @param mixed $id Id of the type
 * @return false|array
 */
function typeHitsImmunedOn($idType)
{
    static $ps = null;
    $sql = 'SELECT t.name AS type, t1.name AS immunity';
    $sql .= ' FROM types t';
    $sql .= ' JOIN immunities i ON i.attackingType = t.idType';
    $sql .= ' JOIN types t1 ON i.defendingType = t1.idType';
    $sql .= ' WHERE :ID = t.idType';

    if ($ps == null)
    {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;

    try
    {
        $ps->bindParam(':ID', $idType, PDO::PARAM_INT);

        if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Will make us able to update new descriptions
 */
function updateMoveDescription()
{
    if (!empty($_GET['dataPkmn']))
    {
        $items = explode(",", $_GET['dataPkmn']);
        $effect = "";

        for ($i = 2; $i < sizeof($items); $i++)
        {
            $effect .= $items[$i];

            if ($i < sizeof($items) - 1)
            {
                $effect .= ",";
            }
        }

        $effect = str_replace('$effect_chance', $items[1], $effect);

        updateMove(getMoveIDByName($items[0])[0]["idMove"], $effect);

        echo "Move updated";
    }
}