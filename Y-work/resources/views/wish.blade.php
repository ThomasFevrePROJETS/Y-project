@extends('subbase')

@section('subCss')
    rel="stylesheet" href="{{ asset('static/wish.css') }}"
@endsection

@section('title','Y work - Wish List')

@section('leftlist')
@php
    use App\Http\Controllers\Droits;
@endphp

@foreach ($wishes as $wish)
    <div class="LeftList" id="{{ $wish->ID_Offre }}">
        <img src="{{ asset('static/images/logoentreprise.png') }}" alt="LOGO" id="LeftListImage"
            class="img-fluid">
        <p id="Entitled">{{ $wish->intitule }} </p>
        <section id="SubInfos">
            <p> {{ 'Type de promo : ' . $wish->type_promo }} </p>
            <p> {{ 'Localité : ' . $wish->ville }} </p>
        </section>
        <div class="ToggleWish" data-toggle="false" style="display: none"></div>
        <i id="wish" class="far fa-heart"></i>
    </div>
@endforeach
<p id="pagination" style="display:none">test :{{ $companys->links() }}</p>
@endsection

@section('rightnavbar')
<a href="#">Parcourir nos offres</a>
@endsection

@section('detailedinfos')
    @guest
        <h2 style="text-align: center; color: RED; style: bold; font-weight: bold;" <br>
            Vous ne pouvez pas voir votre liste de souhaits si vous n'êtes pas connecté.
            <br>
        </h2>
    @else
        @if (!isset($wish))
            <h2 style="text-align: center; color: RED; style: bold; font-weight: bold;">
                <br>
                Bonjour {{ Auth::user()->lastname }},
                <br>
                vous n'avez enregistré aucun souhaits dans votre liste.
                <br>
            </h2>
        @else
            <div id="MoreInformations">
                <div id="smallDescri" class="row">
                    <div class="col">
                        <h3 id="entitled">{{$wishes[0]->intitule}}</h3><br>
                        <p id="companyname">{{$wishes[0]->nom}}</p>
                        <p id="promo_type">{{$wishes[0]->type_promo}}</p>
                    </div>
                    <div class="col">
                        <p id="startdate">{{$wishes[0]->date_debut}}</p>
                        <p id="duration">{{$wishes[0]->duree_stage}}</p><br>
                        <p id="salary">{{$wishes[0]->remuneration}}</p>
                        <p id="city">{{$wishes[0]->ville}}</p>
                    </div>
                </div>
                <div class="centerBut">
                    @guest
                    @else

                        @if(Droits::Getpilote("Pilote"))
                            <button name="update" id="update" data-bs-toggle="modal" data-bs-target="#modalupdateoffers">Modifier</button>
                            <button type="submit" name="delete" id="delete" data-bs-toggle="modal" data-bs-target="#modaldeleteoffers">Supprimer</button>
                        @endif
                    @endguest
                </div>
                <div id="largeDescri">
                    <textarea rows="10" maxlength="1024" id="w" disabled>Description : {{$wishes[0]->descriptif}}</textarea>
                </div>
                <div class="centerBut">
                    @guest
                        <a href="/register"><button name="applyerror" id="applyerror"
                                data-hover="Veuillez vous connecter pour postuler."
                                data-active="Postuler"><span>Postuler</span></button></a>
                    @else
                        <button name="apply" id="apply" data-bs-target="#modalapply" data-bs-toggle="modal">Postuler</button>
                    @endguest
                </div>
            </div>
        @endif
    @endguest

     {{-- L'ID USER --}}
    @guest
    @else
        <input class="applyuser" type="text" style="display: none" value="{{ Auth::user()->id }}" name="applyuser" disabled>
    @endguest
@endsection

@section('Subscript')
    <script src="{{ asset('static/offres.js') }}"></script>
@endsection
