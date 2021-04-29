<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class wishlist extends Controller
{
    public function add(Request $request)
    {

        $ID_Offre = $request->input('offre');
        $ID_Personnel = $request->input('user');

        DB::table('souhaiter')->insert([
            'ID_Offre' => $ID_Offre,
            'ID_Personnel' => $ID_Personnel
        ]);

        return back();
    }

    public function delete(Request $request)
    {

        $ID_Offre = $request->input('offre');
        $ID_Personnel = $request->input('user');

        DB::table('souhaiter')
            ->where('ID_Personnel', '=', $ID_Personnel)
            ->where('ID_Offre', '=', $ID_Offre)
            ->delete();

        return back();
    }

}

