// Transição entre botão de Login e tela de Login
function aparecer() {
    let card = document.querySelector('.card');
    let btnPopup = document.querySelector('#btnLogin-popup');

    if(card.classList.contains('open')) {
        card.classList.remove('open');
        btnPopup.classList.remove('open');
    } else {
        card.classList.add('open');
        btnPopup.classList.add('open');
    }
}

// Transaciona entre Login de ADM e de Usuário
function trocar() {
    let card = document.querySelector('.card');

    if(card.classList.contains('active')) {
        card.classList.remove('active');
    }
    else {
        card.classList.add('active');
    }
}

// Máscara para o CPF
function mascara(i){
   
    var v = i.value;
    
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
       i.value = v.substring(0, v.length-1);
       return;
    }
    
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";
 
}
