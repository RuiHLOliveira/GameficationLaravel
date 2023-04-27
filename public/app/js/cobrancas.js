
async function _loadCobrancas(idPersonagem){
    const url = _url(`/api/${idPersonagem}/cobrancas`);
    let cobrancas = await fetch(url);
    return cobrancas;
}

async function _createCobranca(idPersonagem, cobranca) {
    console.log(cobranca);
    let headers = _buildHeaders();
    dados = {
        'method': "POST",
        'body' : JSON.stringify(cobranca),
        'headers' : headers
    }
    const url = _url(`/api/${idPersonagem}/cobrancas`);
    return fetch(url, dados)
}