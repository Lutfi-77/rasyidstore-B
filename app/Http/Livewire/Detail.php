<?php

namespace App\Http\Livewire;

use App\Enums\AttributeType;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Detail extends Component
{

    use AuthorizesRequests;

    public $product,
        $productVariant,
        $parent, //Hierarki Pertama
        $child = false, //hierarki kedua
        $variantChoose,
        $comments,
        $productByCategory,
        $images = [],
        $isChild;
    protected $attr; //detail product

    // { description: " Size", title: "Size" },
    // {
    //     description: "Variant Color Dan Size",
    //     title: "Color + Size",
    // },
    // {
    //     description: "Variant Motif Dan Size",
    //     title: "Motif + Size",
    // },
    public function mount($id)
    {
        $this->products = Product::find($id);
        $this->attr = $this->products->attributes;
        $this->parent = Attribute::find($this->attr->pluck('pivot.parent_attr_id'));
        $this->isChild = !$this->parent->isEmpty();
        // if has child load child
        $this->isChild ?
            $this->selectVariant($this->parent->first()->id) :
            $this->parent = $this->attr;
        $this->productVariant = $this->products->variants()->first();
        $this->productByCategory = Product::where('category_id', $this->products->category_id)->get();
        $this->comments = ProductVariant::where('id', $this->productVariant->id)->first();
        $this->variantChoose = $this->getVariantConfigure($this->products->meta->get("variantChoose"));
        // dd();
    }

    private function getVariantConfigure($index)
    {
        $variantChoose = [['size'], ['color', 'size'], ['motif', 'size']];
        return $variantChoose[$index];
    }

    public function setOption($label, $option_id)
    {
        //if the index more than one that mean the hierarky is in deep level
        if (array_search($label, $this->variantChoose) === 0)
            return $this->selectVariant($option_id);

        $this->productVariant = ProductVariant::find($option_id);
    }

    public function render()
    {
        return view('livewire.detail')->extends('pages.layouts.app')->section('content');
    }

    public function selectVariant($hierarkiPertama)
    {
        $this->child = $this->products->attributes()->wherePivot('parent_attr_id', $hierarkiPertama)->get();
        $this->images = $this->products->variantImage($hierarkiPertama)->get()->toArray();

        $this->dispatchBrowserEvent('load_image');
    }

    public function setProductVariant($prod_var_id)
    {
        $this->productVariant = ProductVariant::find($prod_var_id);
    }

    public function addToCart(Request $request)
    {
        // $this->authorize('update', $this);

        $addtocart = new Order;

        $checkOrder = Order::where('prod_variant_id', $this->productVariant->id)->first();

        if (Auth::check()) {
            $check = Order::firstOrCreate(
                ['prod_variant_id' => $this->productVariant->id, 'user_id' => Auth::user()->id],
                ['quantity' => 0]
            )->increment("quantity");
            return $this->alertSuccess();
        } else {
            return redirect()->to(route('login'));
        }
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Product berhasil ditambahkan ke keranjang!']
        );
    }
}
