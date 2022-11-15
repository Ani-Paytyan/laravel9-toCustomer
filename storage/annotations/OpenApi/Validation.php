<?php

namespace Annotations\OpenApi;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Validation failed response",
 *     description="Reponse body on validation failed",
 *     type="object",
 *     schema="ValidationFailedResponseSchema",
 *     @OA\Property(
 *         property="message",
 *         title="Message",
 *         type="string",
 *         description="Error message",
 *         example="The given data was invalid."
 *     ),
 *     @OA\Property(
 *         property="erros",
 *         title="Erros",
 *         type="object",
 *         description="Attributes errors.",
 *
 *         @OA\Property(
 *             property="first_property",
 *             title="Frist property",
 *             type="array",
 *             description="Specific property errors",
 *             @OA\Items(
 *                 type="string",
 *                 example="Property is incorrect."
 *             )
 *         ),
 *         @OA\Property(
 *             property="second_property",
 *             title="Second property",
 *             type="array",
 *             description="Specific property errors",
 *             @OA\Items(
 *                 type="string",
 *                 example="Property is incorrect."
 *             )
 *         ),
 *     ),
 * )
 *
 * @OA\Response(
 *     response="ValidationFailedResponse",
 *     description="Validation errors",
 *     @OA\JsonContent(ref="#/components/schemas/ValidationFailedResponseSchema")
 * ),
 */
class Validation
{

}