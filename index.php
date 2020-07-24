<?php

// https://www.php.net/manual/ru/reflectionclass.getproperties.php
// https://www.php.net/manual/ru/reflectionproperty.getvalue.php
// https://getcomposer.org/doc/01-basic-usage.md#autoloading
// https://www.php.net/manual/ru/class.thread.php

define('COUNT_TEST_OBJECTS', 30);

require __DIR__ . '/vendor/autoload.php';

use EventApp\MyClass;
use EventApp\MyClassTwo;
use EventApp\EventHandler;

for ($i = 0; $i < COUNT_TEST_OBJECTS; $i++) {
    $objects[] = new MyClass();
}

$handler = new EventHandler();
foreach ($objects as $object) {
    $handler->track($object);
}
$handler->flush($object);