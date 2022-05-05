$document

const swal =  $('.swal').data('swal');
if(swal){
    swal.fire({
        title: 'Seguro que deses eliminar?',
        text: swal,
        icon: 'success'
        })
}
$(document).on('click', 'btn-eliminar', function(ev){

    var idlibro = $(this).data('id_libro')

    ev.preventDefault();
    const href = $(this).attr('href');

    swal.fire({
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
            document.location.href = href;
        }
    })
})