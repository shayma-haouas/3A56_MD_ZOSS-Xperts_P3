var qr = new QRious({
    element: document.querySelector('.qrious'),
    size: 250,
    value: "Aucune valeur"
});

function updateQRCode() {
    
    var email = document.getElementById('email').value;
   
    var password = document.getElementById('password').value;
   

    var valeur = email + '-' + password ;
    qr.set('value', valeur);
}

document.querySelectorAll('input').forEach(function(input) {
    input.addEventListener('input', updateQRCode);
});

document.querySelectorAll('select').forEach(function(select) {
    select.addEventListener('change', updateQRCode);
});

// Appeler updateQRCode() une fois au chargement de la page pour mettre à jour le code QR initial
updateQRCode();
