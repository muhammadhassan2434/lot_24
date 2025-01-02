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
        $products = Product::with('images', 'category', 'country', 'brand', 'seller')->get();
        // $sellerId = $products->pluck('seller_id')->toArray();

        if ($products->isEmpty()) {
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
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = Validator::make($request->all(), [
            'seller_id' => 'required',
            'title' => 'required',
            'description' => 'nullable|string',
            'category_id' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'wholesale_price' => 'nullable|numeric',
            'badges' => 'nullable|string',
            'minimal_order' => 'required|integer|min:1',
            'product_stock' => 'required|integer|min:0',
            'stock_status' => 'required',
            'sku' => 'nullable|string|max:255',
            'ean' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'tags' => 'nullable|string',
            'payment_option' => 'nullable|string',
            'delivery_option' => 'nullable|string',
            'brand_id' => 'nullable|exists:brands,id',
            // Validate multiple images
            'image' => 'nullable|array', // Image must be an array
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Each image must meet these requirements
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
            'seller_id' => $request->seller_id,
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
            'brand_id' => $request->brand_id,
        ]);

        $imageUrls = []; // To store URLs of uploaded images

        // Handle multiple image uploads
        if ($product && $request->hasFile('image')) {
            try {
                foreach ($request->file('image') as $image) {
                    Log::info('Processing image: ' . $image->getClientOriginalName());

                    $fileName = time() . '_' . $image->getClientOriginalName();
                    Log::info('Generated file name: ' . $fileName);

                    $image->move(public_path('uploads/Products'), $fileName);
                    Log::info('Image moved to: ' . public_path('uploads/Products') . '/' . $fileName);

                    $imagePath = 'uploads/Products/' . $fileName;
                    $imageUrl = url($imagePath);
                    $imageUrls[] = $imageUrl;

                    // Save image in the database
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $imagePath,
                    ]);

                    Log::info('Image saved to database: ' . $imageUrl);
                }
            } catch (\Exception $e) {
                Log::error('Image upload error: ' . $e->getMessage());
                return response()->json([
                    'status' => false,
                    'message' => 'Image upload failed',
                    'error' => $e->getMessage(), // Include the actual error message in response
                ], 400);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'product' => $product,
            'image_urls' => $imageUrls, // Return image URLs in response
        ], 201);
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('images', 'category:id,name', 'country:id,name', 'brand:id,name', 'seller')->find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }


        return response()->json([
            'status' => true,
            'message' => 'Product retrieved successfully',
            'product' => $product,

        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProduct($id)
    {
        // return response()->json([
        //     'status' => 'success',
        //     'data' => $id,
        // ], 200);



        $product = Product::with('images')->find($id);

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
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }

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
            'brand_id' => 'nullable|exists:brands,id',
            'image' => 'nullable|array', // Validate multiple images
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'error' => $validated->errors(),
            ], 400);
        }

        // Update product details
        $product->update([
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
            'brand_id' => $request->input('brand_id'),
        ]);

        if ($request->hasFile('image')) {
            $oldImages = $product->images; // Assuming `images()` relationship exists
            foreach ($oldImages as $oldImage) {
                $oldImagePath = public_path($oldImage->image); // Get full file path
                if (file_exists($oldImagePath)) {
                    Log::info("Deleting file: " . $oldImagePath);
                    unlink($oldImagePath); // Delete the file
                } else {
                    Log::warning("File not found: " . $oldImagePath);
                }
                $oldImage->delete(); // Delete the database record
            }

            foreach ($request->file('image') as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/Products/'), $fileName);

                $imagePath = 'uploads/Products/' . $fileName;

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                ]);
            }
        }


        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully.',
            'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::with('images')->find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }

        // Delete the associated images from the database and the folder
        foreach ($product->images as $image) {
            // Delete the image file from the storage folder
            $imagePath = public_path($image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);  // Delete the image file from the folder
                Log::info('Image deleted from folder: ' . $imagePath);
            }

            // Delete the image record from the ProductImage table
            $image->delete();
            Log::info('Image deleted from database: ' . $image->image);
        }

        // Delete the product record from the database
        $product->delete();
        Log::info('Product deleted from database: ' . $product->id);

        return response()->json([
            'status' => true,
            'message' => 'Product and associated images deleted successfully',
        ], 200);
    }


    public function category()
    {
        $categories = Category::select('id', 'name', 'image')->where('status', 'active')->get();
        return response()->json(
            [
                'status' => 'success',
                'data' => $categories
            ]
        );
    }
    public function subcategory($id)
    {
        $subcategories = SubCategory::select('id', 'name', 'category_id')->with(['category:id,name'])->where('category_id', $id)->where('status', 'active')->get();
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
    public function showproducts()
    {
        $products = Product::with('images', 'category')->get();
        return view('admin.product.productlist', compact('products'));
    }
    public function updateDisplayTag(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'displaytag' => 'nullable',
        ]);

        $product = Product::find($request->id);
        $product->displaytag = $request->displaytag;
        $product->save();

        return redirect()->route('admin.showproducts')->with('sucess', "Product Updated SuccessFully");
    }

    public function showweekofferproduct()
    {
        $weekofferproduct = Product::with('images')->where('displaytag', 'Week best offers')->get();
        return response()->json([
            'status' => 'success',
            'data' => $weekofferproduct
        ]);
    }
    public function showrecentlyaddedproduct()
    {
        $recentlyaddedproduct = Product::with('images')->where('displaytag', 'Recently added')->get();
        return response()->json([
            'status' => 'success',
            'data' => $recentlyaddedproduct
        ]);
    }
    public function showmostpopularproduct()
    {
        $mostpopularproduct = Product::with('images')->where('displaytag', 'Most popular offers')->get();
        return response()->json([
            'status' => 'success',
            'data' => $mostpopularproduct
        ]);
    }

    public function sellerproducts($id)
    {


        $products = Product::with('images')->where('seller_id', $id)->get();

        if (!$products) {
            return response()->json([
                'status' => 'false',
                'message' => 'This Seller cannot upload any Products'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }
    public function productdetailshow(string $id) {
        $product = Product::with([
            'images',
            'category:id,name',
            'country:id,name',
            'brand:id,name',
            'seller:id,name,surname,email,phone_number'
        ])->find($id);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        return view('admin.product.productdetail', compact('product'));
    }
    
}
