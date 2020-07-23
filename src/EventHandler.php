<?php

namespace EventApp;

use ReflectionClass;
use ReflectionProperty;

class EventHandler {
    const LIMIT_FLUSH = 5;
    // const COUNT_THREADS = 2;

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
        $this->flush();
    }
    
    public function flush(): void {
        if ( !$this->events ) {
            echo "Events empty<br/>";
            return;
        }
        
        if ( count($this->events) < self::LIMIT_FLUSH ) {
            echo "Events not enough<br/>";
            return;
        }

        do {
            $eventsPart = array_splice($this->events, 0, self::LIMIT_FLUSH);
            $eventsPart = json_encode($eventsPart);
            $result = HttpMock::request($eventsPart);
            print_r($this->events);
            echo "Events passed " . $result . "<br/>";
        } while ($this->events);
    }
}