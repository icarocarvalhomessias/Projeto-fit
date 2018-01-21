$('#modal_confirmar_remocao').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget);
    recipient = button.data('id');
    $('#confirma_remocao').attr('href', window.location.href+'/remover/'+recipient);
});