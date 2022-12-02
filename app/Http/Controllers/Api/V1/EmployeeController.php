<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Contact;
use App\Services\Facades\IwmsContactFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="api_auth",
 * )
 */
class EmployeeController extends Controller
{
    /**
     *
     *   @OA\Get(
     *     path="/api/v1/employee",
     *     summary="Employees",
     *     tags={"Employee"},
     *     description="Method of get all employees",
     *     security={{ "api_auth": {} }},
     *     @OA\Response(
     *          response=200,
     *          description="Employees",
     *          @OA\JsonContent(allOf={
     *             @OA\Schema(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/EmployeeResource"),
     *              ),
     *              @OA\Property(property="status",type="integer",example="200"),
     *              @OA\Property(property="success",type="boolean",example="true"),
     *              @OA\Property(property="message",type="string",example="Success"),
     *          ),
     *          @OA\Schema(ref="#/components/schemas/PaginationSchema"),
     *         })
     *     )
     * )
     */
    public function index()
    {
        $user = Auth::user();
        $employees = Contact::where('company_id', $user->getCompany()->getId())->paginate(20);

        return EmployeeResource::collection($employees)->additional([
            'success' => true,
            'status' => 200,
            'message' => trans('common.success'),
        ]);
    }

    /**
     * @param Contact $employee
     * @return EmployeeResource|JsonResponse
     *
     * @OA\Get(
     *     path="/api/v1/employee/{id}",
     *     summary="Employee",
     *     tags={"Employee"},
     *     description="Method of get employee",
     *     security={{ "api_auth": {} }},
     *     @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              example="31f41c44-6338-40e0-a2ba-4be0f6143114"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Employee",
     *          @OA\JsonContent(allOf={
     *             @OA\Schema(
     *              @OA\Property(property="data",type="object",ref="#/components/schemas/EmployeeResource"),
     *              @OA\Property(property="status",type="integer",example="200"),
     *              @OA\Property(property="success",type="boolean",example="true"),
     *              @OA\Property(property="message",type="string",example="Success"),
     *          ),
     *             @OA\Schema(ref="#/components/schemas/BaseResponseSchema"),
     *         })
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Employee not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status",type="integer",example="404"),
     *              @OA\Property(property="success",type="boolean",example="false"),
     *              @OA\Property(property="message",type="string",example="Employee not found"),
     *          )
     *     ),
     * )
     */
    public function show(Contact $employee)
    {
        $user = Auth::user();

        $contact = Contact::where('company_id', $user->getCompany()->getId())
            ->where('uuid', $employee->uuid)
            ->first();

        if ($contact) {
            return (new EmployeeResource($contact))->additional([
                'status' => 200,
                'success' => true,
                'message' => trans('common.success'),
            ]);
        }

        return response()->json([
            'status' => 404,
            'success' => false,
            'message' =>  __('page.employees.not_found'),
        ], 404);
    }

    /**
     * @param Contact $employee
     * @param IwmsContactFacade $iwmsContactFacade
     * @return JsonResponse
     *
     * @OA\Delete(
     *     path="/api/v1/employee/{id}/archive",
     *     summary="Archive employee",
     *     tags={"Employee"},
     *     description="Method of archive employee",
     *     security={{ "api_auth": {} }},
     *     @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              example="31f41c44-6338-40e0-a2ba-4be0f6143114"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Employee archived",
     *          @OA\JsonContent(
     *              @OA\Property(property="status",type="integer",example="200"),
     *              @OA\Property(property="success",type="boolean",example="true"),
     *              @OA\Property(property="message",type="string",example="Employee archived successfully"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Employee not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status",type="integer",example="422"),
     *              @OA\Property(property="success",type="boolean",example="false"),
     *              @OA\Property(property="message",type="string",example="Employee not archived")
     *          )
     *     ),
     * )
     */
    public function archive(Contact $employee, IwmsContactFacade $iwmsContactFacade): JsonResponse
    {
        if ($iwmsContactFacade->destroy($employee)) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => __('page.employees.archive_employee')
            ], 200);
        }

        return response()->json([
            'status' => 200,
            'success' => false,
            'message' =>  __('page.employees.archive_employee')
        ], 422);
    }

    /**
     *
     * @param Contact $employee
     * @param IwmsContactFacade $iwmsContactFacade
     * @return JsonResponse
     *
     * @OA\Patch(
     *     path="/api/v1/employee/{id}/restore/",
     *     summary="Restore employee",
     *     tags={"Employee"},
     *     description="Method of restore employee",
     *     security={{ "api_auth": {} }},
     *     @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              example="31f41c44-6338-40e0-a2ba-4be0f6143114"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Employee restored",
     *          @OA\JsonContent(
     *              @OA\Property(property="status",type="integer",example="200"),
     *              @OA\Property(property="success",type="boolean",example="true"),
     *              @OA\Property(property="message",type="string",example="Employee restored successfully")
     *          )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Employee not found or does not exist",
     *          @OA\JsonContent(
     *              @OA\Property(property="status",type="integer",example="422"),
     *              @OA\Property(property="success",type="boolean",example="false"),
     *              @OA\Property(property="message",type="string",example="Employee not restored")
     *          )
     *     ),
     * )
     */
    public function restore(Contact $employee, IwmsContactFacade $iwmsContactFacade): JsonResponse
    {
        if ($iwmsContactFacade->restore($employee)) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => __('page.employees.restored_successfully')
            ], 200);
        }

        return response()->json([
            'status' => 422,
            'success' => false,
            'message' =>  __('page.employees.restored_error')
        ], 422);
    }
}
