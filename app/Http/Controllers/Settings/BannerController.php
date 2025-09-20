<?php

namespace App\Http\Controllers\Settings;

use App\Enums\SettingsEnum;
use App\Enums\SettingsType;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Repository\SettingsRepo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BannerController extends Controller
{
    /**
     * 
     * @var SettingsRepo $settings
     */
    private $settings;

    function  __construct()
    {
        $this->settings = SettingsRepo::load(SettingsEnum::BANNER->value, ['data_array' => true]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Banner/List', ['data' => $this->settings->getRepo()->map(function ($settings, $index) {
            return [
                'link' => $settings->get("link"),
                'path' => $settings->get("path"),
                'id' => $index,
            ];
        })]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return Inertia::render('Banner/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $settings = SettingsRepo::load(SettingsEnum::BANNER->value, ['data_array' => true]);


        $settings->setSettings(collect([
            'link' => $request->get('link'),
            'path' => $request->file('medias')[0]->store(config('admin.storage.banner'), 'public'),
        ]));

        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // dd($this->settings->getRepo()->get($id));
        return Inertia::render('Banner/Edit', ['entry' => $this->settings->getRepo()->get($id)->add('id', $id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $settings = SettingsRepo::load(SettingsEnum::BANNER->value, ['data_array' => true]);

        $files = $settings->getRepo()->get($id)->path;

        if ($request->hasFile('medias')) {
            // deelte files
            $files = $request->file('medias')[0]->store(config('admin.storage.banner'), 'public');
        }


        $settings->setSettings(
            $settings->getRepo()->put($id, collect(
                [
                    'link' => $request->get('link'),
                    'path' => $files,
                ]
            )),
            true
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($this->settings->getRepo()->forget($id));
        $this->settings->setSettings($this->settings->getRepo()->forget($id), true);
    }
}
