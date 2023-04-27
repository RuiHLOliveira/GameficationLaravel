
async function _loadMissoes(idPersonagem){
    const url = _url(`/api/${idPersonagem}/missoes`);
    let missoes = await fetch(url);
    return missoes;
}

async function _createMissao(idPersonagem, missao) {
    console.log(missao);
    let headers = _buildHeaders();
    dados = {
        'method': "POST",
        'body' : JSON.stringify(missao),
        'headers' : headers
    }
    const url = _url(`/api/${idPersonagem}/missoes`);
    return fetch(url, dados)
}