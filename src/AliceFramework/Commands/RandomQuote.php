<?php

namespace AliceFramework\Commands;

/**
 * RandomQuote class - Command for get random quote
 */
class RandomQuote
{
    public function __construct()
    {
        $rand = random_int(0, 999999);
        $this->url = "http://api.forismatic.com/api/1.0/?method=getQuote&key=".$rand."&format=json&lang=ru";
    }

    /**
     * start - Start command
     */
    public function start()
    {
        $json = file_get_contents($this->url);
        $decoded = json_decode($json, true);
        return $decoded['quoteText'] . " - " . $decoded['quoteAuthor'];
    }
}
