function deletar(id, tabela) {
    if (confirm("Tem certeza que deseja remover este registro? Esta ação não tem volta.")) {
        window.location.href = "http://gtravel.com.br/db/functions.php?deletar=sim&id=" + id + "&tabela=" + tabela;
    }
}

$(document).ready(function () {
    $('[name=telefone]').mask('(00) 00000-000#');
    $('[name=cpf]').mask('000.000.000-00');
    $('[name=cep]').mask('00000-000');
    $('[name=whatsapp]').mask('(00) 0 0000-0000');



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
                $("[name=endereco]").val(dadosRetorno.logradouro);
                $("[name=bairro]").val(dadosRetorno.bairro);
                $("[name=cidade]").val(dadosRetorno.localidade);
                $("[name=uf]").val(dadosRetorno.uf);
            } catch (ex) {}
        });
    });

});