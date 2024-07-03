document.addEventListener('DOMContentLoaded', function () {

    let calendarEl = document.getElementById('calendar');
    let msgViewEvento = document.getElementById('msgViewEvento');
    const cadastrarModal = new bootstrap.Modal($('#cadastrarModal'));
    const visualizarModal = new bootstrap.Modal($('#visualizarModal'));
    let calendar = new FullCalendar.Calendar(calendarEl, {

        themeSystem: 'bootstrap5',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale: 'pt-br',
        initialDate: '2024-07-02',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        select: function (arg) {
            let title = prompt('Event Title:');
            if (title) {
                calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                });
            }
            calendar.unselect();
        },
        eventClick: function (arg) {
            if (confirm('Are you sure you want to delete this event?')) {
                arg.event.remove();
            }
        },
        editable: true,
        dayMaxEvents: true,
        events: 'listar_evento.php',

        eventClick: function (info) {

            $('#editarModalLabel').hide()
            $('#editarEvento').hide()

            $('#visualizarEvento').show()
            $('#visualizarModalLabel').show()

            $('#visualizar_id').text(info.event.id);
            $('#visualizar_title').text(info.event.title);
            $('#visualizar_descricao').text(info.event.extendedProps.descricao);
            $('#visualizar_start').text(info.event.start.toLocaleString());
            $('#visualizar_end').text(info.event.end !== null ? info.event.end.toLocaleString() : info.event.start.toLocaleString());
            $('#visualizar_status').text(info.event.extendedProps.status);

            $('#edit_id').val(info.event.id);
            $('#edit_title').val(info.event.title);
            $('#edit_descricao').val(info.event.extendedProps.descricao);
            $('#edit_color').val(info.event.backgroundColor);
            $('#edit_start').val(info.event.start = converterData(info.event.start));
            $('#edit_end').val(info.event.end !== null ? converterData(info.event.end) : converterData(info.event.end));

            visualizarModal.show();
        },

        select: function (info) {
            $('#cad_start').val(converterData(info.start));
            $('#cad_end').val(converterData(info.start));
            cadastrarModal.show();
        },

    });

    calendar.render();

    function converterData(data) {
        const dataObj = new Date(data);
        const ano = dataObj.getFullYear();
        const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
        const dia = String(dataObj.getDate()).padStart(2, '0');
        const hora = String(dataObj.getHours()).padStart(2, '0');
        const minuto = String(dataObj.getMinutes()).padStart(2, '0');
        return `${ano}-${mes}-${dia} ${hora}:${minuto}`;
    }

    const formCadEvento = $("#formCadEvento");
    const msg = $("#msg");
    const msgCadEvento = $("#msgCadEvento");
    const btnCadEvento = $("#btnCadEvento");

    function removerMsg() {
        setTimeout(() => {
            $('#msg').html("");
        }, 3000);
    }

    if (formCadEvento.length) {
        formCadEvento.on("submit", async (e) => {
            e.preventDefault();
            btnCadEvento.val("Salvando...");
            const dadosForm = new FormData(formCadEvento[0]);
            const dados = await fetch("cadastrar_evento.php", {
                method: "POST",
                body: dadosForm
            });
            const resposta = await dados.json();
            if (!resposta.status) {
                msgCadEvento.html(`<div class="alert alert-danger" role="alert">${resposta.msg}</div>`);
            } else {
                msg.html(`<div class="alert alert-success" role="alert">${resposta.msg}</div>`);
                msgCadEvento.html("");
                formCadEvento[0].reset();
                const novoEvento = {
                    id: resposta.id,
                    title: resposta.title,
                    color: resposta.color,
                    start: resposta.start,
                    end: resposta.end,
                    descricao: resposta.descricao,
                };
                calendar.addEvent(novoEvento);
                removerMsg();
                cadastrarModal.hide();
                btnCadEvento.val("Cadastrar");
            }
        });
    }

    const btnViewEditEvento = $('#btnViewEditEvento');

    if (btnViewEditEvento.length) {
        btnViewEditEvento.on('click', () => {
            $('#visualizarEvento').hide();
            $('#visualizarModalLabel').hide();
            $('#editarModalLabel').show();
            $('#editarEvento').show();
        });
    }

    const btnViewEvento = $('#btnViewEvento');

    if (btnViewEvento.length) {
        btnViewEvento.on('click', () => {
            $('#editarModalLabel').hide();
            $('#editarEvento').hide();
            $('#visualizarEvento').show();
            $('#visualizarModalLabel').show();
        });
    }

    const formEditEvento = $("#formEditEvento");
    const msgEditEvento = $("#msgEditEvento");
    const btnEditEvento = $("#btnEditEvento");

    if (formEditEvento.length) {
        formEditEvento.on("submit", async (e) => {
            e.preventDefault();
            btnEditEvento.val("Salvando...");
            const dadosForm = new FormData(formEditEvento[0]);
            const dados = await fetch("editar_evento.php", {
                method: "POST",
                body: dadosForm
            });
            const resposta = await dados.json();
            if (!resposta.status) {
                msgEditEvento.html(`<div class="alert alert-danger" role="alert">${resposta.msg}</div>`);
            } else {
                msg.html(`<div class="alert alert-success" role="alert">${resposta.msg}</div>`);
                msgEditEvento.html("");
                formEditEvento[0].reset();
                const eventoExiste = calendar.getEventById(resposta.id);
                if (eventoExiste) {
                    eventoExiste.setProp('title', resposta.title);
                    eventoExiste.setProp('color', resposta.color);
                    eventoExiste.setExtendedProp('descricao', resposta.descricao);
                    eventoExiste.setStart(resposta.start);
                    eventoExiste.setEnd(resposta.end);
                    eventoExiste.setExtendedProp('status', resposta.status);
                }
                removerMsg();
                visualizarModal.hide();
            }
            btnEditEvento.val("Salvar");
        });
    }

    const btnApagarEvento = $("#btnApagarEvento");

    if (btnApagarEvento.length) {
        btnApagarEvento.on("click", async () => {
            const confirmacao = window.confirm("Tem certeza de que deseja apagar este evento?");
            if (confirmacao) {
                let idEvento = $("#visualizar_id").text();
                const dados = await fetch("apagar_evento.php?id=" + idEvento);
                const resposta = await dados.json();
                if (!resposta.status) {
                    $("#msgViewEvento").html(`<div class="alert alert-danger" role="alert">${resposta.msg}</div>`);
                } else {
                    msg.html(`<div class="alert alert-success" role="alert">${resposta.msg}</div>`);
                    $("#msgViewEvento").html("");
                    const eventoExisteRemover = calendar.getEventById(idEvento);
                    if (eventoExisteRemover) {
                        eventoExisteRemover.remove();
                    }
                    removerMsg();
                    visualizarModal.hide();
                }
            }
        });
    };
});