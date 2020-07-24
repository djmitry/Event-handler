<?php

/**
 * Threads work with polyfill
 * 
 * These packages pages help me:
 * https://www.php.net/manual/ru/reflectionclass.getproperties.php
 * https://www.php.net/manual/ru/reflectionproperty.getvalue.php
 * https://getcomposer.org/doc/01-basic-usage.md#autoloading
 * https://www.php.net/manual/ru/class.thread.php
 * https://github.com/krakjoe/pthreads-polyfill
 */

define('COUNT_TEST_OBJECTS', 50);

require __DIR__ . '/vendor/autoload.php';

use EventApp\MyClass;
use EventApp\EventHandler;

// Create objects
for ($i = 0; $i < COUNT_TEST_OBJECTS; $i++) {
    $objects[] = new MyClass();
}

// Track objects
$handler = new EventHandler();
foreach ($objects as $object) {
    $handler->track($object);
}
$handler->showEvents($object);
$handler->flush($object);