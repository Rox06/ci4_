(function(){
    /* Evento con JQuery */
    $("tr td #deletelibro").click(function(ev){
        /* Elimina el # en la url */
        ev.preventDefault(); 

        /* data-id viene de libros_view */
        var idlibro = $(this).attr('data-id');
        var base_url = $("input #base_url").val();
        
        Swal.fire({
            title: '¿Estás seguro de eliminar?',
            text: "!No podrás revertir esto.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
            }).
            then((result) => {
                if (result.isConfirmed) {
                    /* Ajax */
                    $.ajax({
                        type: 'POST',
                        url: "Biblioteca/deletelibro",
                        data: {'idlibro':idlibro},
                        success: () => {
                            Swal.fire('Eliminado!', 'Se ha eliminado exitosamente!', 'success');
                            location.reload();   
                        },
                        statusCode: {
                            error: function(){
                                Swal.fire('Algo salió mla al eliminar');
                            }  
                        }
                    }) 
                }
            })
        })    
    })();