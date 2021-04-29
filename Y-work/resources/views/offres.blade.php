@extends('subbase')

@section('subCss')
    rel="stylesheet" href="{{ asset('static/offres.css') }}"
@endsection

@section('placeholder', 'ex:INFO')

@php
   use App\Http\Controllers\Droits;
@endphp

@section('rightnavbar')
    @guest
    @else
        @if(Droits::Getpilote("Pilote"))
            <a href="createoffer" data-bs-toggle="modal" data-bs-target="#modalcreateoffer">Créer une offre</a>
        @endif
    @endguest

@endsection

@section('leftlist')

    @php
    use App\Http\Controllers\leftlist;
    $offres = leftlist::offres();

    use App\Http\Controllers\quicksearch;
    $autrechoses = quicksearch::offres();
    $counter = 1;
    @endphp

    @if (!isset($autrechoses))
        @foreach ($offres as $key => $offre)
            <div class="LeftList" id="{{ $offre->OffreID }}" name={{ $counter }}>
                <img src="{{ asset('static/images/opps.png') }}" alt="LOGO" id="LeftListImage"
                    class="img-fluid">
                <p id="Entitled">{{ $offre->intitule }} </p>
                <section id="SubInfos">
                    <p> {{ 'Secteur(s) : ' . $offre->type_promo }} </p>
                    <p> {{ 'Localité : ' . $offre->ville }} </p>
                </section>
                <div class="ToggleWish" data-toggle="false" style="display: none"></div>
                <i id="wish" class="far fa-heart"></i>
            </div>
            @php
                $counter = $counter + 1;
            @endphp


        @endforeach

    @else
        @foreach ($autrechoses as $autrechose)

            <div class="LeftList" id="{{ $autrechose->OffreID }}" name={{ $counter }}>
                <img src="{{ asset('static/images/opps.png') }}" alt="LOGO" id="LeftListImage"
                    class="img-fluid">
                <p id="Entitled">Intitulé : {{ $autrechose->intitule }} </p>
                <section id="SubInfos">
                    <p> {{ 'Secteur(s) : ' . $autrechose->type_promo }} </p>
                    <p> {{ 'Localité : ' . $autrechose->ville }} </p>
                </section>
                <div class="ToggleWish" data-toggle="false" style="display: none"></div>
                <i class="wish" class="far fa-heart"></i>
            </div>
            @php
                $counter = $counter + 1;
            @endphp

        @endforeach
    @endif
    <p id="pagination" style="display:none">test :{{ $companys->links() }}</p>

@endsection




@section('detailedinfos')
    <div id="MoreInformations">
        <div id="smallDescri" class="row">
            <div class="col">
                <h2 id="ZeKey"></h2><br>
                <h3 id="entitled"></h3><br>
                <p id="companyname"></p>
                <p id="promo_type"></p>
            </div>
            <div class="col">
                <p id="startdate"></p>
                <p id="duration"></p><br>
                <p id="salary"></p>
                <p id="city"></p>
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
            <textarea rows="10" maxlength="1024" id="w" disabled>Description</textarea>
        </div>
        <div class="centerBut">
            @guest
                <a href="/register"><button name="applyerror" id="applyerror"
                        data-hover="Veuillez vous connecter pour postuler."
                        data-active="Postuler"><span>Postuler</span></button></a>
            @else
                <button name="apply" id="apply" data-bs-target="#modalapply" data-bs-toggle="modal" disabled>Postuler</button>
            @endguest
        </div>
    </div>

    {{-- MODAL CREER UNE OFFRE --}}

    <div class="modal fade" id="modalcreateoffer" tabindex="-1" aria-labelledby="modalcreateoffer" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalinscription">Création Offre</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('createoffer') }}" autocomplete="on">
                        @csrf
                        <div class="formulaire row">
                            <div class="col">
                                <label class="required" for="companyname">Entreprise </label>
                                <input type="text" name="companyname" id="companyname" required><br><br>

                                <label class="required" for="offer_title">Intitulé </label>
                                <input type="text" name="offer_title" id="offer_title" required><br><br>

                                <label class="required" for="type_promo">Type de promotions concernées </label>
                                <select type="text" name="type_promo" id="type_promo" required><br><br>
                                    <option selected></option>
                                    <option value="INFO">INFO</option>
                                    <option value="GN">GN</option>
                                    <option value="S3E">S3E</option>
                                    <option value="BTP">BTP</option>
                                </select><br><br>

                                <label class="required" for="duration">Durée de stage (en semaines)</label>
                                <input type="text" name="duration" id="duration" required><br><br>

                                <label for="start_date">Date de début </label>
                                <input type="text" name="start_date" placeholder="ex: 2021-10-21" id="start_date"
                                    required><br><br>

                                <label for="nb_places">Nombres de places</label>
                                <input type="text" name="nb_places" id="nb_places" required><br><br>
                            </div>
                            <div class="col">
                                <label for="skill">Compétences requises </label>
                                <input type="text" name="skill" id="skill" required><br><br>

                                <label class="required" for="gratification">Gratification </label>
                                <input type="text" name="gratification" placeholder="ex: 3.80" id="gratification"
                                    required><br><br>

                                <label for="description">Description </label>
                                <textarea type="input" maxlength="1000 name="description" id="description"
                                    required></textarea><br><br>
                            </div>
                            <div class="row">
                                <label class="col required">( </label>
                                <p class="col-11">champs requis )</p>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                            <button type="submit" id="buttoncreate" class="btn">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL MODIFIER UNE OFFRE --}}

    <div class="modal fade" id="modalupdateoffers" tabindex="-1" aria-labelledby="modalupdateoffers" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaledit">Modification Offre</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('updateOffers') }}" autocomplete="on">
                        @csrf
                        <div class="formulaire row">
                            <div class="col">
                                <input type="text" name="idoffre" id="idoffre" value="" disbaled style="display:none;">
                                <label class="required" for="companynom">Entreprise </label>
                                <input type="text" name="companynom" id="companynom" required disabled><br><br>

                                <label class="required" for="offer_titre">Intitulé </label>
                                <input type="text" name="offer_titre" id="offer_titre" required><br><br>

                                <label class="required" for="type_promotion">Type de promotions concernées </label>
                                <select type="text" name="type_promotion" id="type_promotion" required><br><br>
                                    <option id="ptholder" value=""></option>
                                    <option value="INFO">INFO</option>
                                    <option value="GN">GN</option>
                                    <option value="S3E">S3E</option>
                                    <option value="BTP">BTP</option>
                                </select><br><br>


                                <label class="required" for="duree">Durée de stage (en semaines)</label>
                                <input type="text" name="duree" id="duree" required><br><br>

                                <label for="date_debut">Date de début </label>
                                <input type="text" name="date_debut" placeholder="ex: 2021-10-21" id="date_debut"
                                    required><br><br>

                                <label for="nombre_places">Nombres de places</label>
                                <input type="text" name="nombre_places" id="nombre_places" required><br><br>
                            </div>
                            <div class="col">
                                <label for="competences">Compétences requises </label>
                                <input type="text" name="competences" id="competences" required><br><br>

                                <label class="required" for="gratifi">Gratification </label>
                                <input type="text" name="gratifi" placeholder="ex: 3.80" id="gratifi"
                                    required><br><br>

                                <label for="descriptif">Description </label>
                                <textarea rows="10" type="input" maxlength="1024" name="descriptif" id="descriptif"
                                    required></textarea><br><br>
                            </div>
                            <div class="row">
                                <label class="col required">( </label>
                                <p class="col-11">champs requis )</p>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" id="buttonupdate" class="btn">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL POSTULER À UNE OFFRE --}}

    <div class="modal fade" id="modalapply" tabindex="-1" aria-labelledby="modalapply" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Postuler</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="applyform" enctype="multipart/form-data" action="{{ route('apply') }}"
                        autocomplete="on">
                        @csrf
                        <div class="applygrid">
                            <div class="CV">
                                <label for="CV">Curriculum Vitae</label>
                                <input type="file" placeholder="choisir un fichier" name="CV" id="CV" required>
                            </div>
                            <div class="LM">
                                <label for="LM">Lettre de Motivation</label>
                                <input type="file" placeholder="choisir un fichier" name="LM" id="LM">
                            </div>
                            <div class="msg">
                                <label for="msg">Message</label>
                                <textarea type="input" maxlength="1024" name="msg" id="msg" rows="7"></textarea>
                            </div>
                        </div>
                        <input class="applyoffer" type="text" style="display: none" value="" name="applyoffer">
                        @guest
                        @else
                            <input class="applyuser" type="text" style="display: none" value="{{ Auth::user()->id }}" name="applyuser">
                        @endguest
                        <div class="modal-footer justify-content-center">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                            <button type="submit" id="buttonapply" class="btn">SOUMETTRE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!------MODAL SUPPRIMER OFFRE--------->
    <div class="modal fade" id="modaldeleteoffers" tabindex="-1" aria-labelledby="modaldeleteoffers" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalinscription">WARNING</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Vous êtes sur le point de supprimer une offre !</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form>
                        @csrf
                        {{-- <input id="idDeLentreprisePourDelete" name="idDeLentreprisePourDelete" value=""> --}}
                        <button type="submit" id="buttondelete" class="btn">OUI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Subscript')
    <script src="{{ asset('static/offres.js') }}"></script>
@endsection
