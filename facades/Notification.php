<?php

namespace Panic\Notifications\Facades;


use Illuminate\Support\Facades\Facade;


class Notification extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'notification'; }

}