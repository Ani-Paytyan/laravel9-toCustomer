<?php

namespace App\Services\Facades;

use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
use App\Http\Requests\WorkPlace\WorkPlaceCreateRequest;
use App\Http\Requests\WorkPlace\WorkPlaceEditRequest;
use App\Models\WorkPlace;
use App\Services\IwmsApi\WorkPlace\IwmsApiWorkPlaceServiceInterface;
use App\Services\WorkPlace\WorkPlaceServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class IwmsWorkPlaceFacade
{
    public function __construct(
        protected IwmsApiWorkPlaceServiceInterface $apiWorkPlaceService,
        protected WorkPlaceServiceInterface $workPlaceService
    )
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $companyId = Auth::user()->getCompany()->getId() ?? '';

        $workPlaces = WorkPlace::where('company_id', $companyId)->paginate(20);

        return view('workplaces.index', compact('workPlaces'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('workplaces.create');
    }

    /**
     * @param WorkPlaceCreateRequest $request
     * @return RedirectResponse
     */
    public function store(WorkPlaceCreateRequest $request): RedirectResponse
    {
        $companyId = Auth::user()->getCompany()->getId() ?? '';
        // send data from form to api
        $res = $this->apiWorkPlaceService->create(IwmsApiWorkPlaceDto::createForApi($request->all(), $companyId));
        // if success from api we save data in DB
        if ($res && $this->workPlaceService->create($res)) {
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
        $workplace = WorkPlace::where('uuid',$id)->firstOrFail();

        return view('workplaces.edit', compact('workplace'));
    }

    /**
     * @param WorkPlaceEditRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(WorkPlaceEditRequest $request, $id): RedirectResponse
    {
        // send data from form to api
        $res = $this->apiWorkPlaceService->update(IwmsApiWorkPlaceEditDto::createForApi(
            $request->only(['name', 'address', 'zip', 'city', 'number']), $id
        ));
        // if success from api we update data in DB
        if ($res && $this->workPlaceService->update($res)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.updated_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.updated_error'));
    }

    /**
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        if ($this->apiWorkPlaceService->destroy($id) && $this->workPlaceService->destroy($id)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.deleted_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.deleted_error'));
    }
}
