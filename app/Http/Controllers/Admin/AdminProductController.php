<?php
namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin - Products";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function create()
    {
        $viewData = [];
        $viewData["title"] = "Admin - Create Product";
        return view('admin.product.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        $newProduct = new Product();
        $newProduct->setName($request->name);
        $newProduct->setPrice($request->price);
        $newProduct->setDescription($request->description);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $newProduct->setImage($imageName);
        } elseif ($request->image_url) {
            $newProduct->setImage($request->image_url);
        }

        $newProduct->save();
        return redirect()->route('admin.product.index')
                         ->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin - Edit Product";
        $viewData["product"] = Product::findOrFail($id);
        return view('admin.product.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        $product = Product::findOrFail($id);
        $product->setName($request->name);
        $product->setPrice($request->price);
        $product->setDescription($request->description);

        if ($request->hasFile('image')) {
            if ($product->getImage() && file_exists(public_path('uploads/' . $product->getImage()))) {
                unlink(public_path('uploads/' . $product->getImage()));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $product->setImage($imageName);
        } elseif ($request->image_url) {
            $product->setImage($request->image_url);
        }

        $product->save();
        return redirect()->route('admin.product.index')
                         ->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        Item::where('product_id', $id)->delete();

        if ($product->getImage() && file_exists(public_path('uploads/' . $product->getImage()))) {
            unlink(public_path('uploads/' . $product->getImage()));
        }

        $product->delete();

        return redirect()->route('admin.product.index')
                         ->with('success', 'Product deleted successfully!');
    }
}