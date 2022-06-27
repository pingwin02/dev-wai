$(document).ready(function () {
    $('#search').keyup(function (){
        var tytul = $('#search').val();
        $.ajax({
            type: "POST",
            url: "search",
            data: {'q' : tytul},
            success:function(data) {  
                $('#result').html(data);  
            }  
    });
});
});