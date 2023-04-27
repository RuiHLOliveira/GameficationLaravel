
async function _loadIdeias(idPersonagem){
    const url = _url(`/api/${idPersonagem}/ideias`);
    let ideias = await fetch(url);
    return ideias;
}

async function _createIdeia(idPersonagem, ideia) {
    console.log(ideia);
    let headers = _buildHeaders();
    dados = {
        'method': "POST",
        'body' : JSON.stringify(ideia),
        'headers' : headers
    }
    const url = _url(`/api/${idPersonagem}/ideias`);
    return fetch(url, dados)
}