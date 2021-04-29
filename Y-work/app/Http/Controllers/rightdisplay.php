<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class rightdisplay extends Controller
{
    public static function offres()
    {
        $ID = request("item");
        $Newrequete = DB::table('offre')
        ->join('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
        ->join('localite', 'localite.ID_Entreprise', 'entreprise.ID')
        ->leftjoin('requerir', 'offre.ID', '=', 'requerir.ID_Offre')
        ->leftjoin('competence', 'competence.ID', '=', 'requerir.ID_Competence')
        ->select('intitule','nom','descriptif', 'type_promo','duree_stage', 'remuneration', 'date_debut','nb_places', 'ville', 'competence.designation as comp')
        ->where('offre.ID', '=', $ID)
        ->get();

        return $Newrequete;
    }

    public static function account()
    {
        $ID = request("item");
        $transfer = DB::table('users')
        ->join('assigner', 'users.id', '=', 'assigner.ID_Personnel')
        ->join('promo', 'assigner.ID_Promo', '=', 'promo.ID')
        ->leftJoin('candidature', 'users.id', '=', 'candidature.ID_Personnel')
        ->leftJoin('offre', 'candidature.ID_Offre', '=', 'offre.ID')
        ->leftJoin('entreprise', 'offre.ID_Entreprise', '=', 'entreprise.ID')
        ->where('users.id', '=', $ID)
        ->select('name', 'lastname', 'centre', 'annee', 'promo.type_promo', 'entreprise.nom AS entreprise', 'offre.intitule', 'offre.descriptif', 'candidature.avancement')
        ->get();
        return $transfer;
    }

    public static function company()
    {
        $ID = request("item");
        $transfer = DB::table('entreprise')
        ->join('localite', 'entreprise.ID', '=', 'localite.ID_Entreprise')
        ->join('appartient', 'entreprise.ID', '=', 'appartient.ID_Entreprise')
        ->join('secteur', 'appartient.ID_secteur', '=', 'secteur.ID')
        ->leftjoin('offre', 'entreprise.ID', '=', 'offre.ID_Entreprise')
        ->join('hide', 'hide.ID_Entreprise', '=', 'entreprise.ID')
        ->select('nom', 'nb_stagiaires_cesi','designation', 'intitule', 'ville', 'confiance_pilote', 'entreprise.ID', 'hide.bool as hideValue')
        ->where('entreprise.ID', '=', $ID)
        ->get();

        return $transfer;
    }
}

