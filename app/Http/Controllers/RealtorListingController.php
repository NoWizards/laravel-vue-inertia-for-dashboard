<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Http\Request;
use App\Models\Listing;

class RealtorListingController extends Controller
{
    use AuthorizesRequests;
    //
    public function index(Request $request)
    {
        //these are the same
        //$user = Auth::user();         // Global Auth facade
        //$user = $request->user();  
        //$query = $request->user()->listings();
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    //->mostRecent()
                    ->filter($filters)
                    ->paginate(5)
                    ->withQueryString()
            ]
        );
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Listing::class);
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was created!');
    }

    public function edit($id)
    {
        $listing = Listing::withTrashed()->where('by_user_id', Auth::user()->id)->findOrFail($id);
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {
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

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was changed!');
    }



    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);
        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
