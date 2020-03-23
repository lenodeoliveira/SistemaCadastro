function checkUsername(){
    
    var elMsg = document.getElementById('feedback');
    var elnome = document.getElementById('nome');
    if(elnome.value.length < 5) {

        elMsg.textContent = 'Name must be 5 characters or more!';

    }else {

        elMsg.textContent = '';

    }
}

