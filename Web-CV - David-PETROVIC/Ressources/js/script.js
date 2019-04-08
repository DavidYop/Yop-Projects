// Animation scroll 
$(function(){
	$(".smoothScroll").on("click", function(event){		
		event.preventDefault();
		const hash = this.hash;		
		$('body, html').animate({scrollTop: $(hash).offset().top} , 900 , function(){window.location.hash = hash;})		
	});	


//Fermer la navbar collapse on click
	$(document).on('click',function(){
		$('.collapse').collapse('hide');
	})


//Tooltips
	$('[data-toggle="tooltip"]').tooltip({trigger : "hover"});


// Afficher plus d'infos
	$("#divInfo").height(62);
	$("#btnPlus").click(function(){
	if ($("#divInfo").height() == 62){
		$("#btnPlus").tooltip("hide").attr("data-original-title", "Afficher moins d'informations")
		.css("transform", "rotate(180deg)").html("<i class='fas fa-minus fa-2x'></i>");
		$("#divInfo").css("height", "100%");
		const hauteur = $("#divInfo").height();
		$("#divInfo").css("height", "62px");
		$("#motiv").animate({color: "#fff"}, 1000);
		$("#divInfo").animate({height: hauteur}, 1000);
		$("#shadow").animate({boxShadow: "none"});
	} else {
		$("#btnPlus").tooltip("hide").attr("data-original-title", "Afficher plus d'informations")
		.css("transform", "rotate(90deg)").html("<i class='fas fa-plus fa-2x'></i>");
		$("#motiv").animate({color: "#9DA8B5"}, 1000);
		$("#divInfo").animate({height: "62px"}, 1000);
		$("#shadow").animate({boxShadow: "0 -15px 14px -4px #fff"});
		}
	});

	
//Formulaire Contact
    $("#contact-form").submit(function(e){
        e.preventDefault();
        $(".msgErreur").empty();
        const postdata = $("#contact-form").serialize();
        $.ajax({
            type: "POST",
            url: "Ressources/php/contact.php",
            data: postdata,
            dataType: "json",
            success: function(json){
                if(json.isSuccess){
					$("#contact-form")[0].reset();
                    $(".msgSend").css("visibility", "visible");
                } else {
                    $("#prenom + .msgErreur").html(json.prenomError);
                    $("#nom + .msgErreur").html(json.nomError);
                    $("#email + .msgErreur").html(json.emailError);
                    $("#phone + .msgErreur").html(json.phoneError);
                    $("#message + .msgErreur").html(json.messageError);
                }
            }
        });
	});

});