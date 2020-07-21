<?php

class EventHandler {
    const LIMIT_FLUSH = 5;

    private $events = [];

    public function track(Eventable $instance): void {
        $this->events[] = json_encode($instance);   
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