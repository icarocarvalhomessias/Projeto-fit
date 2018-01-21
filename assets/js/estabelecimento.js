$(document).ready(function($){
    $("#CNPJ").mask("99.999.999/9999-99");
    $("#telefone").mask("(99) 99999-9999");
    $("#data_cadastro").mask("99/99/9999");
});


function validarCNPJ(cnpj) {    
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14){
        $("#CNPJ").parent().addClass('has-error has-danger');   
        $( "#salvar" ).attr("disabled", true);             
          return false;
    }
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999"){
            $("#CNPJ").parent().addClass('has-error has-danger');   
            $( "#salvar" ).attr("disabled", true);
            return false;
        }
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)){
        $("#CNPJ").parent().addClass('has-error has-danger');   
        $( "#salvar" ).attr("disabled", true);
        return false;
    }
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)){        
        $("#CNPJ").parent().addClass('has-error has-danger');   
        $( "#salvar" ).attr("disabled", true);             
          return false;
    }           

    $("#CNPJ").parent().removeClass('has-error has-danger');   
    $( "#salvar" ).attr("disabled", false);             
    return true;
    
}

function mascaraTelefone(){
    if($("#telefone").val().length >= 15){
        $("#telefone").mask("(99) 99999-9999");
    }else{
        $("#telefone").mask("(99) 9999-9999");
    }
    verificaForm();
}

function validaEmail(){
    if($("#email").val() != ''){
        if( !isValidEmailAddress( $("#email").val() ) ) {
            $("#email").parent().addClass('has-error has-danger');   
            $( "#salvar" ).attr("disabled", true);    
        }else{
            $("#email").parent().removeClass('has-error has-danger');   
            $( "#salvar" ).attr("disabled", false);    
        }
    }    
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

function validaCategoria(){
    if(verificaForm() && ($("#categoria option:selected").html() == "Supermercado")){
            
        if($("#telefone").val().length == 0){
            $("#telefone").parent().addClass('has-error has-danger');   
            $( "#salvar" ).attr("disabled", true); 
        }else{
            $("#telefone").parent().removeClass('has-error has-danger');   
            $( "#salvar" ).attr("disabled", false);  
        }
    }
}

function verificaForm (){

    if($("#categoria option:selected").val() == 0){
        $("#categoria").parent().addClass('has-error has-danger');   
        $( "#salvar" ).attr("disabled", true);
        return false;
    }else{
        $("#categoria").parent().removeClass('has-error has-danger'); 
        $("#telefone").parent().removeClass('has-error has-danger');             
        $( "#salvar" ).attr("disabled", false);  
        return true;
    }
    
}

function validaData(){
    if($("#data_cadastro").val().length != 0){
        var res = $("#data_cadastro").val().split("/");
        if((res[0] <= 31) && (res[1] <= 12)
            && (res[0] > 0 ) && (res[1] > 0 ) && res[2] > 0){
            $("#data_cadastro").parent().removeClass('has-error has-danger');   
            $( "#salvar" ).attr("disabled", false);  
            return true;    
        }else{
            $("#data_cadastro").parent().addClass('has-error has-danger');   
            $( "#salvar" ).attr("disabled", true);
            return false;
        }
    }
}

$( function() {
    $( "#datepicker" ).datepicker();
} );


$('#modal_confirmar_remocao').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget);
    recipient = button.data('id');
    $('#confirma_remocao').attr('href', window.location.href+'/remover/'+recipient);
});