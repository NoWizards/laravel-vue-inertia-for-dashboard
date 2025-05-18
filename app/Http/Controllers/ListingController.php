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
        Listing::create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:2000000000',
            ], [
                'beds.required' => 'Please enter the number of beds.',
                'beds.integer' => 'Beds must be a number. A nice number.',
            ])
        );

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
    public function edit(Listing $listing)
    {
        //
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('listings.index')
            ->with('success', 'Listing was changed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
