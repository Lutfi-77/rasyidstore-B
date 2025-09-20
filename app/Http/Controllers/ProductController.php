<?php

namespace App\Http\Controllers;

use App\Enums\AttributeType;
use App\Enums\MediaType;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Media;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ProductController extends Controller
{
    private function upsertVariant(Request $request, Product $product)
    {
        if ($request->has('variant')) {

            $attr = [];
            $variant = [];
            foreach ($request->get('variant') as $var) {
                //casting to object because of lazyness
                $var = (object)$var;
                // creating 
                $entity = ['stock' => $var->stock, 'price' => $var->price, 'prod_attr_id' => $var->variant_id, 'is_ready' => $var->is_ready];

                // if id is existing go update
                if (isset($var->id)) $entity['id'] = $var->id;

                // adding attr ids to product variant
                // $attr[$var->variant_id] = ['parent_attr_id' => $var->parent_id];
                $attr[] = ['product_id' => $product->id, 'parent_attr_id' => $var->parent_id, 'attribute_id' => $var->variant_id];
                // adding variant type
                $variant[] = new ProductVariant($entity);
            }

            $product->attributes()->sync([]);

            // $product->attributes()->attach($attr);

            // dd($attr);
            // work on manualy 
            DB::table('product_attribute')->insert($attr);


            $product->variants()->saveMany($variant);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $length = config('admin.pagination.length');

        $product = Product::with('category');

        if ($request->get('search', null) !== null)
            $product->where('title', 'like', '%' . $request->get('search', '') . '%');

        return Inertia::render('Product/List', ['data' => $product->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all()->map(fn ($c) => ['value' => $c->id, 'label' => $c->title]);

        $attr = Attribute::getOptions(true);

        return Inertia::render('Product/Create', ['category' => $category, 'attr' => $attr]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'category' => 'required',
        ]);

        $product = Product::create([
            'title' => $form['title'],
            'desc' => $form['desc'],
            'category_id' => $form['category'],
            'meta' => ['variantChoose' => $request->get('variantChoose', 0)],
        ]);

        $media = [];

        $this->upsertVariant($request, $product);

        // to show up in form pages

        // insert Photo
        if ($request->hasFile('medias'))
            foreach ($request->file('medias') as $m) {
                $media[] = new Media([
                    'file_path' => $m->store(config('admin.storage.product'), 'public'),
                    'type' => MediaType::IMAGE
                ]);
            }

        $product->medias()->saveMany($media);
        // end insert file

        // Insert Variant Price And Many More
        // $product->variants()->saveMany($variants);

        return redirect()->route('product.index');
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
        $product = Product::with('category')->with('attributes')->with('variants')->with('medias')->find($id);


        $category = Category::all()->map(fn ($c) => ['value' => $c->id, 'label' => $c->title]);

        $attr = Attribute::getOptions(true);

        // dd(new ProductResource($product), $product);


        return Inertia::render('Product/Edit', ['entry' => new ProductResource($product), 'category' => $category, 'attr' => $attr]);
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
        // dd($request->all());

        $form = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'category' => 'required',
        ]);

        // dd($request->file('medias'));

        $product = Product::find($id);
        // update product
        $product->update([
            'title' => $form['title'],
            'desc' => $form['desc'],
            'category_id' => $form['category'],
        ]);

        $this->upsertVariant($request, $product);


        if ($request->hasFile('medias')) {
            foreach ($request->file('medias') as $m)
                $media[] = new Media([
                    'file_path' => $m->store(config('admin.storage.product'), 'public'),
                    'type' => MediaType::IMAGE,
                ]);
            // save media if exsits
            $product->medias()->saveMany($media);
        }

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
