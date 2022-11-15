<?php

namespace Annotations\OpenApi;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Base pagination schema",
 *     description="Base pagination schema",
 *     type="object",
 *     schema="PaginationSchema",
 *     @OA\Property(
 *         property="links",
 *         title="Links",
 *         type="object",
 *         description="Pagination links",
 *         @OA\Property(
 *             property="first",
 *             title="First",
 *             type="string",
 *             description="First page link",
 *             example="https://site.com/?page=1"
 *         ),
 *         @OA\Property(
 *             property="last",
 *             title="Last",
 *             type="string",
 *             description="Last page link",
 *             example="https://site.com/?page=3"
 *         ),
 *         @OA\Property(
 *             property="prev",
 *             title="Prev",
 *             type="string",
 *             description="Previous page link. Can be null if currenct link is first.",
 *             example="https://site.com/?page=1",
 *             nullable=true
 *         ),
 *         @OA\Property(
 *             property="next",
 *             title="Next",
 *             type="string",
 *             description="Next page link. Can be null if currenct link is last.",
 *             example="https://site.com/?page=3",
 *             nullable=true
 *         ),
 *     ),
 *     @OA\Property(
 *         property="meta",
 *         title="Meta",
 *         type="object",
 *         description="Meta information",
 *         @OA\Property(
 *             property="current_page",
 *             title="Current Page",
 *             type="int",
 *             description="Current page number",
 *             example="2"
 *         ),
 *         @OA\Property(
 *             property="last_page",
 *             title="Last Page",
 *             type="int",
 *             description="Last page number",
 *             example="3"
 *         ),
 *         @OA\Property(
 *             property="from",
 *             title="From",
 *             type="int",
 *             description="First item on pahe number",
 *             example="16"
 *         ),
 *         @OA\Property(
 *             property="to",
 *             title="To",
 *             type="int",
 *             description="Last item on pahe number",
 *             example="30"
 *         ),
 *         @OA\Property(
 *             property="total",
 *             title="Total",
 *             type="int",
 *             description="Total items number",
 *             example="45"
 *         ),
 *         @OA\Property(
 *             property="per_page",
 *             title="Per Page",
 *             type="int",
 *             description="Items per page number",
 *             example="15"
 *         ),
 *         @OA\Property(
 *             property="path",
 *             title="Path",
 *             type="string",
 *             description="Base url path",
 *             example="https://site.com"
 *         ),
 *         @OA\Property(
 *             property="links",
 *             title="Links",
 *             type="array",
 *             description="Pagination pages links",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(
 *                     property="url",
 *                     title="Url",
 *                     type="string",
 *                     description="Page url",
 *                     example="https://site.com/?page=1"
 *                 ),
 *                 @OA\Property(
 *                     property="label",
 *                     title="Label",
 *                     type="string",
 *                     description="Pagination link label",
 *                     example="Previous"
 *                 ),
 *                 @OA\Property(
 *                     property="active",
 *                     title="Active",
 *                     type="boolean",
 *                     description="Is the link is current",
 *                     example="false"
 *                 ),
 *             ),
 *         ),
 *     ),
 * )
 */
class Pagination
{

}