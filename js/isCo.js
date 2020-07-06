isCo();
function isCo(){

    let option = {
        url: 'http://localhost/AEN/api/session/isCo.php',
        dataType: 'text',
        type: "POST",
        success: function(data, status, xhr){
            $('#header').html(xhr.responseText);
        },
        error: function(xhr, status, error){;
            $('#header').html(xhr.responseText);
        }
    };

    $.ajax(option);
}

function deco() {
    let option = {
        url: 'http://localhost/AEN/api/session/deco.php',
        dataType: 'text',
        type: "POST",
        success: function (data, status, xhr) {
        },
        error: function (xhr, status, error) {

        }
    };

    $.ajax(option);
}

