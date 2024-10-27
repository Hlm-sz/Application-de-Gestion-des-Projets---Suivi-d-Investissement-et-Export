jQuery(document).ready(function($){
    $(document).on('click', '.parent-ajax > ul > li', function(e){
        e.preventDefault();
        var source = $(this).data('source');
        $(this).addClass('item-active');
        $(this).siblings().removeClass('item-active');

        $.post(source, function(content){
            $('#item-details-wrapper').html(content);
        });
        
    })
})