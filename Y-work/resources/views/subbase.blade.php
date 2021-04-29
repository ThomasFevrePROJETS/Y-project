@extends('base')

@section('css')
rel="stylesheet" href="{{ asset('static/subbase.css') }}"
@endsection

@section('css2')
    @yield('subCss')
@endsection

@section('title','Y work -  CESI')

@section('headerSearch')
<form class="col-8" method="GET">
    <div class="headerinput">
        <i class="fas fa-search"></i>
        <input type="text" placeholder=@yield('placeholder') name="input1" class="input1">
    </div>
    <div class="headerinput">
        <i class="fas fa-map-marker-alt"></i>
        <input type="text" placeholder="ex: San Francisco" name="input2" class="input2">
    </div>
    <input class="StatutQuick" type="text" value="" name="statut" style="display: none">
    <button type="submit" class="ButtonQuickSearch">
        <p class="rechercher">RECHERCHER</p>
        <div class="buttonarrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </button>
</form>
@endsection

@section('content')
<main>
    <section class="LeftListContainer">

        @yield('leftlist')

    </section>

    <div id="right">
        <nav>
            @yield('rightnavbar')
        </nav>
        <section id="detailedinfos">
            @yield('detailedinfos')
        </section>
    </div>
</main>
@endsection

@section('script')
    @yield('Subscript')
@endsection
