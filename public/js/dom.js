
document.onreadystatechange = function () {

  if (document.readyState === "interactive") {
    //document.body.innerHTML = document.getElementById("ul_o").getElementsByTagName("li").length ;
   // a = document.getElementById("random-color").length ;
    //d = document.getElementsByClassName('random-color').style.backgoundColor = " blue"
   // document.getElementsByTagName("li").style.color ="blue"
    //alert(a)
    /* const setBg = () => { */
     /*  a = document.getElementsByTagName("li");
     b = document.getElementById("random-color"); */
     c = document.getElementsByClassName('random-color')
     /*  alert(a.length)
      alert(b.length) */
      /* alert(Object.values(c)) */

      //Object.values(c).map(el => el.style.backgroundColor = "#" + Math.floor(Math.random()*16777215).toString(16));


     // c.color.innerHTML = "#" + randomColor;
   /*  }
    setBg(); */
  }
  //l'emplacement des blocks
  if ($(window).width() <= 770){
    //Compte
  $( ".info-compte" ).after( $( ".autre-info-compte" ) );
  $( ".autre-info-compte" ).after( $( ".activite-compte" ) );
  //projet
  $( ".info-projet" ).after( $( ".autre-info-projet" ) );
  $( ".autre-info-projet" ).after( $( ".action-projet" ) );
  //contact
  $( ".info-contact" ).after( $( ".autre-info-contact" ) );

  //abouti
  $( ".Non-Abouti" ).after( $( ".seemoreAbouti" ) );
   //scrol
   $( ".navbar-brand" ).after( $( ".btn-filtre" ) );
  }

  $(".menuMobile button.nav-toggle").click(function(){
    if($('#navbarSupportedContent').hasClass('show')){
      $(this).closest('.menuMobile ').removeClass('d-fixed');
      $('.btn-filtre').css('display','block');
      $('.scroltop').css('display','block');
    }else{
      $(this).closest('.menuMobile ').addClass('d-fixed');
      $('.btn-filtre').css('display','none');
      $('.scroltop').css('display','none');
    }
  });
}

$("#data_projet_Confidentiel,#data_projet_Prioritaire").css("display","none");
$("#projet_data_Confidentiel,#projet_data_Prioritaire").css("display","none");


function openInfo(evt, infoName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("info-displayed");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("linkInfo");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(infoName).style.display = "block";
    evt.currentTarget.className += " active";
  }

function openInteret(evt, infoName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("infophases");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("linkInteret");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(infoName).style.display = "block";
    evt.currentTarget.className += " active";
  }


  $(document).ready(function(){
    $(".button").click(function(){
      $(".modal-mobile").fadeIn();
      $("body").css("overflow", "hidden");
    });
    $(".cross").click(function(){
      $(".modal").fadeOut();
      $("body").css("overflow", "auto");
    });
  });

  $('.nav-toggle').on('click', function (e) {
    e.preventDefault();
    $(this).toggleClass('nav-toggle--active');
  });


  $(document).ready(function(){
    $('.btn-filtre').click(function(){
      $('.sidebare-filter').toggle();
    });
  });


/*scrol to top*/
jQuery("button.scroltop").on('click', function() {
  jQuery("html, body").animate({scrollTop: 0}, 1000);
  return false;
});



if( window.location.pathname == '/projets/dashbord'){

jQuery("li.scroll-dashbord").on('click', function() {
  jQuery("html, body").animate({scrollTop: $('.detail-projects ').offset().top}, 'slow')
});
}





var widthWindow= jQuery(window).width()
if (widthWindow   <=1024 )
{

  /*  scrol to div */
  jQuery("li.scroll-btn").on('click', function() {
    jQuery("html, body").animate({scrollTop: $('.body-container').offset().top}, 'slow')
});
jQuery("li.scroll-dashbord").on('click', function() {
  jQuery("html, body").animate({scrollTop: $('.detail-projects ').offset().top}, 'slow')
});
}



/*
function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var c = 0; c < 6; c++) {
    color += letters[Math.floor(Math.random() * 16)];
  }

  return color;
}


_li= document.getElementsByTagName("li");
  for (var i = 0; i < _li.length ; i++) {
    document.getElementsByTagName("li").style.backgroundColor = color;
  }

   */


 // $(".random-color").css("background-color", getRandomColor());


/* $(document).ready(function() {
    $(".title-btn").click(function() {
        $("#info-primaire .tab-content").hide();
        $($(this).attr("href")).show();
    });
});
$(document).on("click",".title-btn", function () {
    var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id
    //alert('you clicked on button #' + clickedBtnID);
    $(".title-btn").removeClass("active");
    $("#info .tab-content").hide();
    $(this).addClass("active");

 }); */

/** Abdou updates */

// try {
//   var table = $('#data-table').DataTable();

//    table.on( 'init.dt', function () {
//     $('#data-table_info').parent().parent().addClass('pagination_details');

//   } );

// }
// catch(err) {
//   console.log(err.message);
// }


/** new user submit vbtn */
function confirmModal(btnId,formId){
    $('#'+btnId).click(function(e){
      var $this = this;
      e.preventDefault();
      //show the popup
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn custom-btn btn-btn-blue',
          cancelButton: 'btn custom-btn btn-btn-cancel'
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: 'Etes-vous sûr de vouloir supprimer?',
        showCloseButton: false,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:'Ok',
        cancelButtonText:'Annuler'


        }).then((result) => {
          if (result.isConfirmed) {
            $('#'+formId).submit();
            //Swal.fire('Done!', '', 'success')
          }
        });
  });
}
function confirmcarteModal(carteid){

    var $this = this;
    //show the popup
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn custom-btn btn-btn-blue',
        cancelButton: 'btn custom-btn btn-btn-cancel'
      },
      buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
      title: 'Etes-vous sûr de vouloir supprimer?',
      showCloseButton: false,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText:'Ok',
      cancelButtonText:'Annuler'


      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace('/contact/cartedelete/'+carteid)
          // $('#delete-carte').click();
          //Swal.fire('Done!', '', 'success')
        }
      });
}
//Compte Document
function confirmeRemoveDocModal(carteid){

  var $this = this;
  //show the popup
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn custom-btn btn-btn-blue',
      cancelButton: 'btn custom-btn btn-btn-cancel'
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: 'Etes-vous sûr de vouloir supprimer?',
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:'Ok',
    cancelButtonText:'Annuler'


    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace('/comptes/doccompte/'+carteid)
        // $('#delete-carte').click();
        //Swal.fire('Done!', '', 'success')
      }
    });
}
// Projets Docs
function confirmeRemProjet(carteid){

  var $this = this;
  //show the popup
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn custom-btn btn-btn-blue',
      cancelButton: 'btn custom-btn btn-btn-cancel'
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: 'Etes-vous sûr de vouloir supprimer?',
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:'Ok',
    cancelButtonText:'Annuler'


    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace('/projets/docprojet/'+carteid)
        // $('#delete-carte').click();
        //Swal.fire('Done!', '', 'success')
      }
    });
}
// Event //
function confirmEventModalTrash(eventid){

  var $this = this;
  //show the popup
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn custom-btn btn-btn-blue',
      cancelButton: 'btn custom-btn btn-btn-cancel'
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: 'Etes-vous sûr de vouloir supprimer?',
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:'Ok',
    cancelButtonText:'Annuler'


    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace('/events/deleteeven/'+eventid)
        // $('#delete-carte').click();
        //Swal.fire('Done!', '', 'success')
      }
    });
}

//is input changed
// function isChanged(formId){
//   var $form = $('#'+formId);
//   origForm = $form.serialize();
//    $('#'+formId+' :input').on('change input', function() {
//     if(!$('$btn_submit').hasClass('data-changed')){
//        $('$btn_submit').addClass($form.serialize() !== origForm ? 'data-changed':'');
//     }
//     if($('$btn_submit').hasClass('data-changed')){
//        $('$btn_submit').removeClass($form.serialize() === origForm ? 'data-changed':'');
//     }
//   })
// }
function addCompteCard(response){
  var html = '';

    $html = `<div class="ecard">
                <span class="remove-account" data-id="${response.id}">
                    <i class="fa fa-trash"></i>
                </span>
                <div class="firstinfo"><img src="/uploads/${response.logo}">
                <div class="profileinfo">
                    <h1>${response.name}</h1>
                    <h3>
                    ${response.secteurs}
                    </h3>

                </div>
                </div>
            </div>`;

  return html;
}
$(document).ready(function (){
 //get the current route
  var activeRoute = $('.header-navbar a.active').text();
  if(activeRoute !== ''){

    if ($(".current-page-user")[0]){
      $('.current-page-user').text(activeRoute);
    }else{
      $('.current-page').text(activeRoute);
    }
  }
  if($('.navbar-text-color').text() !== "" ){

    if ($(".current-page-user")[0]){
      $('.current-page-user').text($('.navbar-text-color').text());
    }else{
      $('.current-page').text($('.navbar-text-color').text());
    }
  }

  //add required icon *
  //required field
  if($('#projets_Denomination_projet')){
    $('#projets_Denomination_projet').attr("required","required");
    $("label[for='projets_Denomination_projet']").addClass('required');
  }
  if($('#projet_data_Denomination_projet')){
    $('#projet_data_Denomination_projet').attr("required","required");
    $("label[for='projet_data_Denomination_projet']").addClass('required');
  }
  $('.form-group label.required').each(function( ) {
    var labelValue = $(this).text();
    $(this).html(labelValue+' <span class="req-icon">*</span>');
  });

  //remove-btn prevent
  confirmModal('delete-item','delete-form');

  //remove empty labels
  $('.form-check-label').each(function(){
    var val = $(this).text();
    if(val === ""){
      $(this).parent().parent().hide();
    }
  });
  //edit project
  $('.page_projets_detail #btn_submit').click(function(e){
    e.preventDefault;
    $('#form_projet').submit();
  });
   //add event

   $("page_event_new #btn_submit").click(function (){
    $('#form_event').submit();
  });
   
  //edit event
  $("page_event_edit #btn_submit").click(function (){
    $('#form_event').submit();
  });
  
  //if data changed
  // isChanged('form_projet');
  // isChanged('form_compte');
  // isChanged('form_contact');
  // isChanged('form_partenaire');
  // isChanged('form_event');

  //type of project
  if ($('input#projet_data_Prioritaire').is(':checked')) {
    $('#projet-prioritaire-btn').addClass('active');
  }
  if ($('input#projet_data_Confidentiel').is(':checked')) {
    $('#projet-confidentiel-btn').addClass('active');
  }
  $('input#projet_data_Prioritaire').change(function() {
    if(this.checked) {
      $('#projet-prioritaire-btn').addClass('active');
    }else{
      $('#projet-prioritaire-btn').removeClass('active');
    }
  });

  $('input#projet_data_Confidentiel').change(function() {
    if(this.checked) {
      $('#projet-confidentiel-btn').addClass('active');
    }else{
      $('#projet-confidentiel-btn').removeClass('active');
    }
  });
  //confidential btn clicked
  //confidential btn clicked
  $('#projet-confidentiel-btn').click(function(e){
    e.preventDefault();
    $('$btn_submit').addClass('data-changed');
    if($(this).hasClass('active')){
      $("input#projet_data_Confidentiel").prop("checked", false);
      $(this).removeClass('active');
    }else{
      $("input#projet_data_Confidentiel").prop("checked", true);
      $(this).addClass('active');
    }
  });
  //confidential btn clicked
  $('#projet-prioritaire-btn').click(function(e){
    e.preventDefault();
    $('$btn_submit').addClass('data-changed');
    if($(this).hasClass('active')){
      $("input#projet_data_Prioritaire").prop("checked", false);
      $(this).removeClass('active');
    }else{
      $("input#projet_data_Prioritaire").prop("checked", true);
      $(this).addClass('active');
    }
  });
  //compte type
  var currentOption = $("#compte_data_type").children("option:selected").text().trim();
  if(currentOption !== ""){
    $('.GPAC-compte li a').removeClass('active');
    if(currentOption === "Investisseur") $('.GPAC-compte li#inv-btn a').addClass('active');
      if(currentOption === "Exportateur") $('.GPAC-compte li#exp-btn a').addClass('active');
      if(currentOption === "DO") $('.GPAC-compte li#do-btn a').addClass('active');
      if(currentOption === "Partenaire") $('.GPAC-compte li#p-btn a').addClass('active');
  }
  $('#compte_data_type').change(function(){
    $('$btn_submit').addClass('data-changed');
    var currentOption = $(this).children("option:selected").text().trim();
    if(currentOption !== ""){
      $('.GPAC-compte li a').removeClass('active');
      if(currentOption === "Investisseur") $('.GPAC-compte li#inv-btn a').addClass('active');
      if(currentOption === "Exportateur") $('.GPAC-compte li#exp-btn a').addClass('active');
      if(currentOption === "DO") $('.GPAC-compte li#do-btn a').addClass('active');
      if(currentOption === "Partenaire") $('.GPAC-compte li#p-btn a').addClass('active');
    }
  });

  $('.GPAC-compte li').click(function(e){
    e.preventDefault;
    $('$btn_submit').addClass('data-changed');
    var btn = $(this).attr('id');
    $('.GPAC-compte li a').removeClass('active');
    $('.GPAC-compte li#'+btn+' a').addClass('active');
    if(btn === "inv-btn") $("#compte_data_type").val('2');
    if(btn === "exp-btn") $("#compte_data_type").val('1');
    if(btn === "do-btn") $("#compte_data_type").val('3');
    if(btn === "p-btn") $("#compte_data_type").val('4');
  });
  //add a custom compte
  $(document).on('click','#add_new_compte',function(){
    $('.typeahead').typeahead('close');
  });
  //Auto complete section
  $('#comptes_autoc').on('typeahead:select', function (e, datum) {

    $('.typeahead').typeahead('val', '');
    $('#event_comptes option').each(function(){
      if($(this).text() === datum){
         var id = $(this).val();
         if(!$('#event_comptes option[value=' + id + ']').is(':selected')){
              $('#event_comptes option[value=' + id + ']').attr('selected', true);
              //call item ajax
                $.ajax({url:"/comptes/ajax_compte/"+id, success: function(result){
                  var html = `<div class="ecard">
                      <span class="remove-account" data-id="${result.id}">
                          <i class="fa fa-trash"></i>
                      </span>
                      <div class="firstinfo"><img src="/uploads/${result.logo}">
                      <div class="profileinfo">
                          <h1>${result.name}</h1>
                          <h3>
                          ${result.secteurs}
                          </h3>

                      </div>
                      </div>
                  </div>`;
                  $('#comptes-section').append(html);
                }});
                //end ajax call
         }

      }
    });
  });
  $('#comptes_autoc').on('typeahead:cursorchanged', function (e, datum) {
    console.log("cursorchanged");
    $('.typeahead').typeahead('val', '');
    $('#event_comptes option').each(function(){
      if($(this).text() === datum){
         //call item ajax
         $.ajax({url: "/comptes/ajax_compte/"+id, success: function(result){
          console.log(result);
          $('#comptes-section').html(addCompteCard(result));
        }});
         var id = $(this).val();
         $('#event_comptes option[value=' + id + ']').attr('selected', true);
      }
    });
  });
  //remove compte item
$('#event_comptes').parent().hide();
$(document).on('click','.remove-account',function(){
  var $this = this;
  var currentCompte = $(this).attr('data-id');
  $("option[value='"+currentCompte+"']:selected").removeAttr("selected");
  $($this).parent().remove();
});
  //end compte zone
  //event type
  $(document).on('change','.cform-check-input',function(){
      var selected = $(this).val();
      $('#type-event li').removeClass('active');
      $('#type-event li[data-val="'+selected+'"]').addClass('active');
  });
  //event type convert select to radio

  // $('#event_typeEvenement').each(function(i, select){
  //   var $select = $(select);

  //   $select.find('option').each(function(j, option){
  //       var $option = $(option);
  //       // Create a radio:
  //       var $radio = $('<input type="radio" class="cform-check-input"  />');
  //       // Set name and value:
  //       $radio.attr('name', $select.attr('name')).attr('value', $option.val());
  //       // Set checked if the option was selected
  //       if ($option.attr('selected')) $radio.attr('checked', 'checked');
  //       // Insert radio before select box:
  //       $select.before($radio);
  //       // Insert a label:
  //       $select.before(
  //         $("<label />").attr('for', $select.attr('name')).text($option.text()).addClass('radio-label')
  //       );

  //   });

  //   $select.remove();
  // });
});
$("#projets_Abouti").change(function() {
  if(this.checked) {
    $("#decisionmodal").modal('show');
    $(".fade:not(.show)").css({"opacity": "1"});
    $("#projets_NAbouti").prop("checked", false);
  }
});
$("#seemore").click(function() {
    $("#decisionmodal").modal('show');
    $(".fade:not(.show)").css({"opacity": "1"});
});
$("#projets_NAbouti").change(function() {
  if(this.checked) {
    $("#projets_Abouti").prop("checked", false);
  }
});
$("#projet_data_Realise").change(function() {
  if(this.checked) {
     $("#projet_data_NonRealise").prop("checked", false);
     $("#realiser").css("display", "block");
   }
  else {
    $("#realiser").css("display", "none");
  }
  
});
$("#projet_data_NonRealise").change(function() {
  if(this.checked) {
     $("#projet_data_Realise").prop("checked", false);
     $("#realiser").css("display", "none");
   }
});

$().ready(function(){
  if($('#projet_data_Realise').prop("checked") == true){
    $("#realiser").css("display", "block");
}else{
  $("#realiser").css("display", "none");
}
});


$("#projet_data_Abouti").change(function() {
  if(this.checked) {
    $("#decisionmodal").modal('show');
    $(".fade:not(.show)").css({"opacity": "1"});
    //$("#projet_data_NAbouti").prop("checked", false);
    //$("#idRaisonBloque").css("display", "none");
    $("#seemore").css("display", "flex");
  }
});
$("#projet_data_Abouti").change(function() {
  if(!this.checked) {
    //$("#projet_data_NAbouti").prop("checked", true);
    //$("#idRaisonBloque").css("display", "block");
    $("#seemore").css("display", "none");
  }
});
$("#projet_data_NAbouti").change(function() {
  if(this.checked) {
    //$("#projet_data_Abouti").prop("checked", false);
    //$("#seemore").css("display", "none");
    $("#idRaisonBloque").css("display", "block");
  }else {
    $("#idRaisonBloque").css("display", "none");
    $("#projet_data_RaisonBloque").val(null);
    $("#projet_data_ActionRequiseDebloquer").val(null);
    $("#projet_data_date_pv_cloture_nabouti").val(null);
  }
});
$("#projet_data_Aboutisou").change(function() {
  if(this.checked) {
    $("#decisionmodalsou").modal('show');
    $(".fade:not(.show)").css({"opacity": "1"});
    $("#projet_data_NAboutisou").prop("checked", false);
    $("#Motif_sou").css("display", "none");
    $("#seemore_sourcing").css("display", "flex");
    $("#seemore_sourcing02").css("display", "flex");
    $("#seemore_sourcing03").css("display", "flex");
    $("#Motif_sou").css("display", "none");

  }
});
$("#projet_data_Aboutisou").change(function() {
  if(!this.checked) {
     $("#projet_data_NAboutisou").prop("checked", true);
    $("#seemore_sourcing").css("display", "none");
    $("#seemore_sourcing02").css("display", "none");
    $("#seemore_sourcing03").css("display", "none");
    $("#Motif_sou").css("display", "block");
  }else{
    $("#Motif_sou").css("display", "none");
  }
});
$("#projet_data_NAboutisou").change(function() {
  if(this.checked) {
    $("#projet_data_Aboutisou").prop("checked", false);
    $("#seemore_sourcing").css("display", "none");
    $("#seemore_sourcing02").css("display", "none");
    $("#seemore_sourcing03").css("display", "none");
    $("#Motif_sou").css("display", "block");
  }else{
    $("#Motif_sou").css("display", "none");

  }
});
$("#seemore_sourcing").click(function() {
  $("#decisionmodalsou").modal('show');
  $(".fade:not(.show)").css({"opacity": "1"});
});
$("#projet_data_NAboutisou").change(function() {
  if(this.checked) {
    $("#projet_data_Aboutisou").prop("checked", false);
    $("#seemore_sourcing").css("display", "none");
    $("#seemore_sourcing02").css("display", "none");
    $("#seemore_sourcing03").css("display", "none");
    $("#Motif_sou").css("display", "block");
  }else{
    $("#Motif_sou").css("display", "none");

  }
});
$("#projets_Aboutisou").change(function() {
  if(this.checked) {
    $("#decisionmodalsou").modal('show');
    $(".fade:not(.show)").css({"opacity": "1"});
    $("#projets_NAboutisou").prop("checked", false);
  }
});
$("#projets_NAboutisou").change(function() {
  if(this.checked) {
    $("#projets_Aboutisou").prop("checked", false);
  }
});
$("#projet_data_date_signature_cmd").css("display", "none");
$("#projet_data_date_signature_sou").css("display", "none");
$("#pv56OR0").css("display", "none");

$("#document_CMD_sou").css("display", "none");
$("#document_CMD_souooo").css("display", "none");

$("#document_contra_sou").css("display", "none");
$("#document_pv_cloture_sou").css("display", "none");
$("#document_pv_cloture_souooo").css("display", "none");

$("#document_contra_souooo").css("display", "none");


$("#projet_data_Commandesou").change(function() {
  if(this.checked) {
    $("#projet_data_date_signature_cmd").css("display", "block");
    $("#document_CMD_sou").css("display", "block");
    $("#document_CMD_souooo").css("display", "block");

    $("#seemore_sourcing03").css("display", "flex");

  }else{
    $("#projet_data_date_signature_cmd").css("display", "none");
    $("#document_CMD_sou").css("display", "none");
    $("#document_CMD_souooo").css("display", "none");
    $("#seemore_sourcing03").css("display", "none");

  }
});
$("#projet_data_Signaturedecontrat").change(function() {
  if(this.checked) {
    $("#projet_data_date_signature_sou").css("display", "block");
    $("#document_contra_sou").css("display", "block");
    $("#document_contra_souooo").css("display", "block");

  }
});
$("#projet_data_plateformelocal").change(function() {
  if(this.checked) {
    $("#pv56OR0").css("display", "block");
    $("#document_pv_cloture_sou").css("display", "block");
    $("#document_pv_cloture_souooo").css("display", "block");

  }else{
    $("#pv56OR0").css("display", "none");
    $("#document_pv_cloture_sou").css("display", "none");
    $("#document_pv_cloture_souooo").css("display", "none");


  }
});

$("#projet_data_Commandesou").change(function() {
  if(!this.checked) {
  
    $("#projet_data_date_signature_cmd").css("display", "none");
    $("#document_CMD_sou").css("display", "none");
    $("#document_CMD_souooo").css("display", "none");

    $("#seemore_sourcing03").css("display", "none");
  }
});
$("#projet_data_Signaturedecontrat").change(function() {
  if(!this.checked) {
    $("#projet_data_date_signature_sou").css("display", "none");
    $("#document_contra_sou").css("display", "none");
    $("#document_contra_souooo").css("display", "none");

  }else{
    $("#document_contra_sou").css("display", "block");
    $("#projet_data_date_signature_sou").css("display", "block");
    $("#document_contra_souooo").css("display", "block");
  }
});
$("#Motif_expo").css("display", "none");
$("#Motif_sou").css("display", "none");



$("#projets_Commandesou").change(function() {
  if(this.checked) {
    $("#projets_Compte_exportateur").prop("disabled", false);
    $("#projets_date_decision_sou").prop("disabled", false);
    $("#projets_valeur_cmd_sou").prop("disabled", false);
    $("#projets_secteur_sou").prop("disabled", false);
    $("#projets_reference_sou").prop("disabled", false);
    $("#projets_eco_fil_sou").prop("disabled", false);
    $("#projets_produit_sou").prop("disabled", false);
  }
});
if($('#compte_EngagementPart').prop("checked") == true){
  $("#engage").css("display", "block");
}else{
  $("#engage").css("display", "none");
}
$("#compte_EngagementPart").change(function() {
  if(this.checked) {
    $("#engage").css("display", "block");
  }else{
    $("#engage").css("display", "none");
  }
});

$("#projet_data_Aboutiexpo").change(function() {
  if(this.checked) {
    $("#decisionmodalexpo").modal('show');
    $(".fade:not(.show)").css({"opacity": "1"});
    $("#projet_data_NAboutiexpo").prop("checked", false);
    $("#seemoreexpo").css("display", "flex");
    $("#seemoreexpo02").css("display", "flex");
    if($('#projet_data_Commande_expo').prop("checked") == true){
        $("#document_CMDRR").css("display", "flex");
    }
    $("#Motif_expo").css("display", "none");

  }
});
$("#projet_data_Aboutiexpo").change(function() {
  if(!this.checked) {
    $("#projet_data_NAboutiexpo").prop("checked", true);
    $("#seemoreexpo").css("display", "none");
    $("#seemoreexpo02").css("display", "none");
    $("#document_CMDRR").css("display", "none");
    $("#Motif_expo").css("display", "block");
  }
});
$("#seemoreexpo").click(function() {
  $("#decisionmodalexpo").modal('show');
  $(".fade:not(.show)").css({"opacity": "1"});
});
$("#projet_data_NAboutiexpo").change(function() {
  if(this.checked) {
    $("#projet_data_Aboutiexpo").prop("checked", false);
    $("#seemoreexpo").css("display", "none");
    $("#seemoreexpo02").css("display", "none");
    $("#document_CMDRR").css("display", "none");
    $("#Motif_expo").css("display", "block");
  }else{
    $("#Motif_expo").css("display", "none");

  }
});
$("#projets_Aboutiexpo").change(function() {
  if(this.checked) {
    $("#decisionmodalexpo").modal('show');
    $(".fade:not(.show)").css({"opacity": "1"});
    $("#projets_NAboutiexpo").prop("checked", false);
  }
});
$("#projets_NAboutiexpo").change(function() {
  if(this.checked) {
    $("#projets_Aboutiexpo").prop("checked", false);
    $("#seemoreexpo").css("display", "none");
    $("#seemoreexpo02").css("display", "none");

  }
});
$("#projet_data_date_cmd_expo").css("display", "none");
$("#projet_data_date_signature_expo").css("display", "none");
$("#projet_data_date_pvclose_expo").css("display", "none");

$("#document_CMD").css("display", "none");
$("#document_CMDRR").css("display", "none");
$("#document_CMDooo").css("display", "none");
$("#document_contra").css("display", "none");
$("#document_pv_cloture").css("display", "none");


$("#doctm").css("display", "none");
$("#projet_data_date_TM").css("display", "none");
$("#projet_data_date_signature_convention").css("display", "none");
$("#docconv").css("display", "none"); $("#docconv2").css("display", "none");
$("#docdes").css("display", "none");
$("#docpv").css("display", "none"); $("#docpv2").css("display", "none");
$("#idDateApproCRUI").css("display", "none");
$("#idDateValideCTPS").css("display", "none");
$("#idDateAjournementCTPS").css("display", "none");
$("#idDateRejetCTPS").css("display", "none");
$("#idDateMotifCTPS").css("display", "none");
$("#idAnneeStatutCA").css("display", "none");
$("#idDateApproCNI").css("display", "none");
$("#docsignmou").css("display", "none");
$("#idRaisonBloque").css("display", "none");
$("#idRaisonStandby").css("display", "none");
$("#idDateReactive").css("display", "none");
$("#idDateDeblocage").css("display", "none");
$("#realiser").css("display", "none");

$("#projet_data_Transfere_au_Ministere").change(function() {
  if(this.checked) {
    $("#doctm").css("display", "block");
    $("#projet_data_date_TM").css("display", "block"); 
  }else{
    $("#doctm").css("display", "none");
    $("#projet_data_date_TM").css("display", "none"); 
  }
});
$().ready(function(){
  if($('#projet_data_Transfere_au_Ministere').prop("checked") == true){
    $("#doctm").css("display", "block");
    $("#projet_data_date_TM").css("display", "block"); 

}else{
  $("#doctm").css("display", "none");
  $("#projet_data_date_TM").css("display", "none");
}
});
$("#projet_data_Convention").change(function() {
  if(this.checked) {
    $("#docconv").css("display", "block");
    $("#docconv2").css("display", "block");
    $("#projet_data_date_signature_convention").css("display", "block"); 
   }else{
    $("#docconv").css("display", "none");
    $("#docconv2").css("display", "none");
    $("#projet_data_date_signature_convention").css("display", "none");
   }
});
$().ready(function(){
  if($('#projet_data_Convention').prop("checked") == true){
    $("#docconv").css("display", "block");
    $("#docconv2").css("display", "block");
    $("#projet_data_date_signature_convention").css("display", "block");
}else{
  $("#docconv").css("display", "none");
  $("#docconv2").css("display", "none");
  $("#projet_data_date_signature_convention").css("display", "none");
}
});
$("#projet_data_Autre_document").change(function() {
  if(this.checked) {
    $("#docdes").css("display", "block");
  }else{
    $("#docdes").css("display", "none");
  }
});
$().ready(function(){
  if($('#projet_data_Autre_document').prop("checked") == true){
    $("#docdes").css("display", "block");
}else{
    $("#docdes").css("display", "none");
}
});
$("#projet_data_DepotCRI").change(function() {
  if(this.checked) {
    $("#docpv").css("display", "block");
    $("#docpv2").css("display", "block");
  }else{
    $("#docpv").css("display", "none");
    $("#docpv2").css("display", "none");
    $("#projet_data_date_PV_decision").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_DepotCRI').prop("checked") == true){
    $("#docpv").css("display", "block");
    $("#docpv2").css("display", "block");
  }else{
    $("#docpv").css("display", "none");
    $("#docpv2").css("display", "none");
    $("#projet_data_date_PV_decision").val(null);
  }
});
$("#projet_data_approuveCRUI").change(function() {
  if(this.checked) {
    $("#idDateApproCRUI").css("display", "block");
  }else{
    $("#idDateApproCRUI").css("display", "none");
    $("#projet_data_dateApprouveCRUI").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_approuveCRUI').prop("checked") == true){
    $("#idDateApproCRUI").css("display", "block");
  }else{
    $("#idDateApproCRUI").css("display", "none");
    $("#projet_data_dateApprouveCRUI").val(null);
  }
});
$("#projet_data_valideCTPS").change(function() {
  if(this.checked) {
    $("#idDateValideCTPS").css("display", "block");

    $("#projet_data_rejeteCTPS").prop("checked", false);
    $("#projet_data_ajourneCTPS").prop("checked", false);
    $("#idDateRejetCTPS").css("display", "none");
    $("#idMotifRejetCTPS").css("display", "none");
    $("#projet_data_dateRejetCTPS").val(null);
    $("#projet_data_motifRejetCTPS").val(null);
    $("#idDateAjournementCTPS").css("display", "none");
    $("#projet_data_dateAjournementCTPS").val(null);
  }else{
    $("#idDateValideCTPS").css("display", "none");
    $("#projet_data_dateValideCTPS").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_valideCTPS').prop("checked") == true){
    $("#idDateValideCTPS").css("display", "block");
  }else{
    $("#idDateValideCTPS").css("display", "none");
    $("#projet_data_dateValideCTPS").val(null);
  }
});
$("#projet_data_ajourneCTPS").change(function() {
  if(this.checked) {
    $("#idDateAjournementCTPS").css("display", "block");

    $("#projet_data_rejeteCTPS").prop("checked", false);
    $("#projet_data_valideCTPS").prop("checked", false);
    $("#idDateRejetCTPS").css("display", "none");
    $("#idMotifRejetCTPS").css("display", "none");
    $("#projet_data_dateRejetCTPS").val(null);
    $("#projet_data_motifRejetCTPS").val(null);
    $("#idDateValideCTPS").css("display", "none");
    $("#projet_data_dateValideCTPS").val(null);
  }else{
    $("#idDateAjournementCTPS").css("display", "none");
    $("#projet_data_dateAjournementCTPS").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_ajourneCTPS').prop("checked") == true){
    $("#idDateAjournementCTPS").css("display", "block");
  }else{
    $("#idDateAjournementCTPS").css("display", "none");
    $("#projet_data_dateAjournementCTPS").val(null);
  }
});
$("#projet_data_rejeteCTPS").change(function() {
  if(this.checked) {
    $("#idDateRejetCTPS").css("display", "block");
    $("#idMotifRejetCTPS").css("display", "block");
    
    $("#projet_data_valideCTPS").prop("checked", false);    
    $("#projet_data_ajourneCTPS").prop("checked", false);
    $("#idDateValideCTPS").css("display", "none");
    $("#projet_data_dateValideCTPS").val(null);
    $("#idDateAjournementCTPS").css("display", "none");
    $("#projet_data_dateAjournementCTPS").val(null);
  }else{
    $("#idDateRejetCTPS").css("display", "none");
    $("#idMotifRejetCTPS").css("display", "none");
    $("#projet_data_dateRejetCTPS").val(null);
    $("#projet_data_motifRejetCTPS").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_rejeteCTPS').prop("checked") == true){
    $("#idDateRejetCTPS").css("display", "block");
    $("#idMotifRejetCTPS").css("display", "block");
  }else{
    $("#idDateRejetCTPS").css("display", "none");
    $("#idMotifRejetCTPS").css("display", "none");
    $("#projet_data_dateRejetCTPS").val(null);
    $("#projet_data_motifRejetCTPS").val(null);
  }
});
$("#projet_data_comptabiliseCA").change(function() {
  if(this.checked) {
    $("#idAnneeStatutCA").css("display", "block");
  }else{
    $("#idAnneeStatutCA").css("display", "none");
    $("#projet_data_anneeNCA").val(null);
    $("#projet_data_statutNCA").val(null);
    $("#projet_data_anneeN1CA").val(null);
    $("#projet_data_statutN1CA").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_comptabiliseCA').prop("checked") == true){
    $("#idAnneeStatutCA").css("display", "block");
  }else{
    $("#idAnneeStatutCA").css("display", "none");
    $("#projet_data_anneeNCA").val(null);
    $("#projet_data_statutNCA").val(null);
    $("#projet_data_anneeN1CA").val(null);
    $("#projet_data_statutN1CA").val(null);
  }
});
$("#projet_data_approuveCNI").change(function() {
  if(this.checked) {
    $("#idDateApproCNI").css("display", "block");
  }else{
    $("#idDateApproCNI").css("display", "none");
    $("#projet_data_dateApprouveCNI").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_approuveCNI').prop("checked") == true){
    $("#idDateApproCNI").css("display", "block");
  }else{
    $("#idDateApproCNI").css("display", "none");
    $("#projet_data_dateApprouveCNI").val(null);
  }
});
$("#projet_data_signature_mou").change(function() {
  if(this.checked) {
    $("#docsignmou").css("display", "block");
  }else{
    $("#docsignmou").css("display", "none");
  }
});
$().ready(function(){
  if($('#projet_data_signature_mou').prop("checked") == true){
    $("#docsignmou").css("display", "block");
  }else{
    $("#docsignmou").css("display", "none");
  }
});
$().ready(function(){
  if($('#projet_data_NAbouti').prop("checked") == true){
    $("#idRaisonBloque").css("display", "block");
  }else{
    $("#idRaisonBloque").css("display", "none");
  }
});

$("#projet_data_Reactive").change(function() {
  if(this.checked) {
    $("#projet_data_Standby").prop("checked", false);    
    $("#idRaisonStandby").css("display", "none");
    $("#projet_data_RaisonStandby").val(null);
    $("#projet_data_ActionRequiseStandby").val(null);
    $("#projet_data_DateStandby").val(null);

    $("#idDateReactive").css("display", "block");
  }else{
    $("#idDateReactive").css("display", "none");    
    $("#projet_data_date_reactivation").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_Reactive').prop("checked") == true){
    $("#idDateReactive").css("display", "block");
  }else{
    $("#idDateReactive").css("display", "none");
  }
});

$("#projet_data_Debloque").change(function() {
  if(this.checked) {
    $("#projet_data_NAbouti").prop("checked", false);
    $("#idRaisonBloque").css("display", "none");
    $("#projet_data_RaisonBloque").val(null);
    $("#projet_data_ActionRequiseDebloquer").val(null);
    $("#projet_data_date_pv_cloture_nabouti").val(null);

    $("#idDateDeblocage").css("display", "block");
  }else{
    $("#idDateDeblocage").css("display", "none");    
    $("#projet_data_date_deblocage").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_Debloque').prop("checked") == true){
    $("#idDateDeblocage").css("display", "block");
  }else{
    $("#idDateDeblocage").css("display", "none");
  }
});

$("#projet_data_Standby").change(function() {
  if(this.checked) {
    $("#idRaisonStandby").css("display", "block");
  }else{
    $("#idRaisonStandby").css("display", "none");
    $("#projet_data_RaisonStandby").val(null);
    $("#projet_data_ActionRequiseStandby").val(null);
    $("#projet_data_DateStandby").val(null);
  }
});
$().ready(function(){
  if($('#projet_data_Standby').prop("checked") == true){
    $("#idRaisonStandby").css("display", "block");
  }else{
    $("#idRaisonStandby").css("display", "none");
    $("#projet_data_RaisonStandby").val(null);
    $("#projet_data_ActionRequiseStandby").val(null);
    $("#projet_data_DateStandby").val(null);
  }
});
$("#projet_data_loi_signe_invest").change(function() {
  if(this.checked) {
    $("#docloisigninvest").css("display", "block");
  }else{
    $("#docloisigninvest").css("display", "none");
  }
});
$().ready(function(){
  if($('#projet_data_loi_signe_invest').prop("checked") == true){
    $("#docloisigninvest").css("display", "block");
  }else{
    $("#docloisigninvest").css("display", "none");
  }
});
$("#projet_data_loi_signe_sou").change(function() {
  if(this.checked) {
    $("#docloisignsou").css("display", "block");
  }else{
    $("#docloisignsou").css("display", "none");
  }
});
$().ready(function(){
  if($('#projet_data_loi_signe_sou').prop("checked") == true){
    $("#docloisignsou").css("display", "block");
  }else{
    $("#docloisignsou").css("display", "none");
  }
});

$('#projets_Localisation').on('change', function (e) {
    var id_region_select = $('#projets_Localisation').val();
    $.ajax({
        url: '/projets/remplirprovfromregion/',
        type: 'POST',
        data: {id_region: id_region_select},
        dataType: 'json',
        success: function(json){
            $('#projets_Province').html('');
            $.each(json, function(index, value) {
                if(index == 0) {
                   	$('#projets_Province').append('<option value=""></option>');
                }
                $('#projets_Province').append('<option value="'+ value.idProvince +'">'+ value.nomProvince +'</option>');
            });
        }
    });
});

$().ready(function(){
	var id_region = $('#projets_Localisation').val();
	if ((id_region != null) && (id_region == '')) {
        $('#projets_Province').html('');
	}
});

$('#projet_data_Localisation').on('change', function (e) {
    var id_region_select = $('#projet_data_Localisation').val();
    $.ajax({
        url: '/projets/remplirprovfromregion/',
        type: 'POST',
        data: {id_region: id_region_select},
        dataType: 'json',
        success: function(json){
            $('#projet_data_Province').html('');
            $.each(json, function(index, value) {
                if(index == 0) {
                   	$('#projet_data_Province').append('<option value=""></option>');
                }
                $('#projet_data_Province').append('<option value="'+ value.idProvince +'">'+ value.nomProvince +'</option>');
            });
        }
    });
});

$().ready(function(){
	var id_province = $('#projet_data_Province').val();
	var id_region = $('#projet_data_Localisation').val();
	if ((id_province != null) && (id_province == '')) {
        if ((id_region != null) && (id_region == '')) {
            $('#projet_data_Province').html('');
        } else if((id_region != null) && (id_region != '')) {
            $.ajax({
                url: '/projets/remplirprovfromregion/',
                type: 'POST', data: {id_region: id_region}, dataType: 'json',
                success: function(json){
                    $('#projet_data_Province').html('');
                    $.each(json, function(index, value) {
                        if(index == 0) {
                   	        $('#projet_data_Province').append('<option value=""></option>');
                        }
                        $('#projet_data_Province').append('<option value="'+ value.idProvince +'">'+ value.nomProvince +'</option>');
                    });
                }
            });
        }
	} else if((id_province != null) && (id_province != '')) {
        if ((id_region != null) && (id_region == '')) {
            $('#projet_data_Province').html('');
        } else if((id_region != null) && (id_region != '')) {
            
            $.ajax({
                url: '/projets/remplirprovfromregion/',
                type: 'POST', data: {id_region: id_region}, dataType: 'json',
                success: function(json){
                    $('#projet_data_Province').html('');
                    $.each(json, function(index, value) {
                        if(index == 0) {
                   	        $('#projet_data_Province').append('<option value=""></option>');
                        }
                        $('#projet_data_Province').append('<option value="'+ value.idProvince +'">'+ value.nomProvince +'</option>');
                    });
                    $('#projet_data_Province option[value=' + id_province + ']').attr('selected', true);
                }
            });
        }
    }
});

$("#projet_data_Commande_expo").change(function() {
  if(this.checked) {
    // $("#projet_data_Compte_exportateur_expo").prop("disabled", false);
    // $("#projet_data_date_decision_expo").prop("disabled", false);
    // $("#projet_data_valeur_cmd_expo").prop("disabled", false);
    // $("#projet_data_secteur_expo").prop("disabled", false);
    // $("#projet_data_reference_expo").prop("disabled", false);
    // $("#projet_data_eco_fil_expo").prop("disabled", false);
    // $("#projet_data_produit_expo").prop("disabled", false);
    $("#projet_data_date_cmd_expo").css("display", "block");
    $("#document_CMD").css("display", "flex");
    $("#document_CMDRR").css("display", "flex");
    $("#document_CMDooo").css("display", "flex");

  }
});
$("#projet_data_Commande_expo").change(function() {
  if(!this.checked) {
    // $("#projet_data_Compte_exportateur_expo").prop("disabled", true);
    // $("#projet_data_date_decision_expo").prop("disabled", true);
    // $("#projet_data_valeur_cmd_expo").prop("disabled", true);
    // $("#projet_data_secteur_expo").prop("disabled", true);
    // $("#projet_data_reference_expo").prop("disabled", true);
    // $("#projet_data_eco_fil_expo").prop("disabled", true);
    // $("#projet_data_produit_expo").prop("disabled", true);
    $("#projet_data_date_cmd_expo").css("display", "none");
    $("#document_CMD").css("display", "none");
    $("#document_CMDRR").css("display", "none");
    $("#document_CMDooo").css("display", "none");

  }
});
$("#projet_data_Signaturedecontrat_expo").change(function() {
  if(this.checked) {
    $("#projet_data_date_signature_expo").css("display", "block");
    $("#document_contra").css("display", "block");
    $("#document_contraooo").css("display", "block");
  }else{
    $("#projet_data_date_signature_expo").css("display", "none");
    $("#document_contra").css("display", "none");
    $("#document_contraooo").css("display", "none");
  }
});
$("#projet_data_pvcloture_expo").change(function() {
  if(this.checked) {
    $("#projet_data_date_pvclose_expo").css("display", "block");
    $("#document_pv_cloture").css("display", "block");
    $("#document_pv_clotureooo").css("display", "block");

  }else{
    $("#projet_data_date_pvclose_expo").css("display", "none");
    $("#document_pv_cloture").css("display", "none");
    $("#document_pv_clotureooo").css("display", "none");
  }
});
$("#projets_Commande_expo").change(function() {
  if(this.checked) {
    $("#projets_Compte_exportateur_expo").prop("disabled", false);
    $("#projets_date_decision_expo").prop("disabled", false);
    $("#projets_valeur_cmd_expo").prop("disabled", false);
    $("#projets_secteur_expo").prop("disabled", false);
    $("#projets_reference_expo").prop("disabled", false);
    $("#projets_eco_fil_expo").prop("disabled", false);
    $("#projets_produit_expo").prop("disabled", false);
  }
});
$("#Intérêt").css("color", "#D3D3D3");
$("#Décision").css("color", "#D3D3D3");
$("#Suivi").css("color", "#D3D3D3");
$("#Fermé").css("color", "#D3D3D3");

$().ready(function(){
  if($('#contact_exclusif').prop("checked") == true){
    $("#contact_exclusif").prop('checked',true);

}else{
   $("#contact_exclusif").prop('checked', false);
}
});

$("#contact_exclusif").change(function() {
  if(this.checked) {
    $("#exc").addClass('active');
  }else{
    $("#exc").removeClass('active');
  }
});
$().ready(function(){
  if($('#projet_data_Confidentiel').prop("checked") == true){
    $("#projet_data_Confidentiel").prop('checked',true);

}else{
   $("#projet_data_Confidentiel").prop('checked', false);
}
});
$().ready(function(){
  if($('#projet_data_Prioritaire').prop("checked") == true){
    $("#projet_data_Prioritaire").prop('checked',true);

}else{
   $("#projet_data_Prioritaire").prop('checked', false);
}
});
$().ready(function(){
  if($('#compte_categorie').prop("checked") == true){
    $("#compte_categorie").prop('checked',true);

}else{
   $("#compte_categorie").prop('checked', false);
}
});
$().ready(function(){
  if($('#projets_Abouti').prop("checked") == true){
   $("#seemore").css("display", "flex");
 }
 if($('#projet_data_Abouti').prop("checked") == true){
   $("#seemore").css("display", "flex");
 }

 if($('#projet_data_Commande_expo').prop("checked") == true){
  $("#document_CMD").css("display", "flex");
  $("#document_CMDRR").css("display", "flex");
  $("#document_CMDooo").css("display", "flex");
  $("#projet_data_date_cmd_expo").css("display", "flex");
}
if($('#projet_data_Commandesou').prop("checked") == true){
  
  $("#projet_data_date_signature_cmd").css("display", "block");
  $("#document_CMD_sou").css("display", "block");
  $("#document_CMD_souooo").css("display", "block");

  $("#seemore_sourcing03").css("display", "flex");

}
if($('#projet_data_Signaturedecontrat').prop("checked") == true){
  $("#projet_data_date_signature_sou").css("display", "block");
  $("#document_contra_sou").css("display", "block");
  $("#document_contra_souooo").css("display", "block");


}
if($('#projet_data_plateformelocal').prop("checked") == true){
  $("#pv56OR0").css("display", "block");
  $("#document_pv_cloture_sou").css("display", "block");
  $("#document_pv_cloture_souooo").css("display", "block");

}
if($('#projet_data_Signaturedecontrat_expo').prop("checked") == true){
  $("#projet_data_date_signature_expo").css("display", "block");
  $("#document_contra").css("display", "block");
  $("#document_contraooo").css("display", "block");
}else{
  $("#projet_data_date_signature_expo").css("display", "none");
  $("#document_contra").css("display", "none");
  $("#document_contraooo").css("display", "none");
}
$("#projet_data_date_pvclose_expo").css("display", "block");
if($('#projet_data_pvcloture_expo').prop("checked") == true){
  $("#projet_data_date_pvclose_expo").css("display", "block");
  $("#document_pv_cloture").css("display", "block");
  $("#document_pv_clotureooo").css("display", "block");
}else{
  $("#projet_data_date_pvclose_expo").css("display", "none");
  $("#document_pv_cloture").css("display", "none");
  $("#document_pv_clotureooo").css("display", "none");
}

if($('#projet_data_Aboutiexpo').prop("checked") == true){
  $("#seemoreexpo").css("display", "flex");
  $("#seemoreexpo02").css("display", "flex");
  if($('#projet_data_Commande_expo').prop("checked") == true){
      $("#document_CMDRR").css("display", "flex");
  }
  $("#Motif_expo").css("display", "none");
}

if($('#projet_data_NAboutiexpo').prop("checked") == true){
  $("#seemoreexpo").css("display", "none");
  $("#seemoreexpo02").css("display", "none");
  $("#document_CMDRR").css("display", "none");
  $("#Motif_expo").css("display", "block");
}
 
 if($('#projet_data_Aboutisou').prop("checked") == true){
   $("#seemore_sourcing").css("display", "flex");
   $("#seemore_sourcing02").css("display", "flex");
   $("#seemore_sourcing03").css("display", "flex");
   $("#Motif_sou").css("display", "none");

 }

 if($('#projet_data_NAboutisou').prop("checked") == true){
   $("#seemore_sourcing").css("display", "none");
   $("#seemore_sourcing02").css("display", "none");
   $("#seemore_sourcing03").css("display", "none");
   $("#Motif_sou").css("display", "block");
 }


$("#M32G5").css("display", "none");
$("#M4ROE0").css("display", "none");
$("#M32RE0").css("display", "none");

$("#prom00").css("display", "none");
$("#invit00").css("display", "none");

$('#compte_Action_realise').on('change', function (e) {
  if($('#compte_Action_realise option:selected').val() == " Promotion Maroc - Pitch"){
    $("#prom00").css("display", "block");
    $("#invit00").css("display", "none");
  } else if ($('#compte_Action_realise option:selected').val() == "Invitation"){
    $("#prom00").css("display", "none");
    $("#invit00").css("display", "block");
  } else {
    $("#prom00").css("display", "none");
    $("#invit00").css("display", "none");
  }
});

$('#compte_action_prospe').on('change', function (e) {
  if($('#compte_action_prospe option:selected').val() == "Event"){
    $("#M32G5").css("display", "block");
  }else {
    $("#M32G5").css("display", "none");
  }
});


$('#projet_data_action_interet').on('change', function (e) {
  if($('#projet_data_action_interet option:selected').val() == "Event"){
    $("#M4ROE0").css("display", "block");
  }else {
    $("#M4ROE0").css("display", "none");
  }
});
$('#projet_data_incitations').on('change', function (e) {
  if($('#projet_data_incitations option:selected').val() == "Autres"){
    $("#M32RE0").css("display", "block");
  }else {
    $("#M32RE0").css("display", "none");
  }
});


});

$(document).ready(function(){
  $("#type option[value='4']").remove();
  $('#compte_etatCompte option:contains("Identifié")').text('');

});

$("#carte_visite_compte").append('<option value="">Autre</option>');
$(document).ready(function () {
			$("#btn_submit").click(function (){
				$( "#btn-send" ).click();
			});
});

$(document).ready(function() {
  $('#FiltregerePar').select2({
       width: '100%'
   });	
});