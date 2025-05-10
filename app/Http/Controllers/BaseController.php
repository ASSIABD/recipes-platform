<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class BaseController extends Controller
{
    /**
     * Get search parameters and categories for views
     */
    protected function getSearchData(Request $request)
    {
        return [
            'searchableCategories' => Category::orderBy('name')->get(),
            'searchActionUrl' => $this->getSearchActionUrl()
        ];
    }

    /**
     * Get the search action URL for the current page
     */
    protected function getSearchActionUrl()
    {
        return route('recette.index'); // Default to recipes page
    }
}
