// ============= Ajax Live Search Engine  ==============
$(document).ready(function () { 
    $('#search-box').on('keyup',function () { 
        let val = $(this).val();
        $.ajax({
            url:"include/ajax.php",
            type:"POST",
            data:{query:val},
            success:function(data){
                $('#ajax').slideDown().html(data);
                $('#ajax li').on('click',function(){
                    var click = $(this).attr('title');
                    $('#search-box').val(click);
                    $('#ajax').slideUp();
                });
            }

        });
    });
});