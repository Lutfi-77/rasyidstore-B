<?php

use Illuminate\Support\Facades\Storage;

class MediaManagement
{
    static function purgeFile($path)
    {
        $public  = Storage::disk('public');

        if ($public->exists($path)) $public->delete($path);
    }
}
