<?php

namespace Alef;

class FibonacciSquare {

    public static function answer (int $squareSize) : int {

        $fibonacciSquare = new self ();

        $square = $fibonacciSquare->square ($squareSize);
        $diagonal = $fibonacciSquare->diagonal ($square, true);
        $sum = array_sum ($diagonal);

        return $sum;
    }

    public function fibonacci (int $length) : \Generator {

        if ($length === 0) {

            yield 0;
        }
        else if ($length === 1) {

            yield 1;
        }
        else {

            for ($d= [-1, 1]; $length > 0; --$length) {

                yield (list ($d [0], $d [1]) = [$d [1], array_sum ($d)]) [1];
            }
        }
    }

    public function square (int $squareSize) {

        $square = [];
        $sequenceLength = $squareSize * $squareSize;
        $sequence = $this->fibonacci ($sequenceLength + 1);
        $i = -1;

        foreach ($sequence as $number) {

            if ($number === 0) {

                continue;
            }

            if ($sequenceLength-- % $squareSize === 0) {
                $square [++$i] = [];
            }

            $square [$i] [] = $number;
        }

        return $square;
    }

    public function diagonal (array $square, bool $rtl) : array {

        $squareSize = count ($square) - 1;
        $column = $rtl ? $squareSize : 0;
        $direction = $rtl ? -1 : 1;
        $diagonal = [];

        for ($row = 0; $row <= $squareSize; $row++) {

            $diagonal [] = $square [$row] [$column + $direction * $row];
        }

        return $diagonal;
    }
}
