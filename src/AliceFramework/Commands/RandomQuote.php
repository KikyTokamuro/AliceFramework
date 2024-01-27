<?php

namespace AliceFramework\Commands;

/**
 * Command for get random quote
 */
class RandomQuote implements Command
{
    /**
     * @var string API url
     */
    private string $url;

    public function __construct()
    {
        $rand = random_int(0, 999999);
        $this->url = "http://api.forismatic.com/api/1.0/?method=getQuote&key=".$rand."&format=json&lang=ru";
    }

    /**
     * Start command
     *
     * @return string
     */
    public function start() : string
    {
        $decoded = json_decode(file_get_contents($this->url), true);

        if (isset($decoded['quoteText'], $decoded['quoteAuthor']))
            return $decoded['quoteText'] . " - " . $decoded['quoteAuthor'];

        return "Random quote";
    }
}
