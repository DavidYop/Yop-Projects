$(function(){
    var open = false;
    $('#showForm').click(function(){
        if(open == false){
            open = true;
            $('.formulaire').slideToggle();
            $('.ecfPHP').slideToggle();
            $('#showForm').html('<i class="fas fa-angle-up btn-lg"></i> Réduire le formulaire <i class="fas fa-angle-up btn-lg"></i>');
        } else {
            open = false;
            $('.ecfPHP').slideToggle();
            $('.formulaire').slideToggle();
            $('#showForm').html('<i class="fas fa-angle-down btn-lg"></i> Afficher le formulaire <i class="fas fa-angle-down btn-lg"></i>');
        }
    });
});