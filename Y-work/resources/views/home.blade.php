@extends('base')

@section('css')
    rel="stylesheet" href="{{ asset('static/home.css') }}"
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <br>
                <div class="grid-container">
                    <div class="WELCOME-MESSAGE">
                        <h4 class="text-center">Bonjour et bienvenue sur votre compte <b>{{ Auth::user()->lastname }}</b>.
                            Vous
                            êtes
                            l'utilisateur n°{{ Auth::user()->id }}</h4>
                        <br>
                    </div>
                    <div class="FORM-SPACE">
                        <form method="POST" action="{{ route('ChangeInfo') }}">
                            @csrf

                            <?php
                            $NumberQualifier = DB::table('qualifier')
                            ->select('ID_Statut')
                            ->where('ID_Personnel', '=', Auth::user()->id)
                            ->value('ID_Statut');

                            $NameStatut = DB::table('statut')
                            ->select('designation')
                            ->where('ID', '=', $NumberQualifier)
                            ->value('designation');
                            ?>

                            <div id="selectionstatut" class="row justify-content-center">
                                <div class="col">
                                    <input type="radio" value="Étudiant" name="statut" id="statut" <?php if
                                        ($NameStatut=='Étudiant' ) { echo 'checked' ; }?>>
                                    <label for="Étudiant">Étudiant</label><br>
                                </div>
                                <div class="col">
                                    <input type="radio" value="Délégué" name="statut" id="statut" <?php if
                                        ($NameStatut=='Délégué' ) { echo 'checked' ; }?>>
                                    <label for="Délégué">Délégué</label><br>
                                </div>
                                <div class="col">
                                    <input type="radio" value="Pilote" name="statut" id="statut" <?php if
                                        ($NameStatut=='Pilote' ) { echo 'checked' ; }?>>
                                    <label for="Pilote">Pilote</label><br>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ Auth::user()->email }}" required autocomplete="email"><br>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="★★★★★★★★★★" disabled><br>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="display:none;">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ Auth::user()->name }}" required autocomplete="name"><br>
                                </div>
                            </div>

                            <div class="form-group row" style="display:none;">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">Prénom</label>

                                <div class="col-md-6">
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ Auth::user()->lastname }}" placeholder="Prénom"><br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="centre" class="col-md-4 col-form-label text-md-right">Centre</label>
                                <div class="col-md-6">
                                    <input type="text" name="centre" id="centre" class="form-control"
                                        value="{{ Auth::user()->centre }}" placeholder="Centre" required><br>
                                </div>
                            </div>

                            <?php
                            $Assigner = DB::table('assigner')
                            ->select('ID_Promo')
                            ->where('ID_Personnel', '=', Auth::user()->id)
                            ->get();
                            print_r('<p>Mineur et année renseignée(s):<br>');
                                foreach ($Assigner as $key => $Number) {
                                print_r(' - ');
                                $TypePromo = DB::table('promo')
                                ->select('type_promo')
                                ->where('ID', '=', $Number->ID_Promo)
                                ->value('type_promo');
                                $AnneePromo = DB::table('promo')
                                ->select('annee')
                                ->where('ID', '=', $Number->ID_Promo)
                                ->value('annee');
                                print_r($TypePromo . ' ' . $AnneePromo);
                                }
                                print_r(' -</p>');
                            ?>

                            <div class="form-group row">
                                <label for="mineure" class="col-md-4 col-form-label text-md-right">Mineure </label>

                                <div class="col-md-6">
                                    <select name="mineure" id="mineure" placeholder="Choisir promotion" required>
                                        <option value=""></option>
                                        <option value="INFO">Informatique</option>
                                        <option value="GN">Généraliste</option>
                                        <option value="S3E">S3E</option>
                                        <option value="BTP">BTP</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <div class="row">
                                    <div class="col" id="mamineure">
                                        <input type="checkbox" value="A1" id="A1" name="A1">
                                        <label for="A1" class="col-md-4 col-form-label text-md-right">A1</label>
                                    </div>
                                    <div class="col" id="mamineure">
                                        <input type="checkbox" value="A2" id="A2" name="A2">
                                        <label for="A2" class="col-md-4 col-form-label text-md-right">A2</label>
                                    </div>
                                    <div class="col" id="mamineure">
                                        <input type="checkbox" value="A3" id="A3" name="A3">
                                        <label for="A3" class="col-md-4 col-form-label text-md-right">A3</label>
                                    </div>
                                    <div class="col" id="mamineure">
                                        <input type="checkbox" value="A4" id="A4" name="A4">
                                        <label for="A4" class="col-md-4 col-form-label text-md-right">A4</label>
                                    </div>
                                    <div class="col" id="mamineure">
                                        <input type="checkbox" value="A5" id="A5" name="A5">
                                        <label for="A5" class="col-md-4 col-form-label text-md-right">A5</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn" id="complete">
                                        Compléter mes informations
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
