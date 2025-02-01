<?php

namespace App\Http\Controllers\admin;

use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{

    public function getRates()
    {
        try {
            $response = Http::get("https://api.exchangerate-api.com/v4/latest/USD");
            if ($response->ok()) {
                return response()->json($response->json());
            }
            return response()->json(['error' => 'Unable to fetch rates'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries=Country::paginate(10);
        return view('admin.country.country',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.createcountry');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =validator::make($request->all(), [
            'name' => 'required|string|unique:countries',
            'iso_code' => 'required|unique:countries',
            'dail_code' => 'nullable',
            'currency' => 'nullable',
            'currency_symbol' => 'nullable',
            'time_zone' => 'nullable',
            'region' => 'nullable',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Country::create([
            'name' => $request->name,
            'iso_code' => $request->iso_code,
            'dail_code' => $request->dail_code,
            'currency' => $request->currency,
            'currency_symbol' => $request->currency_symbol,
            'time_zone' => $request->time_zone,
            'region' => $request->region,
            'status' => $request->status,
        ]);

        return redirect()->route('country.index')->with('success', 'Country added successfully!');

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
        $country=Country::find($id);
        return view('admin.country.editcountry', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $country=Country::find($id);
        $validator =validator::make($request->all(), [
            'name' => 'required',
            'iso_code' => 'required',
            'dail_code' => 'nullable',
            'currency' => 'nullable',
            'currency_symbol' => 'nullable',
            'time_zone' => 'nullable',
            'region' => 'nullable',
            'status' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

            $country->name = $request->name;
            $country->iso_code = $request->iso_code;
            $country->dail_code = $request->dail_code;
            $country->currency = $request->currency;
            $country->currency_symbol = $request->currency_symbol;
            $country->time_zone = $request->time_zone;
            $country->region = $request->region;
            $country->status = $request->status;
            $country->update();


        return redirect()->route('country.index')->with('success', 'CountryData Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country= Country::find($id);
        $country->delete($id);
        return redirect()->route('country.index')->with('success', 'Data deleted successfully!');
    }
}
