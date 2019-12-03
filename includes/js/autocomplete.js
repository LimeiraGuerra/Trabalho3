//==== Autocomplete: https://jqueryui.com/autocomplete/#default
$(document).ready(function(){
    //pego apenas os nomes de todos os alimentos. (Tem como trabalhar de outras formas com o autoComplete, porém considero essa mais fácil de entender)
    let alimentosNomes=[]
    for(i=0;i<alimentosJS.length;i++){
    	alimentosNomes.push(alimentosJS[i].nome)
    }
    
    $( "#buscar" ).autocomplete({
        minLength: 3,//só começa a procurar depois que digitou 2 caracteres
        source: alimentosNomes,
        select: function (event, selecionado) {
        	populaForm(selecionado.item.value)
        	return false;
        }
    });
});