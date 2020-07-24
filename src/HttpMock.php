<?php

namespace EventApp;

class HttpMock {
    /**
     * Send request
     */
    public static function request(string $events): int {
        $eventArr = json_decode($events, true);
        return count($eventArr);
    }
}