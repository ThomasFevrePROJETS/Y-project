<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Droits extends Controller
{
    public static function assignation($statut)
    {

            $resultat = DB::table('users')
                ->join('qualifier', 'qualifier.ID_Personnel', '=', 'users.id')
                ->join('statut', 'statut.ID', '=', 'qualifier.ID_Statut')
                ->where('designation', '=', $statut)
                ->select('users.id')
                ->get();

            return $resultat;
    }

    public static function Getpilote($statut){
        $pilotes = Droits::assignation($statut);
        $answer = false ;
        if(auth()->guest()){return $answer; }
        else{
            foreach($pilotes as $pilote){

                if($pilote->id == auth()->user()->id){
                    $answer = true;
                }
            }
            return $answer;
        }
    }
}
