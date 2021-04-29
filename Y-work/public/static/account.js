// $(function () {

//     $('.ButtonQuickSearch').click(function (e) {

//         var input1 = $('.input1').val();
//         var input2 = $('.input2').val();

//         $.ajax({

//             url: "/AccountsQuick?input1="+input1+'&input2='+input2,
//             type: "GET",

//             error: function (xhr, ajaxOptions, thrownError)
//             {
//                 console.log(thrownError);
//             }
//         });
//     });
// });

$(function () {

    $('.LeftList').click(function (e) {

        var TheID = $(this).attr('id');
        var html = "";

        $('.AccountDelete').val(TheID);

        $.ajax({
            url: "/accounts/getRightItem?item="+ TheID,
            type: "GET",

            success: function(response, textStatus, xhr)
            {

                if( xhr.status == 200 )
                {
                    console.log(response);

                    response.forEach(element => {

                        $("#TheName").text(element.name + ' ' + element.lastname);
                        $("#Centre").text('Centre : ' + element.centre);
                        $("#Promo").text('Promo : ' + element.annee + ' ' + element.type_promo);

                        html += "<div class='ApplyFollowUp'>\n";
                        html += "<h5 class='entitled'>" + element.intitule + "</h5>\n";
                        html += "<p class='company'>" + element.entreprise +"</p>\n";
                        html += "<p class='step'>" + element.avancement + "</p>\n";
                        html += "<p class='description'>" + element.descriptif + "</p>\n";
                        html += "</div>\n";

                        $(".ApplyFollowUps").html(html);

                    });

                }
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                console.log(thrownError);
            }
        });

    });

    $(".Space").on("click", function () {

        var statut = "";

        if ($(this).text() == "espace pilotes") {
            var statut = "Pilote";
        }
        else if ($(this).text() == "espace délégués") {
            var statut = "Délégué";
        }
        else if ($(this).text() == "espace étudiants") {
            var statut = "Étudiant";
        }
        else {
            console.log('error');
        }

        $(".StatutQuick").val(statut);

    });
});

