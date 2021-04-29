@extends('base')

@section('css')
    rel="stylesheet" href="{{ asset('static/index.css') }}"
@endsection
@section('title', 'Y work | Accueil')



@section('content')

    <main>

        <h1 class="display-3">Prenez rendez-vous avec l'avenir</h1>
        <form method="GET" action="/offres/index/OffersQuick">
            <div class="maininputs">
                <div class="maininput">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="ex: INFO" name="input1" class="input1">
                </div>
                <div class="maininput">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" placeholder="ex: San Francisco" name="input2" class="input2">
                </div>
                <div class="maininput">
                    <i class="fas fa-hourglass-start"></i>
                    <input type="text" placeholder="ex: 10 (semaines)" name="input3" class="input3">
                </div>
            </div>
            <button type="submit">
                <p class="rechercher">RECHERCHER </p>
                <div class="buttonarrow">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </button>
        </form>
    </main>


    <div class="container-fluid">
        <nav id="mainnavbar" class="row">
            @guest
                <a href="{{ route('wish', ['id' => "0" ]) }}" class="col-3">Ma liste de souhaits</a>
            @else
                <a href="{{ route('wish', ['id' => Auth::user()->id ]) }}" class="col-3">Ma liste de souhaits</a>
            @endguest
            <a href="{{ route('accounts') }}" class="col-3">Notre réseau</a>
            <a href="/offres" class="col-3">Découvrir nos offres</a>
            <a href="entreprise" class="col-3">Découvrir les entreprises</a>
        </nav>
    </div>

    @php
    use App\Http\Controllers\leftlist;
    $offres = leftlist::offres();
    @endphp

    <section id="recentoffers">
        @foreach ($offres as $offre)
            <div class="recentoffer" id="{{$offre->OffreID}}">
                <div id="recentofferleft">
                    <img src="{{ asset('static/images/fake.png') }}" alt="LOGO" id="companylogo" class="img-fluid">
                    <p id="companyname">{{ $offre->nom }}</p>
                    <p id="entitled">Intitulé : {{ $offre->intitule }}</p>
                </div>
                <p id="description">Description : {{ $offre->descriptif }}</p>
            </div>
        @endforeach
    </section>

@endsection

@section('script')
    <script src="{{ asset('static/index.js') }}"></script>
@endsection
