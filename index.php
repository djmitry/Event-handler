<?php

// https://www.php.net/manual/ru/reflectionclass.getproperties.php
// https://www.php.net/manual/ru/reflectionproperty.getvalue.php
require_once __DIR__ . "/Eventable.php";
require_once __DIR__ . "/MyClass.php";
require_once __DIR__ . "/MyClassTwo.php";
require_once __DIR__ . "/EventHandler.php";
require_once __DIR__ . "/HttpMock.php";

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
