<?php

namespace App\Http\Controllers;

use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayCreateDto;
use App\Models\WorkPlace;
use App\Services\AdditionalWorkingDay\AdditionalWorkingDayServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdditionalWorkingDayController extends Controller
{
    public function storeWorkPlaceWorkdays(Request $request, WorkPlace $workPlace, AdditionalWorkingDayServiceInterface $workDaysService): RedirectResponse
    {
        Gate::authorize('create-working-days');

        $additionalWorkingDayCreateDto = AdditionalWorkingDayCreateDto::createFromRequest($request->all(), $workPlace->uuid);
        dd($additionalWorkingDayCreateDto);
        $workDaysService->storeWorkPlaceWorkdays($additionalWorkingDayCreateDto);

        return redirect()->back()->with('toast_success', __('page.workplace_working_days.updated_successfully'));
    }
}
