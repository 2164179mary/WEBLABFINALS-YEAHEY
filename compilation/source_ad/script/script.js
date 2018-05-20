/*$("form#sign").on('submit', function)*/

$("form#sign").on('submit', function(){
    var that = $(this),
        url = that.attr('action'),
        method = that.attr('method'),
        data = {};

    that.find('input:checked').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        data[name] = value;

    });

    that.find('[type="text"]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        data[name] = value;

    });

    that.find('[type="email"]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        data[name] = value;

    });

    that.find('[name="password"]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        data[name] = value;

    });

    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(response) {
            if (response == "Username already exists") {
                var error = document.getElementById("errorUsername");
                error.style.display = "block";
            } else {
                var form = document.getElementById("divForm");
                form.style.display = "none";
                var result = document.getElementById("result");
                var p = document.createElement('p');
                p.innerHTML = response;
                result.appendChild(p);
                var a = document.createElement('a');
                var href = document.createAttribute('href');
                href.value = "index.html";
                a.setAttributeNode(href);
                a.innerHTML = "Back to home";
                result.appendChild(a);
            }
        }
    });

    return false;
});

$(document).ready(function() {
    $('#confirmPassword').keyup(function() {
        if($(this).val() == $('#password').val()){
            $('#ePassword').addClass('errorPassword');
        } else {
            $('#ePassword').removeClass('errorPassword');
        }
    });
});


