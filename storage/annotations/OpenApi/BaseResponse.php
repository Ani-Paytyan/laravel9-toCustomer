<?php

namespace Annotations\OpenApi;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Base response",
 *     description="Base response body",
 *     type="object",
 *     schema="BaseResponseSchema",
 *     @OA\Property(
 *         property="message",
 *         title="Message",
 *         type="string",
 *         description="Request status message",
 *         example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
 *     ),
 * )
 *
 * @OA\Response(
 *     response="BaseResponse",
 *     description="Base response",
 *     @OA\JsonContent(ref="#/components/schemas/BaseResponseSchema")
 * )
 *
 * @OA\Response(
 *     response="BaseIncorrectRequestResponse",
 *     description="Incorrect request",
 *     @OA\JsonContent(ref="#/components/schemas/BaseResponseSchema")
 * )
 *
 * @OA\Response(
 *     response="BaseNotFoundResponse",
 *     description="Not found",
 *     @OA\JsonContent(ref="#/components/schemas/BaseResponseSchema")
 * )
 */
class BaseResponse
{
}