$(document).ready(function () {
    //edit data
    $('.edit').on("click", function () {
        var id = $(this).attr('data-id');

        $('#modal-edit').modal('show');
        $('#idport').text(id);
        $('#id_port').val(id);
    });

});
