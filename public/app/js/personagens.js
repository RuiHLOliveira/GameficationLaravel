
async function _loadPersonagens(){
    const url = _url(`/api/personagens`);
    let personagens = await fetch(url);
    return personagens;
}

async function _createPersonagem(personagem) {
    console.log(personagem);
    let headers = _buildHeaders();
    dados = {
        'method': "POST",
        'body' : JSON.stringify(personagem),
        'headers' : headers
    }
    const url = _url(`/api/personagens`);
    return fetch(url, dados)
}