<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductGallery;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductGalleryRequest;


class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = ProductGallery::with(['product']);

            return DataTables::of($query)
                ->addColumn('action', function ($items) {
                    return '
                    
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">
                                        Action
                        </a>
                        <div class="dropdown-menu">

                            <form action="' . route('product-gallery.destroy', $items->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                            <button class="dropdown-item text-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                    ';
                })
                ->editColumn('photo', function ($items) {
                    return $items->photo ? '<img src="' . Storage::url($items->photo) . '" style="max-height: 80px;" />' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }
        return view("pages.admin.product-gallery.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $products = Product::all();

        return view("pages.admin.product-gallery.create", ["products" => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalleryRequest $request)
    {

        $data = $request->all();
        print_r($data);

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    //Update the specified resource in storage.
    public function update(ProductGalleryRequest $request, string $id)
    {
        //
    }

    // Remove the specified resource from storage.
    public function destroy(string $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}
