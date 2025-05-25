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

        return Inertia::render('Listing/Index', [

            'filters' => $filters,
            'listings' => Listing::mostRecent()
                        ->filter($filters)
                        ->paginate(10)
                        ->withQueryString()
]);
        
    }
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
        $listing->load(['images']);
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
