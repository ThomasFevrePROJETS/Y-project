<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class offer extends Controller
{
    public function create()
    {

        DB::transaction (function() {

            $nom = request('companyname');
            $intitule = request('offer_title');
            $type_promo = request('type_promo');
            $duree_stage = request('duration');
            $date = request('start_date');
            $nb_places = request('nb_places');
            $skill = request('skill');
            $remuneration = request('gratification');
            $descriptif = request('description');

            $ID_Entreprise = DB::table('entreprise')->select('*')->where('nom','=',$nom)->value("ID");

            $ID_Localite = DB::table('entreprise')->select('*')->where('nom','=',$nom)->value("ID_Localite");

            $ID_Offre = DB::table('offre')->insertGetId(
                ['intitule' => $intitule, 'descriptif' => $descriptif, 'type_promo' => $type_promo, 'duree_stage' => $duree_stage, 'remuneration' => $remuneration, 'date_debut' => $date, 'nb_places' => $nb_places, 'ID_Entreprise' => $ID_Entreprise]
            );

            $ID_Competence = DB::table('competence')->insertGetId(
                ['designation' => $skill]
            );

            DB::table('requerir')->insert([
                ['ID_Offre' => $ID_Offre, 'ID_Competence' => $ID_Competence],
            ]);

        });

        return redirect('/offres');
    }


    public function update()
    {

        DB::transaction (function() {

            // on recupere ce que l'on a ecrit dans le modal
            $intitule = request('offer_titre');
            $type_promo = request('type_promotion');
            $duree_stage = request('duree');
            $date = request('date_debut');
            $nb_places = request('nombre_places');
            $skill = request('competences');
            $remuneration = request('gratifi');
            $descriptif = request('descriptif');

            $ID = request("idoffre");

            //-----COMPETENCES---------------------------------------
            DB::table('offre')
            ->join('requerir', 'offre.ID', '=', 'requerir.ID_Offre')
            ->join('competence', 'competence.ID', '=', 'requerir.ID_Competence')
            ->where('offre.ID', '=', $ID)
            ->update(['designation' => $skill]);

             //-----OFFRE---------------------------------------
             DB::table('offre')
             ->where('offre.ID', '=', $ID)
             ->update(['intitule' => $intitule,'descriptif' => $descriptif, 'type_promo' => $type_promo,
                       'duree_stage' => $duree_stage, 'remuneration' => $remuneration, 'date_debut' => $date,
                       'nb_places' => $nb_places]);

        });

        return redirect('/offres');
    }



    public static function delete(Request $request)
    {
        $input1 = $request->input('IDuser');

        DB::table('requerir')
            ->where('ID_Offre', '=', $input1)
            ->delete();

        DB::table('offre')
            ->where('ID', '=', $input1)
            ->delete();
        return;
    }


}




