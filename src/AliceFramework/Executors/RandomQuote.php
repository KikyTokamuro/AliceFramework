<?php

declare(strict_types=1);

namespace AliceFramework\Executors;

use AliceFramework\Commands\Command;
use AliceFramework\Request;

/**
 * Command for get random quote
 */
class RandomQuote implements Command
{
    /**
     * @var string API url
     */
    private string $url;

    /**
     * @var Request Request data
     */
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $rand = random_int(0, 999999);
        $this->url = "http://api.forismatic.com/api/1.0/?method=getQuote&key=".$rand."&format=json&lang=ru";
    }

    /**
     * Run command
     *
     * @return string
     */
    public function run() : string
    {
        $decoded = json_decode(file_get_contents($this->url), true);

        if (isset($decoded['quoteText'], $decoded['quoteAuthor']))
            return $decoded['quoteText'] . " - " . $decoded['quoteAuthor'];

        return "Random quote";
    }
}
