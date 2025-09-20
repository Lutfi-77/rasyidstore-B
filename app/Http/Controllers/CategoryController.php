<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $length = config('admin.pagination.length');

        $category = Category::query();

        if ($request->get('search', null) !== null)
            $category->where('title', 'like', '%' . $request->get('search', '') . '%');

        return Inertia::render('Category/List', ['data' => $category->paginate($length)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return Inertia::render('Category/Create', []);
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
            // 'banner' => 'required',
        ]);

        // upload file
        if ($request->hasFile('banner')) {

            $validateRequest['banner'] = $request->file('banner')->store(config('admin.storage.category'), 'public');
        }

        Category::create($validateRequest);


        return redirect()->route('category.index');
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
        $category = Category::find($id);

        return Inertia::render("Category/Edit", ['id' => $id, 'entry' => $category]);
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
        ]);


        if ($request->hasFile('banner')) {

            $validateRequest['banner'] = $request->file('banner')->store(config('admin.storage.category'), 'public');
        }


        Category::find($id)->update($validateRequest);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect()->route('category.index');
    }
}
