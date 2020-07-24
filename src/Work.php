<?php

namespace EventApp;

use Thread;

class Work extends Thread {
    private $events;
    
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    
    /**
     * Send request
     */
    public function run()
    {
        $eventsJson = json_encode($this->events);
        $result = HttpMock::request($eventsJson);
        echo "Request complete, count objects: " . $result . "<br/>";
        return $result;
    }
}