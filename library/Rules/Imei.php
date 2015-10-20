<?php

namespace Respect\Validation\Rules;

class Imei extends AbstractRule
{
    public function validate($input)
    {
        if (strlen($input) !== 15) {
            return false;
        }

        $checkDigit = substr($input, -1);
        $commonDigits = str_split(strrev(substr($input, 0, -1)));

        $commonDigits = array_reverse($commonDigits);
        $doubleOddDigits = [];
        for($x = 1; $x <= 14; $x++) {
            $digit = $commonDigits[$x -1];
            if (($x % 2) != 0) {
                $doubleOddDigits[] = $digit * 2;
                continue;
            }
            $doubleOddDigits[] = $digit;
        }

        return true;
    }

} 