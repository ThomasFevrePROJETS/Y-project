$(function () {

    var TheID="";
    var url = window.location.href;

     //---------------AFFICHAGE EN FONCTION DE L 'URL-------------------
    if (url.match((/^.*entreprise$/))) {
        TheID = $('.LeftList').attr('id');
        LeftToRight(1);
        // console.log("3");
    }


    //---------------QUAND ON CLQIUE A GAUCHE-------------------
    $('.LeftList').click(function (e) {

        TheID = $(this).attr('id');

        //---AJOUT DE L'ID DANS LES MODAUX --
        $("#ID_Company_rate").val(TheID);
        $("#ID_Company_update").val(TheID);
        $("#ID_Company_delete").val(TheID);

        //----APPEL DE LA FONCTION POUR AFFICHER A DROITE (EN BAS)--
        LeftToRight(TheID);
    });

    //---------------WISH LIST-------------------
    $('.LeftList').hover(function (e) {

        // var TheID = $(this).attr('id');
        $(".ID_Company").val(TheID);

        $('#wish').click(function (e) {

            $(this).removeClass("far");
            $(this).addClass("fas");
            $(this).css("color", "red");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/wishlist/add",
                data: {offre: TheID},

            });

        });
    });

    //---------------HIDE -------------------
    $('#hidecompany').click(function (e) {

        // $("h2").toggle();
        // alert('Entreprise cachée !');
        $.ajax({
            type: "GET",
            url: "/company/hide?item="+TheID,
            success: function (response) {
                // console.log("hide reussi");
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                console.log(thrownError);
            }
        });
    });
  //---------------FONCTION AJAX AFFICHER A DROITE -------------------
    function LeftToRight(ID)    {
        $.ajax({
            url: "/entreprise/getRightItem?item="+TheID,
            type: "GET",

            success: function(response, textStatus, xhr)
            {

                if( xhr.status == 200 )
                {
                        // console.log("get reussi");
                        // console.log(TheID);
                        // console.log(response);

                        response.forEach(element => {
                            //---------------RIGHT -------------------
                            $("#nom").text("Entreprise : "+element.nom ) ;
                            $("#nbstagiaire").text("Nombre de stagiaires CESI : "+element.nb_stagiaires_cesi ) ;
                            $("#secteuractivite").text("Secteur : "+element.designation ) ;
                            $("#confiance_pilote").text("Confiance pilote : "+element.confiance_pilote ) ;
                            $("#localite").text(element.ville);
                            $("#idDeLentreprisePourDelete").val(+element.ID);
                            if(element.hideValue === 1){
                                $("#hidecompany").text("Show");
                            }else {$("#hidecompany").text("Hide");}

                            if(element.intitule === 'null'){
                            }
                            else{
                                $("#offrerecente").text("Offre récente : "+element.intitule) ;
                            }

                            //---------------MODAL MODIFIER-------------------
                            $("#update_companyname").attr("placeholder",element.nom);
                            $("#update_nb_stagiaire").attr("placeholder",element.nb_stagiaires_cesi ) ;
                            $("#update_sector").attr("placeholder",element.designation ) ;
                            $("#update_trustpilot").attr("placeholder",element.confiance_pilote ) ;
                            $("#update_location").attr("placeholder",element.ville);
                            $("#ID_Company_update").attr("placeholder",element.ID);

                            $("#update_companyname").attr("value",element.nom);
                            $("#update_nb_stagiaire").attr("value",element.nb_stagiaires_cesi ) ;
                            $("#update_sector").attr("value",element.designation ) ;
                            $("#update_trustpilot").attr("value",element.confiance_pilote ) ;
                            $("#update_location").attr("value",element.ville);
                            $("#ID_Company_update").attr("value",element.ID);

                        });

                } else       {
                    console.log("get PAS reussi");
                }
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                console.log(thrownError);
            }
        });
    }

    $(".LeftListContainer").on("scroll", function() {

        var scrollPosition = $(".LeftListContainer").height() + $(".LeftListContainer").scrollTop();
        if (scrollPosition >= 686.3185905761719) {
            console.log("wesh");
        }
    });

});
