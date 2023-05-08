<?php 

DEFINE("TABELA", "mydb");
DEFINE("UTILIZATOR", "root");
DEFINE("PAROLA", "");
DEFINE("SERVER", "localhost");
DEFINE("DOMENIU", "http://localhost/IWP%20Website/");
function conectare($sql)
{
    //$conectare = new mysqli("", UTILIZATOR, PAROLA, TABELA);
    //echo $sql;
    $conectare = mysqli_connect(SERVER, UTILIZATOR, PAROLA, TABELA);
    // Check connection
    if (mysqli_connect_errno()) { //$conectare->connect_error)
        die("Connection failed: " . mysqli_connect_errno()); //$conectare->connect_error)
    } else {
        echo "Conectare realizata la baza de date...";
    }

    mysqli_query($conectare, "SET NAMES utf8");
    mysqli_query($conectare, "SET CHARACTER SET utf8");
    mysqli_query($conectare, "SET COLLATION_CONNECTION='utf8_general_ci'");
    if (strtoupper(substr($sql, 0, 6)) == "SELECT") {
        $sql_rezultat = mysqli_query($conectare, $sql);
        $numar_randuri = ($sql_rezultat ? mysqli_num_rows($sql_rezultat) : 0);
        if ($sql_rezultat) {
            //$inregistrare = mysqli_fetch_assoc($sql_rezultat);
            mysqli_data_seek($sql_rezultat, 0);
        }
        //$conectare->close();
        mysqli_close($conectare);
        return array($numar_randuri, $sql_rezultat);
    } elseif (strtoupper(substr($sql, 0, 6)) == "INSERT") {
        //mysqli_query($conectare,$sql);
        $insert = mysqli_query($conectare, $sql);
        //echo $sql;
        if (!$insert) {
            die('Este o eroare in sql: ' . mysqli_error($conectare));
        }
        $last_id_inserted = mysqli_insert_id($conectare);
        //$conectare->close();
        mysqli_close($conectare);
        return $last_id_inserted;
    } elseif (strtoupper(substr($sql, 0, 6)) == "UPDATE") {
        mysqli_query($conectare, $sql);
        return mysqli_affected_rows($conectare);
        //$conectare->close();
        mysqli_close($conectare);
    } elseif (strtoupper(substr($sql, 0, 6)) == "DELETE") {
        mysqli_query($conectare, $sql);
        //$conectare->close();
        mysqli_close($conectare);
    }
}


function db_connect()
{
    // Define connection as a static variable, to avoid connecting more than once
    static $connection;
    // Try and connect to the database, if a connection has not been established yet
    if (!isset($connection)) {
        $connection = mysqli_connect(SERVER, UTILIZATOR, PAROLA, TABELA);
        db_query("SET NAMES utf8");
        db_query("SET CHARACTER SET utf8");
        db_query("SET COLLATION_CONNECTION='utf8_general_ci'");
    }
    // If connection was not successful, handle the error
    if ($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error();
    }
    return $connection;
}
function db_query($query)
{
    // Connect to the database
    $connection = db_connect();
    // Query the database
    $result = mysqli_query($connection, $query);
    return $result;
}
function db_error()
{
    $connection = db_connect();
    return mysqli_error($connection);
}
function db_select($query)
{
    $rows = array();
    $result = db_query($query);
    // If query failed, return `false`
    if ($result === false) {
        //echo "nu merge query db_select";
        //echo $query;
        return false;
    }
    // If query was successful, retrieve all the rows into an array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    $nr = mysqli_num_rows($result);
    mysqli_free_result($result);
    return array($nr, $rows);
}
function db_quote($value, $quote = true)
{
    $connection = db_connect();
    return ($quote ? "'" : "") . mysqli_real_escape_string($connection, $value) . ($quote ? "'" : "");
}
function db_close()
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

function desinfect($var)
{
    $var = htmlspecialchars($var);
    $var = trim($var);
    $var = stripslashes($var);
    $var = html_entity_decode($var);
    return $var;
}

function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}
