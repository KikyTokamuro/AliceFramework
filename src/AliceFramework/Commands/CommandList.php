<?php

declare(strict_types=1);

namespace AliceFramework\Commands;

use AliceFramework\Executors\Example;
use AliceFramework\Executors\RandomQuote;
use AliceFramework\Executors\Reverse;

class CommandList
{
    /**
     * @var array $commands List of all active commands
     */
    public static array $commands = [
        [CommandType::Text, "случайная цитата", RandomQuote::class],
        [CommandType::Text, "пример", Example::class],
        [CommandType::Regex, "/переверни.*/", Reverse::class],
    ];

    /**
     * Check if command exists
     *
     * @param string $command Command name
     * @return ?string
     */
    public static function exists(string $command): ?string
    {
        // Iterate over commands
        foreach (CommandList::$commands as $cmd) {
            // Check command length
            if (count($cmd) < 3)
                continue;

            // Get command values
            list($type, $pattern, $executor) = $cmd;

            // Check Text commands
            if ($type == CommandType::Text && $pattern == $command)
                return $executor;

            // Check Regexp commands
            if ($type == CommandType::Regex && preg_match($pattern, $command))
                return $executor;
        }

        return null;
    }
}
