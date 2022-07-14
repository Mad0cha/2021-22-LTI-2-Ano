
function format_instituicao(d) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        '<tr>' +
        '<td>Segunda:</td>' +
        '<td>' + d.horario.segunda + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Terca:</td>' +
        '<td>' + d.horario.terca + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Quarta:</td>' +
        '<td>' + d.horario.quarta + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Quinta:</td>' +
        '<td>' + d.horario.quinta + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Sexta:</td>' +
        '<td>' + d.horario.sexta + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Sabado:</td>' +
        '<td>' + d.horario.sabado + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Domingo:</td>' +
        '<td>' + d.horario.domingo + '</td>' +
        '</tr>' +
        '</table>';
}

$(document).ready(function () {
    // Caixas de pesquisa tabela voluntario
    $('#tabela_voluntario tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Procurar ' + title + '" />');
    });

    // Caixas de pesquisa tabela instituicao
    i = 0;
    $('#tabela_instituicao tfoot th').each(function () {
        var title = $(this).text();
        if (i == 0) {
            $(this).html('<p>  </p>');
        } else {
            $(this).html('<input type="text" placeholder="Procurar ' + title + '" />');
        }
        i++;
    });

    // Tabela Voluntário
    var tabelaVoluntario = $('#tabela_voluntario').DataTable({
        initComplete: function () {
            this.api().columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-PT.json"
        }
    });

    // Tabela Instituicao
    var tabelaInstituicao = $('#tabela_instituicao').DataTable({
        ajax: {
            // url: 'auxiliares/admin/instituicao-admin.php',
            url: 'instituicao-admin.php',
            dataSrc: 'instituicao'
        },
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: ''
            },
            { data: "nome" },
            { data: "tipo" },
            { data: "descricao" },
            { data: "email" },
            { data: "telefone" },
            { data: "concelho" },
            { data: "freguesia" },
            { data: "distrito" },
            { data: "nome_cont" },
            { data: "tel_cont" }
        ],
        order: [[1, 'asc']],
        initComplete: function () {
            this.api().columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-PT.json"
        }
    });

    // Horario instituicoes
    $('#tabela_instituicao tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = tabelaInstituicao.row(tr);

        if (row.child.isShown()) {
            // fecha a linha
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // expande a linha
            if (row.data().horario.segunda == undefined) {
                row.child('<p>Horário de disponíbilidade ainda não definido.</p>').show();
                tr.addClass('shown');
            } else {
                row.child(format_instituicao(row.data())).show();
                tr.addClass('shown');
            }
        }
    });

});