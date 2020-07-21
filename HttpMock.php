<?php

class HttpMock {
    public static function request(array $events): int {
        return count($events);
    }
}