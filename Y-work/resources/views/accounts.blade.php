@extends('subbase')

@section('subCss')
rel="stylesheet" href="{{ asset('static/accounts.css') }}"
@endsection

@section('placeholder', 'ex:Delage')

@section('rightnavbar')
    @php
        use App\Http\Controllers\Droits;
    @endphp

    <a href="{{ route('register') }}" id="createaccount">Completer mon compte</a>

    @if(Droits::Getpilote("Pilote"))
        <div id="otherlinks">
            <button class="Space">espace pilotes</button>
            <button class="Space">espace délégués</a>
            <button class="Space">espace étudiants</button>
        </div>
    @endif
@endsection

@section('leftlist')

@php
    use App\Http\Controllers\leftlist;
    $accounts = leftlist::accounts();

    use App\Http\Controllers\quicksearch;
    $autrechoses = quicksearch::accounts();
    $queue="";
@endphp
@guest
@else
    @if(Droits::Getpilote("Pilote"))

        @if (!isset($autrechoses))

            @foreach ($accounts as $account)

                <div class="LeftList" id="{{$account->id}}">
                    <img src="{{ asset('static/images/NoPortrait.png') }}" alt="LOGO" id="LeftListImage" class="img-fluid">
                    <p id="Title"> {{$account->name.' '.$account->lastname}} </p>
                    <section id="SubInfos">
                        <p> {{'Centre : '.$account->centre}} </p>
                        <p> {{'Promo : '.$account->annee.' '.$account->type_promo }} </p>
                    </section>
                </div>

            @endforeach

        @else
            @foreach ($autrechoses as $autrechose)

                @if ($queue == $autrechose->name.$autrechose->lastname.$autrechose->centre)
                @else
                <div class="LeftList" id="{{$autrechose->id}}">
                    <img src="{{ asset('static/images/NoPortrait.png') }}" alt="LOGO" id="LeftListImage" class="img-fluid">
                    <p id="Title"> {{$autrechose->name.' '.$autrechose->lastname}} </p>
                    <section id="SubInfos" name="{{$queue == $autrechose->name.$autrechose->lastname.$autrechose->centre}}">
                        <p> {{'Centre : '.$autrechose->centre}} </p>
                    </section>
                </div>
                @endif

            @endforeach
        @endif
    @else
        @foreach ($accounts as $account)
            @if($account->id == auth()->user()->id)
                <div class="LeftList" id="{{$account->id}}">
                    <img src="{{ asset('static/images/NoPortrait.png') }}" alt="LOGO" id="LeftListImage" class="img-fluid">
                    <p id="Title"> {{$account->name.' '.$account->lastname}} </p>
                    <section id="SubInfos">
                        <p> {{'Centre : '.$account->centre}} </p>
                        <p> {{'Promo : '.$account->annee.' '.$account->type_promo }} </p>
                    </section>
                </div>
            @endif

        @endforeach
    @endif

@endguest
@endsection

@section('detailedinfos')
<div id="TopInfos">
    <img src="{{ asset('static/images/NoPortrait.png') }}" alt="PHOTO" id="LeftListImage">
    <p id="TheName"> {{ $accounts[0]->lastname.' '.$accounts[0]->name }} </p>
    <div id="otherinfos">
        <p id="Centre">{{'Centre : '.$accounts[0]->centre}}</p>
        <p id="Promo">{{'Promotion : '.$accounts[0]->annee.' '.$accounts[0]->type_promo }}</p>
    </div>
</div>
<div id="centerBut" >
    <button name="update" id="update">Modifier</button>
    <button name="delete" id="delete" data-bs-toggle="modal" data-bs-target="#modaldeleteuser">Supprimer</button>
</div>
<section class="ApplyFollowUps">
    <div class="ApplyFollowUp">
        <h5 class="entitled">Offre exemple</h5>
        <p class="company">Entreprise : Intel</p>
        <p class="step">Step : ?</p>
        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem similique voluptates dolore. Commodi, excepturi, officia animi dolorum accusamus optio at mollitia soluta ea magnam qui? Modi necessitatibus quae tempore porro.</p>
    </div>
</section>

<!------MODAL SUPPRIMER COMPTE--------->
<div class="modal fade" id="modaldeleteuser" tabindex="-1" aria-labelledby="modaldeleteuser" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalinscription">WARNING</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>êtes-vous sûr(e) de vouloir supprimer ce compte ?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <form action="{{ route('deleteaccount') }}" method="POST">
                    @csrf
                    <input class="AccountDelete" name="AccountDelete" value="" style="display: none">
                    <button type="submit" id="buttondelete" class="btn">CONFIRMER</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('Subscript')
    <script src="{{ asset('static/account.js') }}"></script>
@endsection
