<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Resources\ListingResource;
use Inertia\Inertia;
use PhpParser\Node\Expr\List_;
use Termwind\Components\Li;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Listing/Index', [
            //'listings' => Listing::all(),
            //'listings' => ListingResource::collection(\App\Models\Listing::all()),
            'listings' => Listing::select('id','beds', 'baths','area', 'city','street','street_nr', 'price')->get()-> map(function ($listing) {
                return [
                    'id' => $listing->id,
                    'price' => $listing->price,
                    'beds' => $listing->beds,
                    'baths' => $listing->baths,
                    'area' => $listing->area,
                    'city' => $listing->city,
                    'code' => $listing->code,
                    'street' => $listing->street,
                    'street_nr' => $listing->street_nr,
                ];
            }),
        ]);
    }
    // 'beds' => fake()->numberBetween(1, 5),
    // 'baths' => fake()->numberBetween(1, 5),
    // 'area' => fake()->numberBetween(50, 500),
    // 'city' => fake()->city(),
    // 'code' => fake()->postcode(),
    // 'street' => fake()->streetName(),
    // 'street_nr' => fake()->buildingNumber(),
    // 'price' => fake()->numberBetween(100000, 1000000),
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Listing/Create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Listing::create($request->all());

        return redirect()->route('listings.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return Inertia('Listing/Show', [
            'listing' => $listing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
}
