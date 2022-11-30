<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\Facades\IwmsContactFacade;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class EmployeeController extends Controller
{
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
     *              @OA\Property(property="message",type="string",example="Employee archived successfully"),
     *              @OA\Property(property="status",type="integer",example="200"),
     *              @OA\Property(property="success",type="boolean",example="true")
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
     *              @OA\Property(property="message",type="string",example="Employee not archived"),
     *              @OA\Property(property="status",type="integer",example="422"),
     *              @OA\Property(property="success",type="boolean",example="false")
     *          )
     *     ),
     * )
     */
    public function archive(Contact $employee, IwmsContactFacade $iwmsContactFacade): JsonResponse
    {
        if ($iwmsContactFacade->destroy($employee)) {
            return response()->json([
                'success' => true,
                'message' => __('page.employees.archive_employee')
            ], 200);
        }

        return response()->json([
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
     * @OA\Get(
     *     path="/api/v1/employee/{id}/restore/",
     *     summary="Restore employee",
     *     tags={"Employee"},
     *     description="Method of restore employee",
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
     *              @OA\Property(property="message",type="string",example="Employee restored successfully"),
     *              @OA\Property(property="status",type="integer",example="200"),
     *              @OA\Property(property="success",type="boolean",example="true")
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
     *          description="Employee not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message",type="string",example="Employee not restored"),
     *              @OA\Property(property="status",type="integer",example="422"),
     *              @OA\Property(property="success",type="boolean",example="false")
     *          )
     *     ),
     * )
     */
    public function restore(Contact $employee, IwmsContactFacade $iwmsContactFacade): JsonResponse
    {
        if ($iwmsContactFacade->restore($employee)) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => __('page.employees.restored_successfully')
            ], 200);
        }

        return response()->json([
            'success' => false,
            'status' => 422,
            'message' =>  __('page.employees.restored_error')
        ], 422);
    }
}
