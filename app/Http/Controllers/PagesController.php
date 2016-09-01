<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
class PagesController extends Controller
{
    public function home(){
        return view('welcome');
    }
    public function about(){
        return view('pages.about');
    }
    public function contact(){
        return view('pages.contact');
    }
    public function people(){
        return view('pages.people');
    }
    public function product(){
        $articles = Article::all();
        return view('pages.product', compact('articles'));
    }
}
