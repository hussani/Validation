--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\OptionalException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::not(v::optional(v::equals('foo')))->check(null);
} catch (OptionalException $e) {
    echo $e->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
null must not be optional
