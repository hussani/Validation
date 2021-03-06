<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use ArrayAccess;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class KeyNested extends AbstractRelated
{
    public function hasReference($input)
    {
        try {
            $this->getReferenceValue($input);
        } catch (ComponentException $cex) {
            return false;
        }

        return true;
    }

    private function getReferencePieces()
    {
        return explode('.', $this->reference);
    }

    private function getReferenceArrayValue($input)
    {
        $keys = $this->getReferencePieces();
        $value = $input;
        while (($key = array_shift($keys))) {
            if (!isset($value[$key])) {
                $message = sprintf('Cannot select the key %s from the given array', $this->reference);
                throw new ComponentException($message);
            }

            $value = $value[$key];
        }

        return $value;
    }

    private function getReferenceObjectValue($input)
    {
        $properties = $this->getReferencePieces();
        $value = $input;
        while (($property = array_shift($properties))) {
            if (!isset($value->$property)) {
                $message = sprintf('Cannot select the property %s from the given object', $this->reference);
                throw new ComponentException($message);
            }

            $value = $value->$property;
        }

        return $value;
    }

    public function getReferenceValue($input)
    {
        if (is_array($input) || $input instanceof ArrayAccess) {
            return $this->getReferenceArrayValue($input);
        }

        if (is_object($input)) {
            return $this->getReferenceObjectValue($input);
        }

        $message = sprintf('Cannot select the %s in the given data', $this->reference);
        throw new ComponentException($message);
    }
}
