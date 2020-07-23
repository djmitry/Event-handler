<?php

namespace EventApp;

use ReflectionClass;
use ReflectionProperty;

class EventHandler {
    const LIMIT_FLUSH = 5;

    private $events = [];

    public function track(Eventable $instance): void {
        $reflect = new ReflectionClass($instance);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

        $event = [];
        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();
            $value = $prop->getValue($instance);
            $event[$name] = $value; 
        }

        $this->events[] = json_encode($event);
        // print_r($this->events);
    }
    
    public function flush(): void {
        if ( !$this->events ) {
            echo "Events empty<br/>";
            return;
        }

        $eventsPart = array_splice($this->events, 0, self::LIMIT_FLUSH);
        echo "Events passed " . HttpMock::request($eventsPart) . "<br/>";
    }
}