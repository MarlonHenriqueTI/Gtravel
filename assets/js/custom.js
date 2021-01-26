function deletar(id, tabela) {
    if (id == 1) {
        alert("Este usuário é um desenvolvedor, não é possivel excluir um desenvolvedor!");
    } else {
        if (confirm("Tem certeza que deseja remover este registro? Esta ação não tem volta.")) {
            window.location.href = "http://gtravel.com.br/db/functions.php?deletar=sim&id=" + id + "&tabela=" + tabela;
        }
    }

}

$(document).ready(function () {
    $('[name=telefone]').mask('(00) 00000-000#');
    $('[name=cpf]').mask('000.000.000-00');
    $('[name=cep]').mask('00000-000');
    $('[name=whatsapp]').mask('(00) 0 0000-0000');

    $('[name=cpf_cnpj]').keydown(function(){
        try {
            $('[name=cpf_cnpj]').unmask();
        } catch (e) {}
    
        var tamanho = $('[name=cpf_cnpj]').val().length;
    
        if(tamanho < 11){
            $('[name=cpf_cnpj]').mask("999.999.999-99");
        } else {
            $('[name=cpf_cnpj]').mask("99.999.999/9999-99");
        }
    
        // ajustando foco
        var elem = this;
        setTimeout(function(){
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    });

    $('[name=cpf_cnpj_empresa]').keydown(function(){
        try {
            $('[name=cpf_cnpj_empresa]').unmask();
        } catch (e) {}
    
        var tamanho = $('[name=cpf_cnpj_empresa]').val().length;
    
        if(tamanho < 11){
            $('[name=cpf_cnpj_empresa]').mask("999.999.999-99");
        } else {
            $('[name=cpf_cnpj_empresa]').mask("99.999.999/9999-99");
        }
    
        // ajustando foco
        var elem = this;
        setTimeout(function(){
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    });

    // Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
    // quando o usuário sair do campo "cep"
    $("[name=cep]").blur(function () {
        // Remove tudo o que não é número para fazer a pesquisa
        var cep = this.value.replace(/[^0-9]/, "");

        // Validação do CEP; caso o CEP não possua 8 números, então cancela
        // a consulta
        if (cep.length != 8) {
            return false;
        }

        // A url de pesquisa consiste no endereço do webservice + o cep que
        // o usuário informou + o tipo de retorno desejado (entre "json",
        // "jsonp", "xml", "piped" ou "querty")
        var url = "https://viacep.com.br/ws/" + cep + "/json/";

        // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
        // caso ocorra algum erro (o cep pode não existir, por exemplo) a
        // usabilidade não seja afetada, assim o usuário pode continuar//
        // preenchendo os campos normalmente
        $.getJSON(url, function (dadosRetorno) {
            try {
                // Preenche os campos de acordo com o retorno da pesquisa
                $("[name=rua]").val(dadosRetorno.logradouro);
                $("[name=bairro]").val(dadosRetorno.bairro);
                $("[name=cidade]").val(dadosRetorno.localidade);
                $("[name=uf]").val(dadosRetorno.uf);
            } catch (ex) {}
        });
    });


});

