<?php

namespace App\Http\Controllers;

use App\Dto\WorkPlace\WorkPlaceDto;
use App\Dto\WorkPlace\WorkPlaceEditDto;
use App\Http\Requests\WorkPlace\WorkPlaceCreateRequest;
use App\Http\Requests\WorkPlace\WorkPlaceEditRequest;
use App\Models\WorkPlace;
use App\Services\Facades\IwmsWorkPlaceFacade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class WorkPlaceController extends Controller
{
    protected $user;
    protected $companyId;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->companyId = Auth::user()->getCompany()->getId();

            return $next($request);
        });
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $workPlaces = WorkPlace::where('company_id', $this->companyId)->paginate(20);

        return view('workplaces.index', compact('workPlaces'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('workplaces.create');
    }

    /**
     * @param WorkPlaceCreateRequest $request
     * @param IwmsWorkPlaceFacade $iwmsWorkPlaceFacade
     * @return RedirectResponse
     */
    public function store(WorkPlaceCreateRequest $request, IwmsWorkPlaceFacade $iwmsWorkPlaceFacade): RedirectResponse
    {
        $storeDto = WorkPlaceDto::createFromRequest($request, $this->companyId);

        if ($iwmsWorkPlaceFacade->create($storeDto)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.created_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.created_error'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $workplace = WorkPlace::where('uuid', $id)->firstOrFail();

        return view('workplaces.edit', compact('workplace'));
    }


    /**
     * @param WorkPlaceEditRequest $request
     * @param IwmsWorkPlaceFacade $iwmsWorkPlaceFacade
     * @param $id
     * @return RedirectResponse
     */
    public function update(WorkPlaceEditRequest $request, IwmsWorkPlaceFacade $iwmsWorkPlaceFacade, $id): RedirectResponse
    {
        $updateDto = WorkPlaceEditDto::createFromRequest($request, $id);

        if ($iwmsWorkPlaceFacade->update($updateDto)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.updated_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.updated_error'));
    }

    /**
     * @param IwmsWorkPlaceFacade $iwmsWorkPlaceFacade
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(IwmsWorkPlaceFacade $iwmsWorkPlaceFacade, $id): RedirectResponse
    {
        if ($iwmsWorkPlaceFacade->destroy($id)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.deleted_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.deleted_error'));
    }
}
