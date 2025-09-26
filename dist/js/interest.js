var controleCampo = 1;
function adicionarCampo() {
    controleCampo++;
    document.getElementById('formulario').insertAdjacentHTML(
        'beforeend', '<div class="form-group" id="campo' + controleCampo + '"><span id="msgAlerta' + controleCampo + '"></span><label> Data inicial: </label><input type="text" name="dtInicial' + controleCampo + '" id="dtInicial' + controleCampo + '" /><label> Data final: </label><input type="text" name="dtFinal' + controleCampo + '" id="dtFinal' + controleCampo + '" /><label> Juros/dia: </label><input type="text" name="juros' + controleCampo + '" id="juros' + controleCampo + '" /><label> Tarifa: </label><input type="text" name="tarifa' + controleCampo + '" id="tarifa' + controleCampo + '" /><label> Valor original: </label><input type="text" name="valor' + controleCampo + '" id="valor' + controleCampo + '" /><input type="hidden" name="id' + controleCampo + '" id="id' + controleCampo + '" /> <button type="button" id="' + controleCampo + '" onclick="removerCampo(' + controleCampo + ')"> - </button></div>');document.getElementById("qnt_campo").value = controleCampo;
}

function removerCampo(idCampo){
    document.getElementById('campo' + idCampo).remove();
}