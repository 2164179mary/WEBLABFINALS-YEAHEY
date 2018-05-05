var success = true;
/*$("form#sign").on('submit', function() {
    $data = $('input:checked');
    data
    $.post($("form#sign").attr("action"), $("form#sign :input"));
    return false;
});*/

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

    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(response){
            var form = document.getElementById("divForm");
            form.style.display = "none";

            var result = document.getElementById("result");
            result.innerHTML = response;
        }
    });

    return false;
});
