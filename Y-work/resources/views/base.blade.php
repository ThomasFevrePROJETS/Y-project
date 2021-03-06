<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <meta name="theme-color" content="#FFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('static/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/base.css') }}">
    <link @yield('css')>
    <link @yield('css2')>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <title>@yield('title')</title>
</head>

<body>
    <div class="container-fluid">
        <header class="row">
            <a id="headerlogo" class="col" href="/"><img src="{{ asset('static/images/Y.png') }}" alt="Y work">
                <p>work</p>
            </a>
            @yield('headerSearch')

            <nav class="col justify-content-end">
                <!-- Bouton de connexion modale -->
                {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#modalconnexion">
                            Connexion
                        </button> --}}
                <div>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <div class="justify-content-end">

                                {{-- @if (Route::has('login')) --}}
                                <button type="button" class="btn btn-primary"
                                    onclick="window.location.href='{{ route('login') }}';">
                                    {{ __('Se connecter') }}
                                </button>
                                {{-- @endif --}}

                                {{-- @if (Route::has('register')) --}}
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='{{ route('register') }}';">
                                    {{ __('S\'enregistrer') }}
                                </button>
                                {{-- @endif --}}
                            </div>
                        @else
                            <div class="justify-content-end">
                                {{-- <a href="/home" class=""> --}}
                                <button type="button" class="btn btn-primary"
                                    onclick="window.location.href='{{ route('home') }}';">
                                    {{ Auth::user()->lastname }}
                                </button>
                                {{-- </a> --}}

                                {{-- <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); --}}
                                {{-- document.getElementById('logout-form').submit();"> --}}
                                <button type="button" class="btn btn-secondary"
                                    onclick="event.preventDefault();
                                                                                    document.getElementById('logout-form').submit();"
                                    onclick="window.location.href='{{ route('logout') }}';">
                                    {{ __('Se d??connecter') }}
                                </button>
                                {{-- </a> --}}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest

                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <div id="subheader"></div>


    @yield('content')

    {{-- FOOTER --}}{{-- FOOTER --}}{{-- FOOTER --}}{{-- FOOTER --}}{{-- FOOTER --}}


    <footer>
        {{-- https://bbbootstrap.com/snippets/clients-brand-logo-carousel-slider-20683486 --}}
        <div class="brands">
            <div class="brands_slider_container">
                <div class="owl-carousel owl-theme brands_slider">
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_1.jpg" alt="">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_2.jpg" alt="">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_4.jpg" alt="">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_5.jpg" alt="">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_3.jpg" alt="">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_6.jpg" alt="">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_7.jpg" alt="">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="brands_item d-flex flex-column justify-content-center"><img
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_8.jpg" alt="">
                        </div>
                    </div>
                </div> <!-- Brands Slider Navigation -->
                {{-- <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div> --}}
            </div>
        </div>
        <br><br><br>
        <p class="h5">Y work INC.</p>
        <a href="/">Retour ?? la page d'accueil</a>
        <div class="footerlinklist">
            <section>
                <p class="h5">Compte</p>
                <ul class="footerregister">
                    <a href="/login">se connecter</a>
                    <a href="/inscription">s'enregistrer</a>
                    <a href="/ChangeInfo">modifer mes informations</a>
                </ul>
            </section>
            <section>
                <p class="h5">Offres</p>
                <ul class="footeroffer">
                    <a href="/offres">parcourir les offres</a>
                    <a href="/offres">cr??er une offre</a>
                </ul>
            </section>
            <section>
                <p class="h5">D??couvrir les entreprises</p>
                <ul class="footercompany">
                    <a href="/entreprise">parcourir les entreprises</a>
                    <a href="/entreprise"> cr??er une entreprise</a>
                </ul>
            </section>
            <section>
                <p class="h5">Notre r??seau</p>
                <ul class="footeraccount">
                    <a href="/reseau">parcourir le r??seau</a>
                    <a href="/inscription">cr??er un compte</a>
                </ul>
            </section>
        </div>
        <section class="medias">
            <p class="h5">Retrouvez-nous sur les r??seaux sociaux</p>
            <ul class="medialist">
                <i class="fab fa-linkedin"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-github"></i>
                <i class="fab fa-youtube"></i>
            </ul>
        </section>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcvg">
            Conditions g??n??rales d'utilisation
        </button>
        <div class="modal fade" id="modalcvg" tabindex="" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" id="exampleModalLabel">Conditions g??n??rales d'utilisation</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <pre>
                            Information concernant l'utilisation des cookies
                            Cette politique d???utilisation des cookies et autres traceurs s???applique ?? l???ensemble des
                            sites Internet ??dit??s par les soci??t??s du groupe Y-work.

                            Les sites du Groupe Y-work utilisent des cookies pour des raisons vari??es.

                            Ils permettent notamment au Groupe Y-work de comprendre comment les utilisateurs
                            naviguent sur nos sites, et d???obtenir des donn??es ?? partir desquelles nous pourrons
                            am??liorer l???exp??rience de navigation ?? l???avenir, de vous adresser des offres personnalis??es,
                            de vous identifier lorsque vous acc??dez ?? votre compte client, de garder des articles dans
                            votre panier d???achat apr??s d??connexion, mais aussi de financer indirectement les services
                            gratuits que nous vous proposons et qui vous sont fournis par nos diff??rents sites.

                            Cette page permet de comprendre ce qu???est un Cookie, ?? quoi il sert et comment le
                            param??trer.

                            1. QU???EST-CE QU???UN COOKIE ?
                            Un cookie (ci-apr??s le(s) "Cookie(s) ") est un fichier texte d??pos?? par les serveurs des
                            sites web consult??s ou par des serveurs tiers, dans un espace d??di?? du disque dur de votre
                            terminal (ordinateur, tablette, t??l??phone mobile ou tout autre appareil optimis?? pour
                            Internet), lors de la consultation d???un contenu ou d???une publicit?? en ligne. Il enregistre
                            des informations relatives ?? votre navigation sur internet.

                            Ce fichier Cookie ne peut ??tre lu que par son ??metteur ?? qui il permet, pendant sa dur??e de
                            validit??, de reconna??tre le terminal concern?? ?? chaque fois que ce terminal acc??de ?? un
                            contenu num??rique comportant des Cookies dudit ??metteur. Le Cookie ne vous identifie pas
                            personnellement, mais uniquement le navigateur de votre terminal.

                            La vid??o du jour :

                            Lors de votre connexion sur nos sites, une banni??re s???affiche. Sous r??serve de votre choix,
                            des Cookies seront stock??s dans la m??moire de votre ordinateur, smartphone, tablette, mobile
                            etc. Les informations ainsi collect??es peuvent ??tre utilis??es par le site consult??s ou par
                            un tiers, telle qu???une r??gie publicitaire, ou tout autre partenaire.

                            La dur??e de validit?? du cookie est de 13 (treize) mois maximum ?? compter du jour o?? vous
                            avez donn?? votre consentement ?? l???int??gration dudit cookie.

                            Vous avez cependant la possibilit?? de les effacer de votre terminal ?? tout moment.

                            Il existe plusieurs types de Cookies et diff??rents moyens de s???y opposer (voir point 2).

                            Vous avez la possibilit?? de refuser l???enregistrement des Cookies sur votre appareil et vous
                            pouvez le faire ?? tout moment via votre logiciel de navigation, selon la proc??dure d??crite
                            au point 3 du pr??sent document.

                            Cependant, le refus de certains Cookies peut causer la d??gradation d???un certain nombre de
                            fonctionnalit??s n??cessaires ?? la navigation sur le Site Internet (difficult??s
                            d???enregistrement ou d???affichage, etc.). Nous ne saurions, en pareil cas, ??tre responsables
                            de ces dysfonctionnements.

                            Par ailleurs, d??sactiver les Cookies de publicit?? ne signifie pas que vous ne recevrez pas
                            de publicit?? mais simplement que celle-ci ne sera plus adapt??e ?? vos int??r??ts.

                            Attention, la prise en compte de vos diff??rents souhaits repose sur un Cookie ou plusieurs
                            Cookies d??termin??s. Si vous supprimez tous les Cookies enregistr??s au sein de votre terminal
                            concernant notre site, nous ne saurons plus quel consentement ou quel refus vous avez ??mis.
                            Cela reviendra donc ?? r??initialiser votre consentement et vous devrez donc ?? nouveau refuser
                            le ou les Cookies que vous ne souhaitez pas conserver. De m??me, si vous utilisez un autre
                            navigateur Internet, vous devrez ?? nouveau refuser ces Cookies car vos choix, comme les
                            cookies auxquels ils se rapportent, d??pendent du navigateur et du terminal (ordinateur,
                            tablette, smartphone, etc.) que vous utilisez pour consulter notre site.

                            2. ?? QUOI SERVENT LES COOKIES QUE NOUS UTILISONS ?
                            Afin de vous permettre de prendre la mesure de l???utilit?? que repr??sente pour vous tel ou tel
                            cookie, une pr??sentation des diff??rents types de cookies suit.

                            Les cookies strictement n??cessaires

                            Ces cookies sont indispensables afin de naviguer sur le site et profiter de ses
                            fonctionnalit??s, telles que l'acc??s aux zones s??curis??es du site Web. Les services
                            sollicit??s, comme par exemple des formulaires de concours, ne pourraient pas ??tre fournis
                            sans les cookies.

                            Cookies de performance

                            Ces cookies recueillent des informations sur la fa??on dont les visiteurs utilisent un site
                            Web. Par exemple, les pages les plus visit??es et si des messages d'erreur sont ??mis. Les
                            cookies ne recueillent pas de donn??es permettant d???identifier les visiteurs. Dans la mesure
                            o?? toutes les informations recueillies par ces cookies sont rassembl??es, elles demeurent
                            anonymes. Ces cookies sont uniquement destin??s ?? am??liorer le fonctionnement du site Web.

                            Ces Cookies permettent de mesurer le trafic ou l???audience, associ?? ?? notre site internet,
                            aux pages visit??es et aux interactions r??alis??es sur le Site lors de votre visite. Les
                            d??sactiver emp??che donc toute collecte d???informations relatives ?? votre navigation sur notre
                            Site et donc la proposition de contenus ??ditoriaux adapt??s en fonction de votre navigation.

                            Cookies de fonctionnalit??s

                            Ces cookies permettent au site de m??moriser les choix que vous avez effectu??s (comme votre
                            nom d'utilisateur, la langue choisie ou la r??gion o?? vous vous trouvez) et fournir des
                            caract??ristiques plus pr??cises et personnelles. Ces cookies peuvent aussi ??tre utilis??s pour
                            m??moriser les modifications apport??es par l'utilisateur, comme la taille du texte ou la
                            police de caract??res. Ils peuvent ??galement servir pour fournir des services que vous avez
                            sollicit??s, comme regarder une vid??o ou laisser un commentaire sur un blog. Les informations
                            collect??es par ces cookies peuvent ??tre rendues anonymes et ne peuvent pas suivre votre
                            activit?? de navigation sur d'autres sites.
                        </pre>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- FOOTER --}}{{-- FOOTER --}}{{-- FOOTER --}}{{-- FOOTER --}}{{-- FOOTER --}}


    <!------------------------------MODAUX-------------------------------------->
    <!--Modal de connexion-->
    <div class="modal fade" id="modalconnexion" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="Connexion" id="Connexion">Connexion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <form action="/action_page.php" method="POST">
                        <div class="login row">
                            <div class="col">
                                <label for="name">Nom d'utilisateur </label>
                                <input type="text" id="user_name" name="user_name">
                            </div>
                            <div class="col">
                                <label for="mdp">Mot de passe </label>
                                <input type="password" id="mdp" name="mdp">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center col">
                    <button type="button" class="buttonlogin">Se connecter</button>
                </div>

                <!-- Button modal Inscription -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" role="dialog"
                    data-bs-target="#modalinscription" data-bs-dismiss="#modalconnexion">
                    Vous n'avez pas de compte ? Inscrivez-vous i??i.
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modalinscription" tabindex="-1" aria-labelledby="modalinscription"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalinscription">Inscription</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('register') }}" autocomplete="on">
                                    @csrf
                                    <div class="formulaire">

                                        <div id="selectionstatut" class="row justify-content-center">
                                            <div class="col">
                                                <input type="radio" value="??tudiant" name="statut" id="statut" required>
                                                <label for="??tudiant">??tudiant</label><br>
                                            </div>
                                            <div class="col">
                                                <input type="radio" value="D??l??gu??" name="statut" id="statut" required>
                                                <label for="D??l??gu??">D??l??gu??</label><br>
                                            </div>
                                            <div class="col">
                                                <input type="radio" value="Pilote" name="statut" id="statut" required>
                                                <label for="Pilote">Pilote</label><br>
                                            </div>
                                        </div>

                                        <label for="email">Email <i>(Votre identifiant de connexion)</i></label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            required><br><br>

                                        <label for="password">Mot de passe</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <br><br>

                                        <label for="password_confirmation">Confirmation Mot de passe</label>
                                        <input type="password" name="password_confirmation" id="password"
                                            class="form-control" required><br><br>

                                        <label for="name">Nom</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <br><br>

                                        <label for="fname">Pr??nom</label>
                                        <input type="text" name="fname" id="fname" class="form-control"
                                            required><br><br>

                                        <label for="centre">Centre</label>
                                        <input type="text" name="centre" id="centre" class="form-control"
                                            required><br><br>

                                        <label for="promotion">Promotion</label>
                                        <select name="promotion" id="promotion" placeholder="Choisir promotion"
                                            required>
                                            <option value=""></option>
                                            <option value="A1">A1</option>
                                            <option value="A2">A2</option>
                                            <option value="A3">A3</option>
                                            <option value="A4">A4</option>
                                            <option value="A5">A5</option>
                                        </select><br><br>

                                        <label for="mineure">Mineure </label>
                                        <select name="mineure" id="mineure" placeholder="Choisir promotion" required>
                                            <option value=""></option>
                                            <option value="INFO">Informatique</option>
                                            <option value="GN">G??n??raliste</option>
                                            <option value="S3E">S3E</option>
                                            <option value="BTP">BTP</option>
                                        </select>

                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                                        <button type="submit" id="buttonincription" class="btn">S'inscire</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!------------------------------------------------------------------------->


<script src="{{ asset('static/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://kit.fontawesome.com/2f326c2d90.js" crossorigin="anonymous"></script>
<script src="{{ asset('static/JQuery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('static/base.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<script src="{{ asset('ServiceWorker.js') }}"></script>
@yield('script')

</html>
