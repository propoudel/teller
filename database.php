<?php
return [
    "fetch"       => PDO::FETCH_CLASS,
    "default"     => "mysql",
    "connections" => [
        "mysql" => [
            "driver"    => "mysql",
            "host"      => "localhost",
            "database"  => "smailshopy",
            "username"  => "smailshopy",
            "password"  => "smailshopy@321",
            "charset"   => "utf8",
            "collation" => "utf8_unicode_ci",
            "prefix"    => ""
        ]
    ],
    "migrations" => "migration"
];