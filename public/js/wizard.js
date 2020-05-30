(function ($) {
    var verticalForm = $("#example-vertical-wizard");
    let submitting = false;
    verticalForm.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical",
        onFinished: function (event, currentIndex) {

            $('.alert').removeClass('show').addClass('d-none');

            if (submitting) return;
            submitting = true;

            let finishBtn = $("#finishbtn").parent(),
                href = finishBtn.attr("href"),
                html = finishBtn.html(),
                errortab = 5;

            finishBtn.attr("href", "");
            finishBtn.empty();
            finishBtn.html('<i class="fas fa-spinner"></i>   ');
            $.ajax({
                url: "/Consultation",
                type: "POST",
                data: $("#example-vertical-wizard").serialize(),
                success: function (resp) {},
                error: function (error) {
                    const response = error.responseJSON;
                    const errors = response.errors;
                    console.log("error : ");
                    console.log(error);

                    if (error.responseJSON.errors) {
                        if (errors.typeConsultation) {
                            $("#TypeError").html(
                                error.responseJSON.errors.typeConsultation
                            );
                            $("#typeAlert")
                                .removeClass("d-none")
                                .addClass("show");
                            if (errortab > 0) errortab = 0;
                        }
                        if (errors.Description) {
                            $("#DescriptionError").html(
                                error.responseJSON.errors.Description
                            );
                            $("#DescriptionAlert")
                                .removeClass("d-none")
                                .addClass("show");
                            if (errortab > 0) errortab = 0;
                        }
                        if (errors.analyses) {
                            $("#analysesError").html(
                                error.responseJSON.errors.analyses
                            );
                            $("#analysesAlert")
                                .removeClass("d-none")
                                .addClass("show");
                            if (errortab > 0) errortab = 0;
                        } ///////
                        //////// /// // 
                        for (var key in errors) {
                            // examens show validation msg
                            if (key.search("ExaValues") != -1 || key.search("ExaTitres") != -1 ) {
                                $("#ExaError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#ExaAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                                if (errortab > 1) errortab = 1;
                            }
                            // OPerations show validation msg
                            if (key.search("Operations") != -1 || key.search("Remarquez") != -1 ) {
                                $("#OpsError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#OpsAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                                if (errortab > 2) errortab = 2;
                            }
                        }
                        /////////////////////
                        ///
                        ////

                        // get error step
                        $("#steps-uid-0-t-" + errortab).click();
                    }
                },
            });
            submitting = false;
            finishBtn.empty();
            finishBtn.attr("href", href);
            finishBtn.append(html);
        },
        labels: {
            cancel: "Annuler",
            current: "current step:",
            pagination: "Pagination",
            finish: ' <i class="fas fa-save" id="finishbtn"></i> Enregistrer',
            next: "Suivant",
            previous: "Précédent",
            loading: "Chargement",
        },
    });
})(jQuery);
