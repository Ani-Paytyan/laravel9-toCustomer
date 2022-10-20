<?php

namespace App\Http\Controllers;

use App\Models\TeamUser;
use Illuminate\Http\Request;

class TeamUserController extends Controller
{

    public function update(Request $request, TeamUser $teamUser)
    {
        $r = $request->all();

        $teamUserR = $teamUser->update([
            'role' => $r['role']
        ]);

        if ($teamUserR) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.user.updated_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.user.updated_error')
        ]);
    }

}
