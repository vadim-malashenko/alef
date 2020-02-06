<?php

namespace Alef;

class App {

    public function start () {

        var_dump (FibonacciSquare::answer (6));
        var_dump (SecretCode::answer ('->11гe+20∆∆A+4µcњil->5•Ћ®†Ѓ p+5f-7Ќ¬f pro+10g+1悦ra->58->44m+1*m+2a喜er!'));
    }

    public static function autoload (string $className) {

        $namespaceLength = strlen (__NAMESPACE__);

        if (strncmp (__NAMESPACE__, $className, $namespaceLength) === 0) {

            $filePath = str_replace (['/', '\\'], DIRECTORY_SEPARATOR, __DIR__ . substr ($className, $namespaceLength)) . '.php';

            if (file_exists ($filePath)) {

                require $filePath;
            }
        }
    }
}
