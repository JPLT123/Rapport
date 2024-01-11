<script>
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            toast:true,
            title: event.detail.message || "Opération effectuée avec succès!",
            showConfirmButton: false,
            timer: 5000
        })
    });

    window.addEventListener("showWarningMessage", event=>{
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            toast:true,
            title: event.detail.message || "Opération effectuée avec succès!",
            showConfirmButton: false,
            timer: 5000
        })
    });

    window.addEventListener("showInfoMessage", event=>{
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            toast:true,
            title: event.detail.message || "Opération effectuée avec succès!",
            showConfirmButton: false,
            timer: 5000
        })
    });

    window.addEventListener("confirmation", event=>{
        Swal.fire({
            title: 'Êtes-vous sûre',
            text: event.detail.text,
            icon: event.detail.type ? event.detail.type : 'warning' ,
            buttonsStyling: true,
            showCancelButton: true,
            cancelButtonText: "Non, Fermer",
            confirmButtonText: "Oui, Continuer",
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            customClass: {
                confirmButton: "btn btn-info",
                cancelButton: "btn btn-danger",
            },
        }).then((result) => {
            if(result.isConfirmed){
                // alert('okay')
                // window.livewire.emit('delete_user', event.detail.id)
                // window.livewire.emit(event.detail.fonction, event.detail.id)
                Livewire.dispatch(event.detail.fonction, {slug: event.detail.id })
            }
        })
    })


    window.addEventListener("showErrorMessage", event=>{
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            toast:true,
            title: event.detail.message || "Echec d'opération verifier que l'utlisateur est actif !",
            showConfirmButton: false,
            timer: 5000
            }
        )
    })

    window.addEventListener("successEvent", event=>{
        swal.fire({
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            })
    })

    window.addEventListener("infoEvent", event=>{
        swal.fire({
                icon: 'info',
                title: 'Page en cours de construction',
                html: 'Nous travaillons actuellement sur cette page et elle ne sera pas disponible pour le moment. Veuillez revenir ultérieurement.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            })
    })
</script>