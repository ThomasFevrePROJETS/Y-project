<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// class inscription extends Controller
// {
//     public function DoIt()
//     {

//         DB::transaction (function() {

//             $statut = request('statut');
//             $email = request('email');
//             $password = bcrypt(request('password'));
//             $password_confirmation = request('password_confirmation');
//             $name = request('name');
//             $fname = request('fname');
//             $centre = request('centre');
//             $promotion = request('promotion');
//             $mineure = request('mineure');

//             $ID_Personnel = DB::table('personnel')->insertGetId(

//                 ['nom' => $name, 'prenom' => $fname, 'centre' => $centre]
//             );

//             $statut = request('statut');

//             $ID_Statut = DB::table('statut')
//                             ->select('*')
//                             ->where('designation', '=', $statut)
//                             ->value('ID');

//             DB::table('qualifier')->insert([

//                 ['ID_Personnel' => $ID_Personnel, 'ID_Statut' => $ID_Statut],
//             ]);

//             DB::table('identifiant')->insert([

//                 ['username' => $email, 'mdp' => $password, 'ID_Personnel' => $ID_Personnel]
//             ]);

//             $ID_Promo = DB::table('promo')
//                             ->select('*')
//                             ->where('type_promo', '=', $mineure)
//                             ->where('annee', '=', $promotion)
//                             ->value('ID');

//             DB::table('assigner')->insert([

//                 ['ID_Promo' => $ID_Promo, 'ID_Personnel' => $ID_Personnel]
//             ]);
//         });

//         return redirect('/');

//     }
// }
