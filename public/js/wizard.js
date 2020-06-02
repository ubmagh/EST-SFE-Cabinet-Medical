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
            let formy = document.getElementById('example-vertical-wizard');
            var fd = new FormData(formy);
            $.ajax({
                url: "/Consultation",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function (resp) {
                    if(resp.status=="Good"){
                        $('#steps-uid-0-p-5').empty();
                        for(let i=0;i<5;i++)
                            $("#steps-uid-0-t-" + i).attr('href','');
                            $('#steps-uid-0-p-5').append(` <div class="row w-100 text-center my-3" > <a href="`+resp.ordonnanceurl+`" class="btn btn-info text-center mx-auto"> <h3 class="h3"> <i class="fas fa-print"></i> Imprimer l'ordonnance </h3> </a> </div> `);
                            $('#steps-uid-0-p-5').append(` <div class="row w-100 text-center my-3" > <a href="`+'{{ url("/Consultation") }}'+`" class="btn btn-info text-center mx-auto"> <h3 class="h3"> <i class="fas fa-arrow-right"></i> Patient suivant </h3> </a> </div> `);
                            $('.actions.clearfix').addClass('d-none');
                    }
                },
                error: function (error) {
                    const response = error.responseJSON;
                    const errors = response.errors;

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
                            if (key.search("medicament") != -1 || key.search("unites") != -1 || key.search("Periods") != -1 ) {
                                $("#MedsError").html()? null:$("#MedsError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#MedsAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                                if (errortab > 3) errortab = 3;
                            }
                            if (key.search("Files") != -1 ) {
                                $("#fileError").html()? null:$("#fileError").html(
                                    error.responseJSON.errors[key]
                                );
                                $("#fileAlert")
                                    .removeClass("d-none")
                                    .addClass("show");
                                if (errortab > 4) errortab = 4;
                            }
                        }
                        /////////////////////
                        ///
                        ////
                        if (errors.AddContent) {
                            $("#ContentError").html(
                                error.responseJSON.errors.AddContent
                            );
                            $("#ContentAlert")
                                .removeClass("d-none")
                                .addClass("show");
                            if (errortab > 3) errortab = 3;
                        }
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
