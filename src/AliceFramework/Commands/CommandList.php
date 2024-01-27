<?php

namespace AliceFramework\Commands;

class CommandList
{
    /**
     * @var array $commands List of all active commands
     */
    public static array $commands = [
        "случайная цитата" => RandomQuote::class,
        "пример" => Example::class
    ];

    /**
     * Check if command exists
     *
     * @param string $command Command name
     * @return bool
     */
    public static function exists(string $command) : bool
    {
        return array_key_exists($command, CommandList::$commands);
    }
}
