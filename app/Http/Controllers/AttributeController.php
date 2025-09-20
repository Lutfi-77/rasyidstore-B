<?php

namespace App\Http\Controllers;

use App\Enums\AttributeType;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $length = config('admin.pagination.length');

        $attribute = Attribute::query();

        if ($request->get('search', null) !== null)
            $attribute->where('fullname', 'like', '%' . $request->get('search', '') . '%');

        return Inertia::render('Attribute/List', [
            'data' =>  $attribute->paginate($length)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Attribute/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateRequest = $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $metaAttr = [];

        if ($validateRequest['type'] === AttributeType::COLOR->value) {
            $metaAttr['color'] = $request->color;
        }

        Attribute::create(array_merge($validateRequest, ['meta_attr' => (object)$metaAttr]));

        return redirect()->route('attribute.index');
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
        return Inertia::render('Attribute/Edit', [
            'entries' => Attribute::find($id)
        ]);
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
        $validateRequest = $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $metaAttr = [];

        if ($validateRequest['type'] === AttributeType::COLOR) {
            $metaAttr['color'] = $request->color;
        }

        Attribute::find($id)->update(array_merge($validateRequest, ['meta_attr' => (object)$metaAttr]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Attribute::destroy($id);

        return redirect()->route('attribute.index');
    }
}
