<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Home Page - Online Store";
        return view('home.index')->with("viewData", $viewData);
    }

    public function about()
    {
        $viewData = [];
        $viewData["title"] = "About Us - Online Store";
        $viewData["subtitle"] = "About Us";
        $viewData["description"] = "This is an Online Store built with Laravel.";
        $viewData["author"] = "Developed by: KhairilNwrr";
        return view('home.about')->with("viewData", $viewData);
    }
}