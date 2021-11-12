$(document).ready(function(){
    $('.quick-view-btn').on('click',function(){
        let id = $(this).children().data('id');
        // $('#view-btn').attr('onclick','addToCart('+id+')');
        $.ajax({
            url:"include/ajax.php",
            type:"POST",
            data:{operation: 'view', id:id},
            success:function(data){
                let arr = $.parseJSON(data);
                let img="",thumb="";
                for(var i=0;i<5;i++){
                    if(arr[i]!=undefined){ 
                        $('#img-'+i+'').attr('src','admin/uploads/'+ arr[i] +'');    
                        $('#img-thumb-'+i+'').attr('src','admin/uploads/'+ arr[i] +'');
                    }
                }
                let title = arr['title'].substring(0,60);
                let price = '<span class="new-price new-price-2">$'+ arr['price'] +'</span>';
                let des = '<p> <span> '+arr['description'].substring(0,300)+' </span> </p>';
                $('#view-thumbs').html(thumb);
                $('#view-title').html(title);
                $('#view-price').html(price);
                $('#view-des').html(des);
                
            }
        });
    });
});