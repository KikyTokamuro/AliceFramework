<?php

declare(strict_types=1);

namespace AliceFramework\Executors;

use AliceFramework\Commands\Command;
use AliceFramework\Request;

/**
 * Example command
 */
class Example implements Command
{
    public function __construct(Request $request) {}

    /**
     * Run command
     */
    public function run() : string
    {
        return "This is example";
    }
}
