


function _toggleHidden(id){
    let element = document.getElementById(id)
    if(element.classList.contains('hidden')){
        element.classList.remove('hidden');
    } else {
        element.classList.add('hidden');
    }
}