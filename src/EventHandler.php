<?php

namespace EventApp;

use ReflectionClass;
use ReflectionProperty;
use Threaded;

class EventHandler extends Threaded {
    const LIMIT_FLUSH = 100;
    const COUNT_THREADS = 4;

    private $events = [];

    public function track(Eventable $instance): void {
        // Add event
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

        // Run flush if events are full
        if ( count($this->events) >= self::LIMIT_FLUSH ) {
            echo "Events full<br/>";
            $this->flush();
        }
    }
    
    public function flush(): void {
        if ( !$this->events ) {
            echo "Events empty<br/>";
            return;
        }

        // Run works on threads
        $length = ceil(count($this->events) / self::COUNT_THREADS);
        
        do {
            $eventsPart = array_splice($this->events, 0, $length);
            $work = new Work($eventsPart);
            $result = $work->start();
            /* $eventsPart = json_encode($eventsPart);
            $result = HttpMock::request($eventsPart); */
            // print_r($eventsPart);
            echo "Run work on thread<br/>";
            // echo "Events passed " . $result . "<br/>";
        } while ($this->events);
    }
}