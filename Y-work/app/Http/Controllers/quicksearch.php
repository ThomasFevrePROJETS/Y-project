<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class quicksearch extends Controller
{
    public static function accounts()
    {

        $input1 = request('input1');
        $input2 = request('input2');
        $statut = request('statut');
        $result = NULL;

        if(!isset($statut)) {

            if (isset($input1) && !isset($input2)) {

                $result = DB::table('users')
                    ->where('lastname', 'LIKE', $input1.'%')
                    ->orWhere('name', 'LIKE', $input1.'%')
                    ->get();
            }

            if (isset($input2) && !isset($input1)) {

                $result = DB::table('users')
                    ->where('centre', 'LIKE', $input2.'%')
                    ->get();
            }

            if (isset($input1) && isset($input2)) {

                $result = DB::table('users')
                    ->where('centre', 'LIKE', $input2.'%')
                    ->where(function($query){
                        $query->where('name', 'LIKE', request('input1').'%')
                                ->orWhere('lastname', 'LIKE', request('input1').'%');
                    })
                    ->get();
            }
        }

        else {

            if (isset($input1) && !isset($input2)) {

                $result = DB::table('users')
                    ->join('qualifier', 'users.id', '=' ,'qualifier.ID_Personnel')
                    ->join('statut', 'qualifier.ID_Statut', '=', 'statut.ID')
                    ->where('designation', '=', $statut)
                    ->where(function($query) {
                        $query->where('lastname', 'LIKE',  request('input1').'%')
                        ->orWhere('name', 'LIKE', request('input1').'%');
                    })
                    ->get();
            }

            if (isset($input2) && !isset($input1)) {

                $result = DB::table('users')
                ->join('qualifier', 'users.id', '=' ,'qualifier.ID_Personnel')
                ->join('statut', 'qualifier.ID_Statut', '=', 'statut.ID')
                ->where('designation', '=', $statut)
                ->where('centre', 'LIKE', $input2.'%')
                ->get();

            }

            if (isset($input1) && isset($input2)) {

                $result = DB::table('users')
                ->join('qualifier', 'users.id', '=' ,'qualifier.ID_Personnel')
                ->join('statut', 'qualifier.ID_Statut', '=', 'statut.ID')
                ->where('designation', '=', $statut)
                ->where('centre', 'LIKE', $input2.'%')
                ->where(function($query) {
                    $query->where('lastname', 'LIKE',  request('input1').'%')
                    ->orWhere('name', 'LIKE', request('input1').'%');
                })
                ->get();

            }
        }


        return $result;
    }

    public static function companys()
    {

        $input1 = request('input1');
        $input2 = request('input2');
        $result = NULL;

        if (isset($input1) && !isset($input2)) {

            $result = DB::table('entreprise')
            ->where('nom', 'LIKE', $input1.'%')
            ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
            ->join('appartient', 'entreprise.ID', '=', 'appartient.ID_Entreprise')
            ->join('secteur', 'appartient.ID_secteur', '=', 'secteur.ID')
            ->Leftjoin('offre', 'offre.ID_Entreprise', '=', 'entreprise.ID')
            ->select('nom', 'nb_stagiaires_cesi','designation', 'intitule', 'ville', 'entreprise.id AS entrepriseID')
            ->get();
        }

        if (isset($input2) && !isset($input1)) {

            $result = DB::table('entreprise')
            ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
            ->where('ville', 'LIKE', $input2.'%')
            ->join('appartient', 'entreprise.ID', '=', 'appartient.ID_Entreprise')
            ->join('secteur', 'appartient.ID_secteur', '=', 'secteur.ID')
            ->Leftjoin('offre', 'offre.ID_Entreprise', '=', 'entreprise.ID')
            ->select('nom', 'nb_stagiaires_cesi','designation', 'intitule', 'ville', 'entreprise.id AS entrepriseID')
            ->get();
        }

        if (isset($input1) && isset($input2)) {

            $result = DB::table('entreprise')
            ->where('nom', 'LIKE', $input1.'%')
            ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
            ->where('ville', 'LIKE', $input2.'%')

            ->join('appartient', 'entreprise.ID', '=', 'appartient.ID_Entreprise')
            ->join('secteur', 'appartient.ID_secteur', '=', 'secteur.ID')
            ->Leftjoin('offre', 'offre.ID_Entreprise', '=', 'entreprise.ID')
            ->select('nom', 'nb_stagiaires_cesi','designation', 'intitule', 'ville', 'entreprise.id AS entrepriseID')
            ->get();
        }


        return $result;
    }

    public static function offres()
    {

        $input1 = request('input1');
        $input2 = request('input2');
        $input3 = request('input3');
        $result = NULL;

        if (isset($input1) && !isset($input2) && !isset($input3)) {

            $result = DB::table('offre')
                ->where('type_promo', 'LIKE', $input1.'%')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->select('nom', 'ville', 'type_promo','offre.ID AS OffreID', 'intitule')
                ->get();
        }

        if (!isset($input1) && isset($input2) && !isset($input3)) {

            $result = DB::table('offre')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->where('ville', 'LIKE', $input2.'%')
                ->select('nom', 'ville', 'type_promo','offre.ID AS OffreID', 'intitule')
                ->get();
        }

        if (isset($input1) && isset($input2) && !isset($input3) ) {

            $result = DB::table('offre')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->where('type_promo', 'LIKE', $input1.'%')
                ->where('ville', 'LIKE', $input2.'%')
                ->select('nom', 'ville', 'type_promo','offre.ID AS OffreID', 'intitule')
                ->get();
        }

        if (!isset($input1) && !isset($input2) && isset($input3)) {

            $result = DB::table('offre')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->where('duree_stage', 'LIKE', $input3.'%')
                ->select('nom', 'ville', 'type_promo','offre.ID AS OffreID', 'intitule')
                ->get();
        }

        if (isset($input1) && !isset($input2) && isset($input3) ) {

            $result = DB::table('offre')
                ->where('type_promo', 'LIKE', $input1.'%')
                ->where('duree_stage', 'LIKE', $input3.'%')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->select('nom', 'ville', 'type_promo','offre.ID AS OffreID', 'intitule')
                ->get();
        }

        if (!isset($input1) && isset($input2) && isset($input3) ) {

            $result = DB::table('offre')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->where('ville', 'LIKE', $input2.'%')
                ->where('duree_stage', 'LIKE', $input3.'%')
                ->select('nom', 'ville', 'type_promo','offre.ID AS OffreID', 'intitule')
                ->get();
        }

        if (isset($input1) && isset($input2) && isset($input3) ) {

            $result = DB::table('offre')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->where('type_promo', 'LIKE', $input1.'%')
                ->where('ville', 'LIKE', $input2.'%')
                ->where('duree_stage', 'LIKE', $input3.'%')
                ->select('nom', 'ville', 'type_promo','offre.ID AS OffreID', 'intitule')
                ->get();
        }


        return $result;
    }
}

