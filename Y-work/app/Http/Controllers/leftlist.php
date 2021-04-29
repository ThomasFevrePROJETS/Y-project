<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Droits;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class leftlist extends Controller
{
    public static function accounts()
    {

        $accounts =  DB::table('users')
            ->leftJoin('assigner', 'users.ID', '=', 'assigner.ID_Personnel')
            ->join('promo', 'assigner.ID_Promo', '=', 'promo.ID')
            ->select('users.id', 'name', 'lastname', 'centre', 'annee', 'type_promo')
            ->get();

        return $accounts;
    }


    public static function offres()
    {
        $IDpilotes = Droits::Getpilote("Pilote");

        if($IDpilotes){
            $offres =  DB::table('offre')
                ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
                ->join('localite', 'localite.ID_Entreprise', '=', 'entreprise.ID')
                ->select('nom', 'type_promo', 'ville', 'offre.ID AS OffreID', 'descriptif', 'intitule')
                ->paginate(5);

            return $offres;
        }
        else {
            $offres =  DB::table('offre')
            ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
            ->join('localite', 'localite.ID_Entreprise', '=', 'entreprise.ID')
            ->join('hide','hide.ID_Entreprise', '=', 'entreprise.id')
                ->where('hide.bool', '=', false)
            ->select('nom', 'type_promo', 'ville', 'offre.ID AS OffreID', 'descriptif', 'intitule')
            ->paginate(5);

            return $offres;
        }
    }

    public static function companys()
    {
        $IDpilotes = Droits::Getpilote("Pilote");

        if($IDpilotes){
            $companys =  DB::table('entreprise')
            ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
            ->join('appartient', 'entreprise.ID', '=', 'appartient.ID_Entreprise')
            ->join('secteur', 'appartient.ID_secteur', '=', 'secteur.ID')
            ->select('nom', 'designation', 'ville', 'entreprise.id AS entrepriseID')
            ->paginate(5);


            return $companys;
        }
        else {
            $companys2 =  DB::table('entreprise')
                ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
                ->join('appartient', 'entreprise.ID', '=', 'appartient.ID_Entreprise')
                ->join('secteur', 'appartient.ID_secteur', '=', 'secteur.ID')
                ->join('hide','hide.ID_Entreprise', '=', 'entreprise.id')
                    ->where('hide.bool', '=', false)
                ->select('nom', 'designation', 'ville', 'entreprise.id AS entrepriseID')
                ->paginate(5);


            return $companys2;
        }
    }

    public static function wishlist($ID_Personnel)
    {

        $wishes =  DB::table('souhaiter')
            ->join('offre', 'souhaiter.ID_Offre', '=', 'offre.ID')
            ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
            ->join('localite', 'localite.ID_Entreprise', '=', 'entreprise.ID')
            ->where('ID_Personnel', '=', $ID_Personnel)
            ->select('ID_Offre', 'ville', 'intitule', 'type_promo', 'nom', 'date_debut', 'duree_stage', 'ville', 'remuneration', 'descriptif')
            ->paginate(5);

        return view('wish', ['wishes' => $wishes]);
    }
}

