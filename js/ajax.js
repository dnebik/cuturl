$('button').on('click', function (){
    let url = $('#url').val();
    console.log(url);

    $.ajax({
        type: "POST",
        dataType: 'string',
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