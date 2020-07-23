<?php

// https://www.php.net/manual/ru/reflectionclass.getproperties.php
// https://www.php.net/manual/ru/reflectionproperty.getvalue.php
// https://getcomposer.org/doc/01-basic-usage.md#autoloading

require __DIR__ . '/vendor/autoload.php';

use EventApp\MyClass;
use EventApp\MyClassTwo;
use EventApp\EventHandler;

$handler = new EventHandler();

for ($i = 0; $i < 10; $i++) {
    $objects[] = new MyClass();
}

foreach ($objects as $object) {
    $handler->track($object);
}
