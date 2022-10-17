<?php

namespace App\Http\Controllers;

use App\Models\WorkPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkPlaceController extends Controller
{

    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if ($currentUser) {
            $companyId = $currentUser->getCompany()->getId() ?? '';
        }

        $workPlaces = WorkPlace::paginate(20);

        return view('workplaces.index', compact('workPlaces'));
    }

    public function create()
    {
        return view('workplaces.create');
    }
}
