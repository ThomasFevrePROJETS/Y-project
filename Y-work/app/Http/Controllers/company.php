<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class company extends Controller
{
    public function create()
    {

        DB::transaction (function() {

            $companyname = request('companyname');
            $sector = request('sector');
            $nb_stagiaire = request('nb_stagiaire');
            $location = request('location');
            $trustpilot = request('trustpilot');

            $ID_Entreprise = DB::table('entreprise')->insertGetId(
                ['nom' => $companyname, 'nb_stagiaires_cesi' => $nb_stagiaire, 'confiance_pilote' => $trustpilot],
            );

            $ID_Secteur = DB::table('secteur')->insertGetId(
                ['designation' => $sector]
            );

            DB::table('appartient')->insert([
                ['ID_Secteur' => $ID_Secteur, 'ID_Entreprise' => $ID_Entreprise],
            ]);

            DB::table('localite')->insert([
                ['ID_Entreprise' => $ID_Entreprise, 'ville' => $location],
            ]);

            DB::table('hide')->insert([
                ['ID_Entreprise' => $ID_Entreprise, 'bool' => false],
            ]);
        });

        return redirect('/entreprise');
    }

    public function delete()
    {
        DB::transaction (function() {

            $ID_Company = request('ID_Company_delete');

            // Supprimer candidature
            DB::table('candidature')
            ->join('offre', 'offre.ID', '=','candidature.ID_Offre')
            ->where('offre.ID_Entreprise', '=', $ID_Company)
            ->delete();

            //Supprimer requerir
            DB::table('requerir')
            ->join('offre', 'requerir.ID_Offre', '=', 'offre.ID')
            ->join('competence', 'requerir.ID_Competence', '=', 'competence.ID')
            ->where('offre.ID_Entreprise', '=', $ID_Company)
            ->delete();

            // Supprimer evaluation & critère
            DB::table('evaluation')
            ->join('critere', 'evaluation.ID_Critere', '=', 'critere.ID')
            ->where('evaluation.ID_Entreprise', '=', $ID_Company)
            ->delete();

            // Supprimer appartient
            DB::table('appartient')
            ->join('secteur', 'appartient.ID_Secteur', '=', 'secteur.ID')
            ->where('appartient.ID_Entreprise', '=', $ID_Company)
            ->delete();

            // Supprimer offres
            DB::table('offre')
            ->where('offre.ID_Entreprise', '=', $ID_Company)
            ->delete();

            // Supprimer localité
            DB::table('localite')
            ->where('localite.ID_Entreprise', '=', $ID_Company)
            ->delete();

            // Supprimer entreprise
            DB::table('entreprise')
            ->where('entreprise.ID', '=', $ID_Company)
            ->delete();
        });
        return redirect('/entreprise');
    }

    public function rate()
    {
        DB::transaction (function() {

            $gratification = request('gratification');
            $workcondition = request('workcondition');
            $evolution = request('evolution');
            $overallimpression = request('overallimpression');
            $comments_gratification = request('comments_gratification');
            $comments_workcondition = request('comments_workcondition');
            $comments_evolution = request('comments_evolution');
            $comments_overallimpression = request('comments_overallimpression');
            $ID_Company = request('ID_Company_rate');
            $ID_Personnel = request('ID_Personnel');

            $ID_Critere_gratification = DB::table('critere')
                ->where('designation', '=', 'gratification')
                ->value('ID');

            $ID_Critere_workcondition = DB::table('critere')
                ->where('designation', '=', 'workcondition')
                ->value('ID');

            $ID_Critere_evolution = DB::table('critere')
                ->where('designation', '=', 'evolution')
                ->value('ID');

            $ID_Critere_overallimpression = DB::table('critere')
                ->where('designation', '=', 'overallimpression')
                ->value('ID');

            DB::table('evaluation')
            ->insert([
                ['note' => $gratification, 'comments' => $comments_gratification, 'ID_Critere' => $ID_Critere_gratification, 'ID_Personnel' => $ID_Personnel, 'ID_Entreprise' => $ID_Company],
            ]);

            DB::table('evaluation')
            ->insert([
                ['note' => $workcondition, 'comments' => $comments_workcondition, 'ID_Critere' => $ID_Critere_workcondition, 'ID_Personnel' => $ID_Personnel, 'ID_Entreprise' => $ID_Company],
            ]);
            DB::table('evaluation')
            ->insert([
                ['note' => $evolution, 'comments' => $comments_evolution, 'ID_Critere' => $ID_Critere_evolution, 'ID_Personnel' => $ID_Personnel, 'ID_Entreprise' => $ID_Company],
            ]);
            DB::table('evaluation')
            ->insert([
                ['note' => $overallimpression, 'comments' => $comments_overallimpression, 'ID_Critere' => $ID_Critere_overallimpression, 'ID_Personnel' => $ID_Personnel, 'ID_Entreprise' => $ID_Company],
            ]);

        });
        return redirect('/entreprise');
    }

    public function update()
    {
        DB::transaction (function() {

             // on recupere ce que l'on a ecrit dans le modal
             $ID_Entreprise = request('ID_Company_update');
             $companyname = request('update_companyname');
             $nb_stagiaire = request('update_nb_stagiaire');
             $trustpilot = request('update_trustpilot');
             $sector = request('update_sector');
             $location = request('update_location');

             DB::table('entreprise')
             ->where('entreprise.ID', '=', $ID_Entreprise)
             ->update(['nom' => $companyname, 'nb_stagiaires_cesi' => $nb_stagiaire, 'confiance_pilote' => $trustpilot]);

             DB::table('entreprise')
                 ->join('appartient','entreprise.ID','=', 'appartient.ID_Entreprise')
                 ->join('secteur','secteur.ID','=', 'appartient.ID_Secteur')
                 ->where('entreprise.ID', '=', $ID_Entreprise)
                 ->update(['designation' => $sector]);

             DB::table('localite')
                ->where('localite.ID_Entreprise', '=', $ID_Entreprise)
                ->update(['ville' => $location]);
        });
        return redirect('/entreprise');
    }

    public function hide() {

        DB::transaction(function () {

            $ID = request("item");
            $answer=false;

            $exist= DB::table('hide')
                    ->where('ID_Entreprise', '=', $ID)
                    ->get();

            if(!isset($exist)){
                DB::table('hide')->insert([
                    ['ID_Entreprise' => $ID, 'bool' => true],
                ]);
            }
            $bool = DB::table('hide')
                    ->where('ID_Entreprise', '=', $ID)
                    ->select('hide.bool')
                    ->get();
            foreach($bool as $boule){
                if($boule->bool == true){
                    $answer = true;
                }
            }
            if($answer){
                DB::table('hide')
                    ->where('ID_Entreprise', '=', $ID)
                    ->update(['bool' => false]);
            } else {
                DB::table('hide')
                    ->where('ID_Entreprise', '=', $ID)
                    ->update(['bool' => true]);
            }
        });

    }
}
