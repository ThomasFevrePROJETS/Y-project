@extends('subbase')

@section('rightnavbar')
<a href="createcompany" data-bs-toggle="modal" data-bs-target="#modalcreatecompany">Créer une entreprise</a>
@endsection

@section('subCss')
rel="stylesheet" href="{{ asset('static/entreprise.css') }}"
@endsection

@section('placeholder', 'ex:TESLA')

@section('leftlist')

    @php
        use App\Http\Controllers\Droits;
        use App\Http\Controllers\leftlist;
        $companys = leftlist::companys();

        use App\Http\Controllers\quicksearch;
        $autrechoses = quicksearch::companys();
    @endphp
    @if (!isset($autrechoses))
        @foreach ($companys as $company)

            <div class="LeftList" id="{{$company->entrepriseID}}">
                <img src="{{ asset('static/images/poire.jpg') }}" alt="LOGO" id="LeftListImage" class="img-fluid">
                <p id="Title"> {{$company->nom}} </p>
                <section id="SubInfos">
                    <p> {{'Secteur(s) : '.$company->designation}} </p>
                    <p> {{'Localité : '.$company->ville}} </p>
                </section>
            </div>

        @endforeach
    @else
        @foreach ($autrechoses as $autrechose)

            <div class="LeftList" id="{{$autrechose->entrepriseID}}">
                <img src="{{ asset('static/images/poire.jpg') }}" alt="LOGO" id="LeftListImage" class="img-fluid">
                <p id="Title"> {{$autrechose->nom}} </p>
                <section id="SubInfos">
                    <p> {{'Secteur(s) : '.$autrechose->designation}} </p>
                    <p> {{'Localité : '.$autrechose->ville}} </p>
                </section>
            </div>

        @endforeach
    @endif
    <p id="pagination" style="display:none">test :{{ $companys->links() }}</p>

@endsection

@section('detailedinfos')
    <div class="grid-container">
        <div class="desciptioncompany" class="row">
            <div class="col">
                <p id="nom"></p>
                <p id="nbstagiaire"></p>
                <p id="secteuractivite"><p>
                <p id="confiance_pilote"><p>
                @guest
                @else
                    @if(Droits::Getpilote("Pilote"))
                        <button name="hidecompany" id="hidecompany">Hide</button>
                    @endif
                @endguest
            </div>
        </div>

        <div class="recentoffers" class="row">
            <div class="col">
                <h2>Offre récentes</h2><br>
                <p id="offrerecente"></p><br>
            </div>
        </div>

        <div class="location" class="row">
            <div class="col">
                <h2>Localité</h2><br>
                <p id="localite"></p>
            </div>
        </div>

        <div class="centerBut">
            <button name="graduation" id="graduation" data-bs-toggle="modal" data-bs-target="#modalratecompany">Évaluer</button>
            <button name="update" id="update" data-bs-toggle="modal" data-bs-target="#modalupdatecompany">Modifier</button>
            <button name="delete" id="delete" data-bs-toggle="modal" data-bs-target="#modaldeletecompany">Supprimer</button>
        </div>

        <div class="statistiques">
            <h2>Statistiques</h2><br><br>
        </div>
    </div>

<!------------------------MODAUX------------------------------------------>
<!------MODAL CREER ENTREPRISE--------->
    <div class="modal fade" id="modalcreatecompany" tabindex="-1" aria-labelledby="modalcreatecompany" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalinscription">Création Entreprise</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{ route('createcompany') }}" autocomplete="on">
                        @csrf
                        <div class="formulaire">

                            <label class="required" for="companyname">Nom de l'entreprise </label>
                            <input type="text" name="companyname" id="companyname" required><br><br>

                            <label class="required" for="sector">Secteur d'activité(s) </label>
                            <input type="text" name="sector" id="sector" required><br><br>

                            <label for="nb_stagiaire">Nombre de stagiaires CESI</label>
                            <input type="text" name="nb_stagiaire" id="nb_stagiaire" required><br><br>

                            <label class="required" for="location">Localité</label>
                            <input type="text" name="location" id="location" required><br><br>

                            <label for="trustpilot">Confiance du pilote</label>
                            <input type="text" name="trustpilot" id="trustpilot" required><br><br>

                            <div class="row">
                                <label class="col required">( </label><p class="col-11">champs requis )</p>
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

<!------MODAL MODIFIER ENTREPRISE--------->
    <div class="modal fade" id="modalupdatecompany" tabindex="-1" aria-labelledby="modalupdatecompany" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalinscription">Modifier Entreprise</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{ route('updatecompany') }}" autocomplete="on">
                        @csrf
                        <div class="formulaire">
                            <input id="ID_Company_update" name="ID_Company_update" value="" style="display: none">

                            <label class="required" for="companyname">Nom de l'entreprise </label>
                            <input type="text" name="update_companyname" id="update_companyname" required><br><br>

                            <label class="required" for="sector">Secteur d'activité(s) </label>
                            <input type="text" name="update_sector" id="update_sector" required><br><br>

                            <label for="nb_stagiaire">Nombre de stagiaires CESI</label>
                            <input type="text" name="update_nb_stagiaire" id="update_nb_stagiaire" required><br><br>

                            <label class="required" for="location">Localité</label>
                            <input type="text" name="update_location" id="update_location" required><br><br>

                            <label for="trustpilot">Confiance du pilote</label>
                            <input type="text" name="update_trustpilot" id="update_trustpilot" required><br><br>

                            <div class="row">
                                <label class="col required">( </label><p class="col-11">champs requis )</p>
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
<!------MODAL SUPPRIMER ENTREPRISE--------->
    <div class="modal fade" id="modaldeletecompany" tabindex="-1" aria-labelledby="modaldeletecompany" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalinscription">WARNING</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Vous êtes sur le point de supprimer une entreprise !</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form action="{{ route('deletecompany') }}" method="POST">
                        @csrf
                        <input id="ID_Company_delete" name="ID_Company_delete" value="" style="display: none">
                        <button type="submit" id="buttondelete" class="btn">OUI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



<!------MODAL EVALUER ENTREPRISE--------->
    <div class="modal fade" id="modalratecompany" tabindex="-1" aria-labelledby="modalratecompany" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalinscription">Évaluer Entreprise</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{ route('ratecompany') }}" autocomplete="on">
                        @csrf
                        <div class="formulaire row">
                            <div class="col">
                                <input id="ID_Company_rate" name="ID_Company_rate" value="" style="display: none">
                                @guest
                                @else
                                    <input id="ID_Personnel" name="ID_Personnel" value="{{ Auth::user()->id }}" style="display: none">
                                @endguest
                                <label for="gratification">Critère 1: Gratification</label>
                                <select class="form-select" id="gratification" name="gratification" aria-label="gratification" required>
                                    <option selected>Cliquez pour noter</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select><br>
                                <label for="workcondition">Critère 2: Cadre de travail</label>
                                <select class="form-select" id="workcondition" name="workcondition" aria-label="workcondition"required>
                                    <option selected>Cliquez pour noter</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select><br>
                                <label for="evolution">Critère 3: Perspectives d’évolution de l’entreprise</label>
                                <select class="form-select" id="evolution" name="evolution" aria-label="evolution"required>
                                    <option selected>Cliquez pour noter</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select><br>
                                <label for="overallimpression">Critère 4: Impression générale</label>
                                <select class="form-select" id="overallimpression" name="overallimpression" aria-label="overallimpression"required>
                                    <option selected>Cliquez pour noter</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select><br>
                            </div>
                            <div class="col">
                                <label for="comments">Commentaire</label>
                                <input type="text" name="comments_gratification" id="comments_gratification"><br><br><br>

                                <label for="comments">Commentaire</label>
                                <input type="text" name="comments_workcondition" id="comments_workcondition"><br><br><br>

                                <label for="comments">Commentaire</label>
                                <input type="text" name="comments_evolution" id="comments_evolution"><br><br><br>

                                <label for="comments">Commentaire</label>
                                <input type="text" name="comments_overallimpression" id="comments_overallimpression"><br><br><br>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" id="buttonrate" class="btn">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!------------------------------------------------------------------>


@endsection

@section('Subscript')
    <script src="{{ asset('static/entreprise.js') }}"></script>
@endsection
