<?php

namespace App\Http\Controllers;

use App\Dto\WorkDays\WorkDaysCreateDto;
use App\Interfaces\WorkingDaysRepositoryInterface;
use App\Models\WorkDays;
use App\Models\WorkPlace;
use App\Services\WorkDays\WorkDaysServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class WorkDaysController extends Controller
{
    protected $user;
    protected $companyId;

    public function __construct(
        protected WorkingDaysRepositoryInterface $workingDaysRepository
    )
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->companyId = Auth::user()->getCompany()->getId();

            return $next($request);
        });
    }

    /**
     * @return Application|Factory|View
     */
    public function companyWorkdays()
    {
        Gate::authorize('create-working-days');

        $weekdays = WorkDays::getDays();
        $workingDays = $this->workingDaysRepository->getCompanyWorkingDays($this->companyId);

        return view('workdays.index', compact('workingDays', 'weekdays'));
    }

    /**
     * @param Request $request
     * @param WorkDaysServiceInterface $workDaysService
     * @return RedirectResponse
     */
    public function storeCompanyWorkdays(Request $request, WorkDaysServiceInterface $workDaysService): RedirectResponse
    {
        Gate::authorize('create-working-days');

        $workDays = [];
        $data = $request->all();
        foreach ($data['data'] as $res) {
            $workDays[] = WorkDaysCreateDto::createFromRequest($res);
        }

        $workDaysService->storeCompanyWorkdays($workDays, $this->companyId);

        return redirect()->back()->with('toast_success', __('page.working_days.updated_successfully'));
    }

    /**
     * @param WorkDaysServiceInterface $workDaysService
     * @return RedirectResponse
     */
    public function deleteCompanyWorkdays(WorkDaysServiceInterface $workDaysService): RedirectResponse
    {
        Gate::authorize('destroy-working-days');

        if ($workDaysService->deleteCompanyWorkdays($this->companyId)) {
            return redirect()->back()->with('toast_success', __('page.working_days.deleted_successfully'));
        }

        return redirect()->back()->with('toast_success', __('page.working_days.deleted_error'));
    }

    public function workPlaceWorkdays(WorkPlace $workPlace)
    {
        Gate::authorize('create-workplace-working-days');

        $weekdays = WorkDays::getDays();
        $workingDays = $this->workingDaysRepository->getWorkPlaceWorkingDays($workPlace->uuid);
        $additionalWorkingDays = $workPlace->additionalWorkingDays()->get();

        return view('workplaces.workdays', compact('workingDays', 'weekdays', 'workPlace', 'additionalWorkingDays'));
    }

    public function storeWorkPlaceWorkdays(Request $request, WorkPlace $workPlace, WorkDaysServiceInterface $workDaysService): RedirectResponse
    {
        Gate::authorize('create-workplace-working-days');

        $workDays = [];
        $data = $request->all();
        foreach ($data['data'] as $res) {
            $workDays[] = WorkDaysCreateDto::createFromRequest($res);
        }

        $workDaysService->storeWorkPlaceWorkdays($workDays, $workPlace->uuid);

        return redirect()->back()->with('toast_success', __('page.workplace_working_days.updated_successfully'));
    }

    /**
     * @param WorkPlace $workPlace
     * @param WorkDaysServiceInterface $workDaysService
     * @return RedirectResponse
     */
    public function deleteWorkPlaceWorkdays(WorkPlace $workPlace, WorkDaysServiceInterface $workDaysService): RedirectResponse
    {
        Gate::authorize('delete-workplace-working-days');

        if ($workDaysService->deleteWorkPlaceWorkdays($workPlace->uuid)) {
            return redirect()->back()->with('toast_success', __('page.workplace_working_days.deleted_successfully'));
        }

        return redirect()->back()->with('toast_success', __('page.workplace_working_days.deleted_error'));
    }
}
