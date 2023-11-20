<?php

header("HINT: d2=flag post");

$d2 = $_POST["d2"];

if ($d2 === "flag"){
    echo "flag{********************************}";
}
