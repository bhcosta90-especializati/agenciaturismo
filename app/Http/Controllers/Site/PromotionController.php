<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $title = 'Promoções';
        return view('site.flight.promotion', compact('title'));
    }
}
