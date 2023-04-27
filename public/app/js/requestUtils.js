
function _buildHeaders (){
    let headers = new Headers();
    headers.append("Content-Type", "application/json");
    headers.append("Accept", "application/json");
    return headers;
}

function _host() {
    return 'http://127.0.0.1:8000';
}

function _url(uri) {
    return _host() + uri;
}