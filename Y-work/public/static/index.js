$(function () {

    $('.recentoffer').click(function (e) {

        //  console.log($(this).attr('id'));

        // $("#NoInformationChoosen").hide();
        // $("#MoreInformations").show();
        // window.alert("Bonjour !");

        var TheID = $(this).attr('id');
        window.location.replace("/index/getRightItem?item=" + TheID);

    });
});
