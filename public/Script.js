



$(document).ready(function() {
    $('#testimonialForm').on('submit', function(e) {
        e.preventDefault(); // Empêcher l'envoi classique du formulaire

        $.ajax({
            url: $(this).attr('action')
            , method: $(this).attr('method')
            , data: $(this).serialize()
            , success: function(response) {
                // Afficher le message de succès
                $('#testimonialModal').modal('hide'); // Fermer le modal

                    // Réinitialiser les champs du formulaire
                    $('#testimonialForm')[0].reset();


                $('#successMessage').text(
                    'Témoignage créé avec succès! Il sera valide après confirmation des administrateurs'
                ).show();

             

                setTimeout(function() {
                    location.reload();
                }, 100);
            }
            , error: function(response) {
                // Afficher un message d'erreur si nécessaire
                $('#errorMessage').text('Une erreur est survenue.')
                    .show(); // Afficher le message d'erreur
            }
        });
    });
});

/* Table réservations */




