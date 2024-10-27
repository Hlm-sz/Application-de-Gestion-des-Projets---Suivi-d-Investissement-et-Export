
    //$('#compte_canal').hide();
    //$('#compte_canal_opt_n1').hide();
    //$('#compte_canal_opt_n2').hide();


    //function()
    {
        //if ( source.includes("/comptes") ){
            const canal_S1 = document.querySelector('#compte_canal_aux');
            const canal_S2 = document.querySelector('#compte_canal_opt_n1_aux');
            const canal_S3 = document.querySelector('#compte_canal_opt_n2_aux');
            canal_S1.value = (document.querySelector('#compte_canal')).innerHTML;
            if ( canal_S1.value != 16 )
            {
                if ( /*($('#compte_canal_opt_n1').prop( "value")).isInteger() &&*/ $('#compte_canal_opt_n1').prop( "value") > 0 ) {
                    canal_S2.value = $('#compte_canal_opt_n1').prop( "value") ;
                }
                    
            }
            else
            {
                canal_S2.value = (document.querySelector('#compte_canal_opt_n1')).innerHTML;
            }
            

            if ( '' == (document.querySelector('#compte_canal_opt_n2')).innerHTML )
            {
                $("#divcanal_opt_n2_aux").hide();
            }
            else
            {
                canal_S3.value = (document.querySelector('#compte_canal_opt_n2')).innerHTML;
            } 
            $('#compte_canal').hide();// show : 
            // $("#compte_canal_aux").prop( "disabled", true );// show : 
            $("#compte_canal_aux").change( function()
            {
                $("#compte_canal").prop( "value", this.value );
                /*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*/
                let form = document.getElementById('form_compte'); 
                //let data = "{" this.name + "=" + this.value + ",compte[canal_opt_n1_aux]=1 }";
                let data = this.name + "=" + this.value + "&compte[fetch]=1";
                /*$  --- FETCH --- --- 1 ---  $*/
                fetch( 
                    form.action, 
                    {
                        method: form.getAttribute("method") ,
                        body: data,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset:UTF-8' }
                    }
                )
                .then( response => response.text()  ) 
                .then( 
                    html =>  
                    {
                        let content = document.createElement( 'html' );
                        content.innerHTML = html;
                        let nouveauSelect = content.querySelector( '#compte_canal_opt_n1_aux' );
                        document.querySelector('#compte_canal_opt_n1_aux').replaceWith( nouveauSelect );
                    }
                )
                .then(
                    () =>
                    {
                        const canal_info_field = document.querySelector('#compte_canal_opt_n1_aux');
                        
                        if ( canal_S1.value == 15 ) // Case for events 
                            $("#divcanal_opt_n2_aux").show();
                        else
                        {
                            $("#divcanal_opt_n2_aux").hide(); // show :
                            document.querySelector('#compte_canal_opt_n2').innerHTML = '';
console.log('supprim');
                        }
                            

                        canal_info_field.addEventListener( 
                            'change',
                            function() {
                                //alert('change event');
                                //$("#compte_canal_aux").prop( "disabled", true ); 
                                
                                let form = document.getElementById('form_compte'); 
                                let data = this.name + "=" + this.value + "&compte[fetch]=1" + "&compte[canal_aux]=" + document.querySelector('#compte_canal_aux').value;

                                //if (canal_info_field.value.isInteger() && canal_info_field.value > 0 )
                                    document.querySelector('#compte_canal_opt_n1').value = canal_info_field.value ;
                                
                                if ( canal_S1.value == 15 ) /* Case for events */
                                {
                                    $("#divcanal_opt_n2_aux").show();
                                    /*$  --- FETCH --- --- 2 ---  $ */
                                    fetch( 
                                        form.action, 
                                        {
                                            method: form.getAttribute("method") ,
                                            body: data,
                                            headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset:UTF-8' }
                                        }
                                    )
                                    .then( response => response.text()  )
                                    .then( 
                                        html => {
                                            let content = document.createElement( 'html' );
                                            content.innerHTML = html;
                                            let nouveauSelect = content.querySelector( '#compte_canal_opt_n2_aux' );
                                            document.querySelector('#compte_canal_opt_n2_aux').replaceWith( nouveauSelect );
                                        } 
                                    ) 
                                    .then( 
                                        () => {
                                            const canal_evt_field = document.querySelector('#compte_canal_opt_n2_aux');
                                            
                                            canal_evt_field.addEventListener( 
                                                'change',
                                                function() {
                                                    document.querySelector('#compte_canal_opt_n2').value = canal_evt_field.value ;
                                                }
                                            )
                                            ;
                                            /* CHANGE */
                                    } )
                                    .catch(error => {
                                            console.log(error)
                                        }
                                    );
                                }
                            }
                        )
                        document.querySelector('#compte_canal').value = this.value ;
                    }
                )
                .catch(error => {
                        console.log(error)
                    }
                );
                //alert('my() ends');
                /*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*//*-*-*-*/
            });
            $('#compte_canal_opt_n1').hide(); // show : 
            // $("#compte_canal_opt_n1_aux").prop( "disabled", true ); // show : 
            $("#compte_canal_opt_n1_aux").change( function(){
                //alert('changement bbb');
                if ( canal_S1.value == 15 ) /* Case for events */
                {
                    $("#divcanal_opt_n2_aux").show();
                }
                
                document.querySelector('#compte_canal_opt_n1').value = this.value ;

                let form = document.getElementById('form_compte'); 
                let data = this.name + "=" + this.value + "&compte[fetch]=1" + "&compte[canal_aux]=" + document.querySelector('#compte_canal_aux').value;
                //fetch
                fetch( 
                    form.action, 
                    {
                        method: form.getAttribute("method") ,
                        body: data,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset:UTF-8' }
                    }
                )
                .then( response => response.text()  )
                .then( 
                    html => {
                        let content = document.createElement( 'html' );
                        content.innerHTML = html;
                        let nouveauSelect = content.querySelector( '#compte_canal_opt_n2_aux' );
                        document.querySelector('#compte_canal_opt_n2_aux').replaceWith( nouveauSelect );
                    } 
                ) 
                .then( 
                    () => {
                        const canal_evt_field = document.querySelector('#compte_canal_opt_n2_aux');
                        canal_evt_field.addEventListener( 
                            'change',
                            function() {

                                document.querySelector('#compte_canal_opt_n2').value = canal_evt_field.value ;
                            }
                        )
                        ;
                        /* CHANGE */
                        } )
                .catch(error => {
                    console.log(error)
                    }
                );
            });
            $('#compte_canal_opt_n2').hide(); // show : 
            // $("#compte_canal_opt_n2_aux").prop( "disabled", true ); // show : 
            $("#compte_canal_opt_n2_aux").change( function(){
                document.querySelector('#compte_canal_opt_n2').value = this.value ;
            });
    }