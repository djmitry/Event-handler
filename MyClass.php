<?php

class MyClass implements Eventable {
    public $id = "fake-id";
    protected $name = "fake-name";
    private $hidden = "i-am-secured";

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}