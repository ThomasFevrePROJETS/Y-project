<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangeInfo extends Controller
{
    public function ChangeInfo()
    {

        DB::transaction(function () {

            $statut = request('statut');
            $email = request('email');
            // $password = bcrypt(request('password'));
            // $password_confirmation = request('password_confirmation');
            $name = request('name');
            $lastname = request('lastname');
            $centre = request('centre');
            $promo1 = request('A1');
            $promo2 = request('A2');
            $promo3 = request('A3');
            $promo4 = request('A4');
            $promo5 = request('A5');
            $mineure = request('mineure');

            $ID_Users = DB::table('users')
                ->select('*')
                ->where('lastname', '=', $lastname)
                ->where('name', '=', $name)
                ->value('id');

            $ID_Statut = DB::table('statut')
                ->select('*')
                ->where('designation', '=', $statut)
                ->value('ID');

            if (!empty($ID_Statut)) {
                DB::table('qualifier')->updateOrInsert(
                    ['ID_Personnel' => $ID_Users],
                    ['ID_Statut' => $ID_Statut],
                );
            }

            DB::table('users')
                ->where('lastname', '=', $lastname)
                ->where('name', '=', $name)
                ->update(['centre' => $centre]);

            DB::table('users')
                ->where('lastname', '=', $lastname)
                ->where('name', '=', $name)
                ->update(['email' => $email]);

            DB::table('assigner')
                ->where('ID_Personnel', $ID_Users)
                ->delete();

            if (!empty($promo1)) {
                $ID_Promo = DB::table('promo')
                    ->select('*')
                    ->where('type_promo', '=', $mineure)
                    ->where('annee', '=', $promo1)
                    ->value('ID');
                DB::table('assigner')->insert(
                    ['ID_Personnel' => $ID_Users,
                        'ID_Promo' => $ID_Promo],
                );
            }
            if (!empty($promo2)) {
                $ID_Promo = DB::table('promo')
                    ->select('*')
                    ->where('type_promo', '=', $mineure)
                    ->where('annee', '=', $promo2)
                    ->value('ID');
                DB::table('assigner')->insert(
                    ['ID_Personnel' => $ID_Users,
                        'ID_Promo' => $ID_Promo],
                );
            }
            if (!empty($promo3)) {
                $ID_Promo = DB::table('promo')
                    ->select('*')
                    ->where('type_promo', '=', $mineure)
                    ->where('annee', '=', $promo3)
                    ->value('ID');
                DB::table('assigner')->insert(
                    ['ID_Personnel' => $ID_Users,
                        'ID_Promo' => $ID_Promo],
                );
            }
            if (!empty($promo4)) {
                $ID_Promo = DB::table('promo')
                    ->select('*')
                    ->where('type_promo', '=', $mineure)
                    ->where('annee', '=', $promo4)
                    ->value('ID');
                DB::table('assigner')->insert(
                    ['ID_Personnel' => $ID_Users,
                        'ID_Promo' => $ID_Promo],
                );
            }
            if (!empty($promo5)) {
                $ID_Promo = DB::table('promo')
                    ->select('*')
                    ->where('type_promo', '=', $mineure)
                    ->where('annee', '=', $promo5)
                    ->value('ID');
                DB::table('assigner')->insert(
                    ['ID_Personnel' => $ID_Users,
                        'ID_Promo' => $ID_Promo],
                );
            }

        });

        return redirect('/home');

    }
}
