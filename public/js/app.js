jQuery(document).ready(function($){
    $(document).on('click', '.parent-ajax > ul > li', function(e){
        e.preventDefault();
        var source = $(this).data('source');
        $(this).addClass('item-active');
        $(this).siblings().removeClass('item-active');

        $.post(source, function(content){
            $('#item-details-wrapper').html(content);
        })
        .always(
            function() {
                if ( source.includes("/comptes") ){
                    const canal_S1 = document.querySelector('#compte_canal_aux'); 
                    const canal_S2 = document.querySelector('#compte_canal_opt_n1_aux'); 
                    const canal_S3 = document.querySelector('#compte_canal_opt_n2_aux'); 
                    canal_S1.value = (document.querySelector('#compte_canal')).innerHTML;
                    canal_S2.value = (document.querySelector('#compte_canal_opt_n1')).innerHTML;

                    if ( '' == (document.querySelector('#compte_canal_opt_n2')).innerHTML )
                    {
                        $("#divcanal_opt_n2_aux").hide();
                    }
                    else
                    {
                        canal_S3.value = (document.querySelector('#compte_canal_opt_n2')).innerHTML;
                    }
                    
                    $('#compte_canal').hide();
                    $("#compte_canal_aux").prop( "disabled", true ); 
                    $('#compte_canal_opt_n1').hide();
                    $("#compte_canal_opt_n1_aux").prop( "disabled", true ); 
                    $('#compte_canal_opt_n2').hide();
                    $("#compte_canal_opt_n2_aux").prop( "disabled", true ); 
                }
            }
        )
        ;
        
    })
})