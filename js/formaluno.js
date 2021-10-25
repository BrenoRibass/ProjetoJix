//Ajax para envio do documento do aluno
$(document).on('submit', '#form_aluno', function() {
    var dados = new FormData(this);
    var tabela = $('#nome').val();
    var valorNegociado = $('#nome').val();


    $.ajax({
        url: 'form_alunos.php',
        type: 'POST',
        data: dados,
        dataType: 'json',
        processData: false,
        cache: false,
        contentType: false,
        async: true,
        success: function(data) {
            if (data.sucesso == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Dados enviados com sucesso!',
                    showConfirmButton: false,
                    timer: 4500,
                    footer: '<a href="view_aluno.php?id=' + data.id_aluno + '">Ver seus documentos</a>'

                })
                document.getElementById('form_aluno').reset();
            }
        }
    });

    return false;
})