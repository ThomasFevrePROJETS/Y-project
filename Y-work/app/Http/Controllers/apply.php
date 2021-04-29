<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class apply extends Controller
{
    public function applysend(Request $request)
    {

        $CVpath = NULL;
        $LMpath = NULL;

        if ($request->file('LM') == NULL) {

            $CVpath = $request->file('CV')->store('/CV');
        }

        else {

            $CVpath = $request->file('CV')->store('/CV');
            $LMpath = $request->file('LM')->store('/LM');
        }

        $msg = request('msg');
        $ID_offre = request('applyoffer');
        $ID_users = request('applyuser');

        DB::table('candidature')
            ->insert([
                'CV' => $CVpath,
                'LM' => $LMpath,
                'msg' => $msg,
                'ID_offre' => $ID_offre,
                'ID_personnel' => $ID_users
            ]);


        return back();
    }
}

