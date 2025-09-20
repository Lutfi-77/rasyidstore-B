<?php

namespace App\Http\Controllers;

use App\Enums\MediaType;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

/**
 * Konsep Media nya hanya bisa pilih gambar yang root nya karena untuk sub nya
 * dia mengikuti dari root semisal size itu tidak ada ukuran nya
 * 
 */
class MediaController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('attributes', 'variantImages')->find($id);
        $attribute = (int)$product->meta->get('variantChoose', 0) <= 0 ? $product->attributes : Attribute::find($product->attributes->pluck('pivot.parent_attr_id'));

        $medias = [];

        // grouping and santizing url file path
        $product->variantImages->each(function ($c) use (&$medias) {
            $medias[$c->attr_id][] = ['src' => Storage::url($c->file_path), 'id' => $c->id];
        });

        // dd($medias);


        return Inertia::render('Product/Media', ['entry' => $product, 'attributes' => $attribute, 'medias' => $medias]);
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
        $product = Product::find($id);
        $medias = [];
        foreach ($request->medias as $media)
            // dd($request->medias);
            // check if files uploaded
            if (isset($media['files']))
                // looping files thought
                foreach ($media['files'] as $files)
                    $medias[] = [
                        'attr_id' => $media['variant_id'],
                        'file_path' => $files->store(config('admin.storage.product'), 'public'),
                        'type' => MediaType::IMAGE,
                    ];

        // dd($medias);
        $product->medias()->createMany($medias);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Media::destroy($id);
    }
}
