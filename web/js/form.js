$(function() {
    //Calendrier des dates en français
    $.datepicker.regional.fr = {
        closeText: "Fermer",
        prevText: "Précédent",
        nextText: "Suivant",
        currentText: "Aujourd'hui",
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
        ],
        monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin",
            "juil.", "août", "sept.", "oct.", "nov.", "déc."
        ],
        dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
        dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
        dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
        weekHeader: "Sem.",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""
    };
    if (navigator.language == 'fr') {
        $.datepicker.setDefaults($.datepicker.regional.fr);
    }
    var joursFeries = ['25-12','1-11', '01-05'];

    //	Calendrier avec les contraintes suivantes : 
    // 		- pas de dimanche
    //		- pas de jours fériés
    //		- pas de jours déjà passés
    $('.dateVisite').datepicker({
        beforeShowDay: function(date) {
            var dimancheMardi = date.getDay();
            var today = new Date();
            var newDate = today.setDate((today.getDate() - 1));
            var jour = $.datepicker.formatDate('dd-mm', date);
            if ($('#commande_typeBillet_0').is(':checked')) {
                if(today.getHours() >= 14) {
                    today.setDate(today.getDate()+1);
                    return [(dimancheMardi !== 0) && (dimancheMardi !== 2) && ($.inArray(jour, joursFeries) == -1) && (newDate < date) && (today < date)];
                }
            }
            return [(dimancheMardi !== 0) && (dimancheMardi !== 2) && ($.inArray(jour, joursFeries) == -1) && (newDate < date)];
        },
        dateFormat: 'yy-mm-dd'
    }).keypress(function(e) {
        e.preventDefault();
    });

});