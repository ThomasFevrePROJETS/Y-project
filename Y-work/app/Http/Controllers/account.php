<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class account extends Controller
{
    public function delete()
    {

        DB::transaction (function() {

            $AccountID = request('AccountDelete');

            DB::table('assigner')
            ->where('ID_Personnel', '=', $AccountID)
            ->delete();

            DB::table('qualifier')
            ->where('ID_Personnel', '=', $AccountID)
            ->delete();

            DB::table('users')
                ->where('id', '=', $AccountID)
                ->delete();

        });

        return back();
    }
}
