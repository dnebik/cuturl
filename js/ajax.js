$('button').on('click', function (){
    let url = $('#url').val();

    $.ajax({
        type: "GET",
        data: 'url=' + url,
        url: 'actions/generateUrl.php',
        success: function (res) {
            $('.url').html(res)
        },
        error: function () {
            alert("ERROR");
        }

    })
});