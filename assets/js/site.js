$(document).ready(function(){
    
    $('[data-toggle="tooltip"]').tooltip(); 
    
    $('[data-toggle="popover"]').popover();
    
    $('.datatable').DataTable({
        paging: false,
        searching: false,
        info: false,
        "order": [[ 2, "desc" ]]});

    $('form.destroy-form').on('submit', function(submit){
        var confirm_message = $(this).attr('data-confirm');
        if(!confirm(confirm_message)){
            submit.preventDefault();
        }
    });
});
