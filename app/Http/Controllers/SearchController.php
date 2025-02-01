<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function searchByCountry(Request $request)
    {
        $query = $request->input('query');

        // Find countries that match the query
        $countries = Country::where('name', 'like', "%$query%")
            ->with('products') // Eager load related products
            ->get();

        // If no matching countries are found
        if ($countries->isEmpty()) {
            return response()->json([
                'status' => 'false',
                'data' => "No products found for the given country"
            ]);
        }

        // Extract products related to the matched countries
        $products = $countries->flatMap(function ($country) {
            return $country->products;
        });

        // If no products are related to the countries
        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'false',
                'data' => "No products found for the given country"
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'products' => $products
            ]
        ]);
    }

    // Search by Category and Subcategories
    public function searchByCategory($id)
{
    // $query = $request->input('query');

    // Find categories and subcategories that match the query
    $products = Product::where('category_id',$id)->with('images')->get();

    // If no matching categories or subcategories are found
    if ($products->isEmpty()) {
        return response()->json([
            'status' => 'false',
            'data' => "No products found for the given category"
        ]);
    }

    // Extract products related to the matched categories and subcategories

    // If no products are related to the categories or subcategories
    if ($products->isEmpty()) {
        return response()->json([
            'status' => 'false',
            'data' => "No products found for the given category"
        ]);
    }

    return response()->json([
        'status' => 'success',
        'data' => [
            'products' => $products
        ]
    ]);
}

    // Search by Product
    public function searchByProduct(Request $request)
{
    $query = $request->input('query'); // Get the search term from the request

    // Search products by name or description
    $products = Product::where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->get();

    // Check if any products were found
    if ($products->isEmpty()) {
        return response()->json([
            'status' => 'false',
            'data' => "No products found for the given query"
        ]);
    }

    return response()->json([
        'status' => 'success',
        'data' => $products
    ]);
}
}
