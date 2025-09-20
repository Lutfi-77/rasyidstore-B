<?php

namespace App\Services;

class Tracker {

    function __construct()
    {
        https://github.com/FriendsOfPHP/Goutte
    }

    static function loadTrack($courier,$resi) { 
        return new static($courier,$resi);
    }
}
