<?php

namespace AliceFramework\Commands;

/**
 * Example command
 */
class Example implements Command
{
    /**
     * Start command
     */
    public function start() : string
    {
        return "This is example";
    }
}
