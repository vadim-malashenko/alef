<?php

namespace Alef;

class SecretCode {

    public static function answer (string $encoded) : string {

        $secretCode = new self ();

        $decoded = $secretCode->decode ($encoded);

        return $decoded;
    }

    protected function decode (string $encoded) : string {

        $parsed = $this->parse ($encoded, ['->', '+', '-']);

        $encodedChars = preg_split ('//u', $encoded, -1, PREG_SPLIT_NO_EMPTY);
        $encodedCharsLength = count ($encodedChars);
        $index = 0;
        $decoded = '';

        while ($index < $encodedCharsLength) {

            if (isset ($parsed [$index])) {

                $index = $parsed [$index];
            }
            else {

                $decoded .= $encodedChars [$index++];
            }
        }

        return $decoded;
    }

    protected function parse (string $encoded, array $commands) : array {

        $parsed = [];

        foreach ($commands as $command) {

            $matches = [];

            preg_match_all("#" . preg_quote ($command) . "(\d+)#", $encoded, $matches, PREG_OFFSET_CAPTURE);

            foreach ($matches [0] as $i => $match) {

                $j    = mb_strlen (substr ($encoded, 0, $match [1]), 'utf-8');
                $next = $matches [1] [$i] [0];

                if ($command === '+' or $command === '-') {

                    $next = $j + 1 + strlen ($next) + "{$command}$next";
                }

                $parsed [$j] = $next;
            }
        }

        return $parsed;
    }
}
