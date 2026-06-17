<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] = "My Cart";
        $viewData["total"] = 0;
        $viewData["cart"] = session('cart', []);

        foreach ($viewData["cart"] as $item) {
            $viewData["total"] += $item["price"] * $item["quantity"];
        }

        return view('cart.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session('cart', []);
        $quantity = (int) $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name'     => $product->getName(),
                'price'    => $product->getPrice(),
                'image'    => $product->getImage(),
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index');
    }

    public function delete()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }

    public function purchase()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = new Order();
        $order->setTotal($total);
        $order->setUserId(Auth::user()->id);
        $order->save();

        foreach ($cart as $productId => $item) {
            $orderItem = new Item();
            $orderItem->setQuantity($item['quantity']);
            $orderItem->setPrice($item['price']);
            $orderItem->setOrderId($order->getId());
            $orderItem->setProductId($productId);
            $orderItem->save();
        }

        session()->forget('cart');
        return redirect()->route('order.index')->with('success', 'Purchase successful!');
    }
}