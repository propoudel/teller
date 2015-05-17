<?php
return [
    "fetch"       => PDO::FETCH_CLASS,
    "default"     => "mysql",
    "connections" => [
        "mysql" => [
            "driver"    => "mysql",
            "host"      => "localhost",
            "database"  => "teller_app",
            "username"  => "root",
            "password"  => "",
            "charset"   => "utf8",
            "collation" => "utf8_unicode_ci",
            "prefix"    => ""
        ]
    ],
    "migrations" => "migration"
];