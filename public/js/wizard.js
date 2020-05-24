(function ($) {
    var verticalForm = $("#example-vertical-wizard");
    verticalForm.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical",
        onFinished: function (event, currentIndex) {
            $("#example-vertical-wizard").submit();
        },
        labels: {
            cancel: "Annuler",
            current: "current step:",
            pagination: "Pagination",
            finish: "Finir",
            next: "Suivant",
            previous: "Précédent",
            loading: "Chargement",
        },
    });
})(jQuery);
