function showValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).addClass('alert-validate');
}

function hideValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).removeClass('alert-validate');
}

$(document.body).on("focus", '.input100', function(){
    hideValidate(this);
});

function validate (input) {
    if($(input).val().trim() == ''){
        return false;
    }
    let re = (/^(\d+|\d+\.\d+)$/);
    if (!($(input).attr('name') == 'nome') && $(input).hasClass('dadosColetados') && !re.test($(input).val())) {
        return false;
    }
}

function checkInputs(input){
    var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
    return check;
}


(function ($) {
    "use strict";
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        return checkInputs(input);
    });

})(jQuery);

function populaForm(nomeAlimento){
    $("#esconder").show(350);
    $("#buscar").val(nomeAlimento);
    //Encontra o Primeiro alimento que tenha esse nome (do jeito que está não funciona com nome repetido)
    for(i=0;i<alimentosJS.length;i++){
        if(alimentosJS[i].nome==nomeAlimento){
            $("#id").val(alimentosJS[i].id);
            $("#nome").val(alimentosJS[i].nome);
            $("#Calorias").val(alimentosJS[i].kcal_calculada);
            $("#Proteinas").val(alimentosJS[i].proteinas);
            $("#Carboidratos").val(alimentosJS[i].carboidratos);
            $("#Gorduras").val(alimentosJS[i].lipidios);
            $("#Fibra").val(alimentosJS[i].fibra);
            $("#umidade").val(alimentosJS[i].umidade);
            return;
        }
    }
}

$("#calcular").click(function(){
    let input = $('.validate-input .input100');
    
    if(checkInputs(input)){
        proteina = parseFloat($(input[1]).val());
        carbo = parseFloat($(input[2]).val());
        gordura = parseFloat($(input[3]).val());
        fibra = parseFloat($(input[4]).val());
        $("#Calorias").val( proteina*4+carbo*4+gordura*9);
        $("#umidade").val( 100-(proteina+carbo+gordura+fibra));
        $("#criar").removeClass("form-btn-disabled");
        $("#criar").prop('disabled', false);
        $("#criar").removeClass("form-btn-disabled");
        $("#criar").prop('disabled', false);
    }
});

$(".dadosColetados").keyup(function(){
    $("#criar").addClass("form-btn-disabled");
    $("#criar").prop('disabled', true);
});

$(".deletarBtn").on('click', function(){
    $(".formCrud").on('submit', function(){
        return confirm("Confirmar deleção?");
    });
});

$(".ckbModerador").change(function(){
    if ($(this).is(":checked")) {
        var ckd = true;
    }
    else{
        var ckd = false;
    }
    var id = $(this).val();
    $.post("defModerador", {"idUser":id, "isMod":ckd});
});

