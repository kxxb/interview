<?php

abstract class AbstractObject
{
     abstract public function getHandler();
}


class SomeObject1 extends AbstractObject {
    protected $name;

    public function __construct(string $name) { }

    public function getObjectName() { }

    public function getHandler() {return 'handle_object_1';}
}

class SomeObject2 extends AbstractObject {
    protected $name;

    public function __construct(string $name) { }

    public function getObjectName() { }

    public function getHandler() {return 'handle_object_2';}
}

class SomeObjectsHandler {
    public function __construct() { }

    public function handleObjects(array $objects): array {
        $handlers = [];
        foreach ($objects as $object) {
            $handlers[] = $object->getHandler();
        }

        return $handlers;
    }
}

$objects = [
    new SomeObject1('object_1'),
    new SomeObject2('object_2')
];

$soh = new SomeObjectsHandler();
$soh->handleObjects($objects);
