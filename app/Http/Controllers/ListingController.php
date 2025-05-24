<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Resources\ListingResource;
use Inertia\Inertia;
use PhpParser\Node\Expr\List_;
use Termwind\Components\Li;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListingController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =  $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        $query = Listing::mostRecent();
        //This if syntax is the same as the one below, but it is more readable
        // easier to debug and understand
            if($filters['priceFrom'] ?? false){
                $query->where('price', '>=', $filters['priceFrom']);
            }

            //This is the same as the one above, but it is more elegant 
            // and fluent with higher order functions
           $query->when($filters['priceTo'] ?? false, function ($query, $priceTo) {
                $query->where('price', '<=', $priceTo);
            })
            ->when($filters['beds'] ?? false, function ($query, $beds) {
                $query->where('beds', '=', $beds);
            })
            ->when($filters['baths'] ?? false, function ($query, $baths) {
                $query->where('baths', '=', $baths);
            })
            ->when($filters['areaFrom'] ?? false, function ($query, $areaFrom) {
                $query->where('area', '>=', $areaFrom);
            })
            ->when($filters['areaTo'] ?? false, function ($query, $areaTo) {
                $query->where('area', '<=', $areaTo);
            });

        return Inertia::render('Listing/Index', [



            'filters' => $filters,
            'listings' => $query->paginate(10)
                ->withQueryString()
            // ->get()-> map(function ($listing) {
            //     return [
            //         'id' => $listing->id,
            //         'price' => $listing->price,
            //         'beds' => $listing->beds,
            //         'baths' => $listing->baths,
            //         'area' => $listing->area,
            //         'city' => $listing->city,
            //         'code' => $listing->code,
            //         'street' => $listing->street,
            //         'street_nr' => $listing->street_nr,
            //     ];
            // }),
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
        // $this->authorize('create', Listing::class);
        return inertia('Listing/Create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create(
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
        // $this->authorize('view', $listing);
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
        $this->authorize('update', $listing);
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
    public function destroy(Listing $listing)
    {
        //
        $this->authorize('delete', $listing);
        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
