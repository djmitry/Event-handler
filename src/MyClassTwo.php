<?php

namespace EventApp;

class MyClassTwo implements Eventable {
    public $id = "fake-id-2";
    protected $name = "fake-name-2";
    private $hidden = "i-am-secured-2";
}