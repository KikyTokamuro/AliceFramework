<?php

namespace AliceFramework\Commands;

class Common
{
    /**
     * @var $commands List of all active commands
     */
    public static $commands = [
        "случайная цитата" => "\\AliceFramework\\Commands\\RandomQuote",
        "пример" => "\\AliceFramework\\Commands\\Example" 
    ];
}
