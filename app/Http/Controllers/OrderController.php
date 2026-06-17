<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "My Orders - Online Store";
        $viewData["subtitle"] = "My Orders";
        $viewData["orders"] = Order::with('items.product')
                                   ->where('user_id', Auth::user()->id)
                                   ->get();
        return view('order.index')->with("viewData", $viewData);
    }
}