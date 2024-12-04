<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();

        if($products->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No products found.',
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $products,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'wholesale_price' => 'nullable|numeric',
            'badges' => 'nullable|string',
            'minimal_order' => 'required|integer|min:1',
            'product_stock' => 'required|integer|min:0',
            'stock_status' => 'required|in:in_stock,out_of_stock,pre_order',
            'sku' => 'nullable|string|max:255',
            'ean' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'tags' => 'nullable|string',
            'payment_option' => 'nullable|string',
            'delivery_option' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
    
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'error' => $validated->errors(),
            ], 400);
        }
    
        // Create the product
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'wholesale_price' => $request->wholesale_price,
            'badges' => $request->badges,
            'minimal_order' => $request->minimal_order,
            'product_stock' => $request->product_stock,
            'stock_status' => $request->stock_status,
            'sku' => $request->sku,
            'ean' => $request->ean,
            'country_id' => $request->country_id,
            'tags' => $request->tags,
            'payment_option' => $request->payment_option,
            'delivery_option' => $request->delivery_option,
        ]);
    
        $imageUrl = null;
    
        // Handle single image upload
        if ($product && $request->hasFile('image')) {
            try {
                $image = $request->file('image');
                Log::info('Image detected: ' . $image->getClientOriginalName());
        
                $fileName = time() . '_' . $image->getClientOriginalName();
                Log::info('Generated file name: ' . $fileName);
        
                $image->move(public_path('uploads/product'), $fileName);
                Log::info('Image moved to: ' . public_path('uploads/product') . '/' . $fileName);
        
                $imageUrl = url('uploads/product/' . $fileName);
        
                // Save image in the database
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/product/' . $fileName,
                ]);
        
                Log::info('Image saved to database: ' . $imageUrl);
            } catch (\Exception $e) {
                Log::error('Image upload error: ' . $e->getMessage());
                return response()->json([
                    'status' => false,
                    'message' => 'Image upload failed',
                    'error' => $e->getMessage(), // Include the actual error message in response
                ], 500);
            }
        }
        
    
        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'product' => $product,
            'image_url' => $imageUrl, // Return image URL in response
        ], 201);
    }






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images')->where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.',
            ], 404);
        }

        // Return the product data with images
        return response()->json([
            'status' => 'success',
            'data' => $product,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'wholesale_price' => 'nullable|numeric',
            'badges' => 'nullable|string',
            'minimal_order' => 'required|integer|min:1',
            'product_stock' => 'required|integer|min:0',
            'stock_status' => 'required|in:in_stock,out_of_stock,pre_order',
            'sku' => 'nullable|string|max:255',
            'ean' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'tags' => 'nullable|string',
            'payment_option' => 'nullable|string',
            'delivery_option' => 'nullable|string',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validator Error',
                'error' => $validated->errors()
            ], 400);
        }

        // Fetch the product details
        

        // Handle image upload


        // Update product details
        $product = Product::where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'regular_price' => $request->input('regular_price'),
            'sale_price' => $request->input('sale_price'),
            'wholesale_price' => $request->input('wholesale_price'),
            'badges' => $request->input('badges'),
            'minimal_order' => $request->input('minimal_order'),
            'product_stock' => $request->input('product_stock'),
            'stock_status' => $request->input('stock_status'),
            'sku' => $request->input('sku'),
            'ean' => $request->input('ean'),
            'country_id' => $request->input('country_id'),
            'tags' => $request->input('tags'),
            'payment_option' => $request->input('payment_option'),
            'delivery_option' => $request->input('delivery_option'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully.',
            'data' => $product,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function category()
    {
        $categories = Category::select('id', 'name')->where('status', 'active')->get();
        return response()->json(
            [
                'status' => 'success',
                'data' => $categories
            ]
        );
    }
    public function subcategory()
    {
        $subcategories = subcategory::select('id', 'name', 'category_id')->with(['category:id,name'])->where('status', 'active')->get();
        return response()->json([
            'status' => 'success',
            'data' => $subcategories
        ]);
    }
    public function brand()
    {
        $brands = Brand::select('id', 'name')->where('status', 'active')->get();
        return response()->json([
            'status' => 'success',
            'data' => $brands
        ]);
    }

    public function country()
    {
        $countries = Country::select('id', 'name')->where('status', 'active')->get();
        return response()->json([
            'status' => 'success',
            'data' => $countries
        ]);
    }
}
