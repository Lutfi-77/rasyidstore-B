<?php

namespace App\Repository;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Monolog\Handler\OverflowHandler;

/**
 * 
 * There Are View Settings Here :
 * data_array => boolean [Representing the data that insert on going is array or object]
 */
class SettingsRepo
{

    /**
     * Loaded settings 
     * @var Collection $config
     */
    public $settings;

    /**
     * 
     * @var EloquentCollection $repo
     */
    private $repo;

    /**
     * 
     * @var Collection $config
     */
    private $config = [];

    function  __construct($settings, $config)
    {
        $this->settings = $settings;
        $this->config = collect($config);
        $this->loadRepo();
    }

    private function loadRepo()
    {
        $key = $this->settings;

        $this->repo = Cache::has($key) ? collect(Cache::get($key)) : Settings::getByKey($key);
    }
    /**
     * Configure The Web Pages To Load Then
     * @param SettingsEnum[] $c
     */
    static function load($setting, $config = [])
    {
        return new static($setting, $config);
    }

    public function getRepo()
    {
        return $this->repo;
    }

    function setSettings(Collection $val, $overwrite = false, $key = null)
    {
        // if(is_null($key)) $key = $this->config->first();
        if (is_null($key)) $key = $this->settings;

        if (!$overwrite) $val = $this->merge($val);

        $this->setValue($key, $val);

        Cache::put($key, $val);
    }

    function merge($val)
    {
        $this->config->get('data_array', false) ? $this->repo->push($val) : $this->repo->merge($val);


        return $this->repo;
    }

    function setValue($key, $val)
    {
        Settings::updateOrCreate([
            'name' => $key
        ], [
            'name' => $key,
            'value' => $val,
        ]);

        // dd($key);

        // $this->repo->isEmpty() ? Settings::create(['name' => $key, 'value' => $val]) : Settings::where('name', $key)->update(['value' => $val]);
    }
}
