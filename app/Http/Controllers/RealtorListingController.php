<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\Models\Listing;

class RealtorListingController extends Controller
{
    use AuthorizesRequests;
    //
    public function index()
    {
        //these are the same
        //$user = Auth::user();         // Global Auth facade
        //$user = $request->user();     // From the request object
        return inertia(
            'Realtor/Index',
            ['listings' => Auth::user()->listings]
        );
    }


    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);
        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
