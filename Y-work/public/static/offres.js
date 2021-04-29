$(function () {

    var TheID = "";
    var url = window.location.href;

    //---------------AFFICHAGE EN FONCTION DE L 'URL-------------------
    if (url.match((/^.*Quick.*$/))) {
        TheID = $('.LeftList').attr('id');
        LeftToRight(TheID);
        // console.log("2");

    }else if(url.match((/^.*index.*$/))) {

        var url = window.location.href;
        // console.log(url);
        // console.log(TheID[1]);
        TheID = url.split("item=");
        LeftToRight(TheID[1]);
    }

    else if (url.match((/^.*offres$/))) {
        TheID = $('.LeftList').attr('id');
        LeftToRight(1);
        // console.log("3");
    }

    //---------------QUAND ON CLIQUE A GAUCHE-------------------
    $('.LeftList').click(function (e) {

        $("#apply").prop("disabled", false);

        TheID = $(this).attr('id');
        var TheKey = $(this).attr('name');
        // console.log(TheKey);
        $("#ZeKey").text('Offre N°' + TheKey);
        $(".applyoffer").val(TheID);
        LeftToRight(TheID);

    });

    function LeftToRight(ID) {
        $.ajax({
            url: "/offres/getRightItem?item=" + ID, type: "GET",

            success: function (response, textStatus, xhr) {

                if (xhr.status == 200) {
                    // console.log("get reussi");
                    // console.log(TheID);
                    // console.log(response);

                    response.forEach(element => {
                        //---------------RIGHT -------------------
                        $("#companyname").text("Entreprise : " + element.nom);
                        $("#promotype").text("Type de promotion recherchée : " + element.type_promo);
                        $("#startdate").text("Date de début : " + element.date_debut);
                        $("#duration").text("Durée du stage : " + element.duree_stage + " semaines");
                        $("#salary").text("Gratification : " + element.remuneration + " €/h");
                        $("#entitled").text("Sujet : " + element.intitule);
                        $("#w").text("Description : "+ element.descriptif);
                        $("#city").text("Localité : " + element.ville);

                        //---------------MODAL MODIFIER-------------------
                        $("#companynom").attr("placeholder",element.nom);
                        $("#ptholder").text(element.type_promo);
                        $("#date_debut").attr("placeholder", element.date_debut);
                        $("#duree").attr("placeholder", element.duree_stage);
                        $("#gratifi").attr("placeholder", element.remuneration);
                        $("#offer_titre").attr("placeholder", element.intitule);
                        $("#descriptif").attr("placeholder", element.descriptif);
                        $("#lieu").attr("placeholder",element.ville);
                        $("#nombre_places").attr("placeholder", element.nb_places)
                        $("#competences").attr("placeholder", element.comp)

                        $("#companynom").attr("value",element.nom);
                        $("#date_debut").attr("value", element.date_debut);
                        $("#duree").attr("value", element.duree_stage);
                        $("#gratifi").attr("value", element.remuneration);
                        $("#offer_titre").attr("value", element.intitule);
                        $("#descriptif").text(element.descriptif);
                        $("#lieu").attr("value",element.ville);
                        $("#nombre_places").attr("value", element.nb_places);
                        $("#competences").attr("value", element.comp);
                        $("#idoffre").attr("value", TheID);

                    });

                } else {
                    console.log("get PAS reussi");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }
        });
    }

    // ---------------------------------------WISHLIST----------------------------------------------------------------------------

    var OfferID = 0;

    $('.LeftList').on("mouseover", function (e) {

        OfferID = $(this).attr('id');
    });

    $('#wish').on("click", function (e) {

        var toggle = $(".ToggleWish").data("toggle");
        UserID = $('.applyuser').val();

        switch (toggle) {
            case false:

                $(this).removeClass("far");
                $(this).addClass("fas");
                $(this).css("color", "red");
                $(this).animate({
                    fontSize: "1.05em"
                    }, 300
                );

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/wishlist/add",
                    dataType: "JSON",
                    data: {
                        offre: OfferID,
                        user: UserID
                    },

                });
                $(".ToggleWish").data("toggle", true);
                break;

            case true:

                $(this).removeClass("fas");
                $(this).addClass("far");
                $(this).css("color", "black");
                $(this).animate({
                    fontSize: "1em"
                    }, 300
                );

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/wishlist/delete",
                    dataType: "JSON",
                    data: {
                        offre: OfferID,
                        user: UserID
                    },

                });
                $(".ToggleWish").data("toggle", false);
                break;
        }


    });

// --------------------------------------- DELETE ----------------------------------------------------------------------------

    $('#buttondelete').click(function (e) {
        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/offres/delete",
            dataType: "JSON",
            data: {
                IDuser: TheID
            }

        });

    });
});
