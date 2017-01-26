$(function() {

    $('input[type=checkbox]').click(function(e) {
        var parentTarifReduit = this.parentNode.parentNode.parentNode;
        var birthDateValue = parentTarifReduit.previousElementSibling.childNodes[1].value;
        if(birthDateValue.length !== 10) {
            if(!e.isDefaultPrevented() && this.checked) {
                e.preventDefault();
            }
        }
        else if(!checkIfTarifReduitIsPossible(birthDateValue)) {
            if(!e.isDefaultPrevented() && this.checked) {
                e.preventDefault();
            }
            if(!document.getElementById('tarif-reduit-error')) {
                var p = document.createElement('p');
                p.id = 'tarif-reduit-error';
                (navigator.language == 'fr') ? p.textContent = 'Le tarif réduit est réservé aux personnes de plus de 12 ans.' : p.textContent = 'The reduced price is not applicable for children under or equal to 12.';
                p.style.color = "red";
                this.parentNode.parentNode.appendChild(p);
            }
        }
        else {
            if(document.getElementById('tarif-reduit-error')) {
                this.parentNode.parentNode.removeChild(document.getElementById('tarif-reduit-error'));
            }
        }
    });

    function checkIfTarifReduitIsPossible(birthDateValue) {
        var today = new Date();
        var currentYear = today.getFullYear();
        var currentMonth = (today.getMonth()+1);
        var userAge = null;
        var data = birthDateValue.split('/');
        if(data.length !== 3) {
            return false;
        }
        (currentMonth >= data[1]) ? userAge = currentYear - data[2] : userAge = (currentYear - data[2] - 1);
        if(userAge <= 12) return false;
        return birthDateValue;
    }
});