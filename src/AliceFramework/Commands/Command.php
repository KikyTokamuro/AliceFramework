<?php

declare(strict_types=1);

namespace AliceFramework\Commands;

use AliceFramework\Request;

interface Command
{
    public function __construct(Request $request);

    public function run() : string;
}