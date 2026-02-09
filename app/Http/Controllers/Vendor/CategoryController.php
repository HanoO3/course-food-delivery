<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
      public function create(): Response
    {
        $this->authorize('category.create');
 
        return Inertia::render('Vendor/Categories/Create');
    }
}
