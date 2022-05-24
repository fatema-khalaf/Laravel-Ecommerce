// new idea video 452
jQuery(document).ready(function() {
    const site_url = 'http://127.0.0.1:8000/';
    $('body').on('keyup','#search',function(){
        let text = $('#search').val();
        if(text.length > 0){
            $.ajax({
                data: {search: text},
                url: site_url + 'search-items',
                method: 'post',
                beforSend: function(request){
                    return request.setReusetHeader('X-CSRF-Token',("meta[name='csrf-token']"));
                },
                success:function(result){
                    $('#searchProducts').html(result);
                }
    
            })
        }
        if(text.length < 1)$('#searchProducts').html('');// empty the old results

    })
})