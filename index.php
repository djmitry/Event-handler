<?php

// https://www.php.net/manual/ru/reflectionclass.getproperties.php
// https://www.php.net/manual/ru/reflectionproperty.getvalue.php
// https://getcomposer.org/doc/01-basic-usage.md#autoloading

require __DIR__ . '/vendor/autoload.php';

use EventApp\MyClass;
use EventApp\MyClassTwo;
use EventApp\EventHandler;

$handler = new EventHandler();
$classOne = new MyClass();
$classTwo = new MyClassTwo();
$handler->track($classOne);
$handler->track($classOne);
$handler->track($classOne);
$handler->track($classOne);
$handler->track($classTwo);
$handler->track($classTwo);
$handler->track($classTwo);
$handler->track($classTwo);
$handler->flush();
$handler->flush();
$handler->flush();
