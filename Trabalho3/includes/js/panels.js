$(".plusBtnNew").click(function(){
	$(".btn-newPanel").hide();
	$(".form-newPanel").show();
});

$(".cancelar").click(function(){
	$(".form-newPanel").hide();
	$(".form-newPanel .input100").val("");
	$(".btn-newPanel").show();
});

//ajax crud dieta
$(document.body).on("click", ".dietaSave", function(){
    let input = $(this).closest(".form-newPanel").find('.input100');
    if(checkInputs(input)){
        $.post("addDieta", {"nome":input.val()}, function(data, status) {
            if (status=='success' && /\d+/.test(data)) {
                let div = `<div class="col-md-4 col-sm-6 dietaMostrada">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-id="${data}">
                                        <h3 class="dietaTitle">${input.val()}</h3>
                                        <button class="dietaDelete icDelete"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                    <div class="panel-body">
                                        <p>Refeições: 0</p>
                                        <p>Total calorias: 0</p>
                                    </div>
                                    <a href="refeicoes?idDieta=${data}">
                                        <button type="button" class="login100-form-btn panel-footer">Visualizar</button>
                                    </a>
                                </div>
                            </div>`;
                $(".form-newPanel").hide();
                $(".form-newPanel .input100").val("");
                $(".btn-newPanel").show();
                $(div).insertBefore(".form-newPanel");
            }
        });
    }
});

$(document.body).on("click", ".dietaDelete", function(){
    if(confirm("Confirmar deleção?")){
        let ths = $(this);
        let id = $(this).closest(".panel-heading").data("id");
        $.post("removeDieta", {"idDieta":id}, function(data, status) {
            if (status=='success' && data == 1) {
                $(ths).closest(".dietaMostrada").remove();
            }
        });
    }
});


//ajax crud refeicoes
$(document.body).on("click", ".refSave", function(){
    let input = $(this).closest(".form-newPanel").find('.input100');
    if(checkInputs(input)){
        let id = $(".escolheRefeicao").data("id");
        $.post("addRefeicao", {"nome":input.val(), "idDieta":id}, function(data, status) {
            if (status=='success' && /\d+/.test(data)) {
                let div = `<div class="col-sm-12 refeicaoMostrada">
                                <div class="panel panel-default">
                                        <div class="panel-heading" data-id=${data}>
                                        <h3 class="refTitle">${input.val()}</h3>
                                        <button class="refDelete icDelete">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>              
                                    <div class="panel-body row totalRef">
                                        <div class="proteinasTT col-xs-6 col-sm-2">
                                            <h5>Proteinas: </h5>
                                            <p>0</p>
                                        </div>
                                        <div class="carboidratosTT col-xs-6 col-sm-2">
                                            <h5>Carboidratos: </h5>
                                            <p>0</p>
                                        </div>
                                        <div class="gordurasTT col-xs-6 col-sm-2">
                                            <h5>Gorduras: </h5>
                                            <p>0</p>
                                        </div>
                                        <div class="fibrasTT col-xs-6 col-sm-2">
                                            <h5>Fibras: </h5>
                                            <p>0</p>
                                        </div>
                                        <div class="umidadeTT col-xs-6 col-sm-2">
                                            <h5>Umidade: </h5>
                                            <p>0</p>
                                        </div>
                                        <div class="caloriasTT col-xs-6 col-sm-2">
                                            <h5>Calorias: </h5>
                                            <p>0</p>
                                        </div>
                            
                                    </div>
                                    <a href="refeicaoSolo?idRef=${data}">
                                        <button type="button" class="login100-form-btn panel-footer">Visualizar</button>
                                    </a>
                                </div>
                            </div>`;
                $(".form-newPanel").hide();
                $(".form-newPanel .input100").val("");
                $(".btn-newPanel").show();
                $(div).insertBefore(".form-newPanel");
            }
        });
    }
});

$(document.body).on("click", ".refDelete", function(){
    if(confirm("Confirmar deleção?")){
        let ths = $(this);
        let idRef = $(this).closest(".panel-heading").data("id");
        let idD = $(".escolheRefeicao").data("id");
        $.post("removeRefeicao", {"idRefeicao":idRef, "idDieta":idD}, function(data, status) {
            if (status=='success' && data == 1) {
                $(ths).closest(".refeicaoMostrada").remove();
            }
        });
    }
});


$(".cancelaA").click(function(){
    $("#esconder").hide(150);
    $("#buscar").val("");
})

//ajax crud alimento/refeicao
$(".addAlimento").click(function(){
    let input = $('.validate-input .input100');
    if (checkInputs(input)) {
        let dados = $(".formAddAlimento").serialize()+"&idRef="+$(".escolheAlimento").data("id");
        $.post("addAlimRef", dados, function(data, status){
            if (status=='success' && data) {
                let dados = $(".formAddAlimento").serializeArray();
                let div=`<tr data-id=${Object.values(dados[1])[1]}>
                            <td>${Object.values(dados[0])[1]}</td>
                            <td>${Object.values(dados[8])[1]}</td>
                            <td>${Object.values(dados[2])[1]}</td>
                            <td>${Object.values(dados[3])[1]}</td>
                            <td>${Object.values(dados[4])[1]}</td>
                            <td>${Object.values(dados[5])[1]}</td>
                            <td>${Object.values(dados[6])[1]}</td>
                            <td>${Object.values(dados[7])[1]}</td>
                            <td>
                                <button class="alimentoDelete">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>`;
                $("tbody").append(div);
                recalculate(1, $("tbody tr:last-child"));
                $("#esconder").hide(150);
                $("#buscar").val("");
            }
        });
    }
})

$(document.body).on("click", ".alimentoDelete", function(){
    if(confirm("Confirmar deleção?")){
        let ths = $(this);
        let idAlim = $(this).closest("tr").data("id");
        let idRef = $(".escolheAlimento").data("id");
        $.post("removeAlimRef", {"idRefeicao":idRef, "idAlimento":idAlim}, function(data, status) {
            if (status=='success' && data == 1) {
                recalculate(-1, $(ths).closest("tr"));
                $(ths).closest("tr").remove();
            }
        });
    }
});

function recalculate(sign, tr){
    var val = $(tr).children("td");

    $("tfoot td").each(function(index){
        if(index < $("tfoot td").length-1){
            $(this).text(parseFloat($(this).text())+(sign * parseFloat(val.eq(index+1).text())));
        }
    })
}