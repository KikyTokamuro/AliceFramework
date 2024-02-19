<?php

declare(strict_types=1);

namespace AliceFramework\Executors;

use AliceFramework\Commands\Command;
use AliceFramework\Request;

/**
 * Command for get reverse request
 */
class Reverse implements Command
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
    }

    /**
     * Reverse a miltibyte string.
     *
     * @param string $string The string to be reversed.
     * @param string|null $encoding The character encoding. If it is omitted, the internal character encoding value
     *     will be used.
     * @return string The reversed string
     */
    private function mb_strrev(string $string, string $encoding = null): string
    {
        $chars = mb_str_split($string, 1, $encoding ?: mb_internal_encoding());
        return implode('', array_reverse($chars));
    }

    /**
     * Run command
     *
     * @return string
     */
    public function run() : string
    {
        $tokens = $this->request->getTokens();

        if (count($tokens) == 1)
            return $this->mb_strrev($tokens[0], 'UTF-8');

        return implode(
            " ",
            array_map(
                fn($token): string => $this->mb_strrev($token, 'UTF-8'),
                array_slice($tokens, 1)
            )
        );
    }
}
