class ControllerEvento {
    constructor() {

    }


    gerenciarEvento() {
        var lista_eventos = new Vue({
            el: '#lista_eventos',
            data: {
                eventos
            },
            methods: {
                editar: (idEvento) => {
                    location.href = "editar-evento.html?evento=" + idEvento;
                },
                desativar: (evento) => {
                    $.post("http://localhost:8000/api/public/evento/desativa", evento).
                    done((data) => {
                        console.log(evento);
                        console.log(data);
                        $.get("http://localhost:8000/api/public/evento", data => {
                            lista_eventos.eventos = data;
                        });
                    }).fail(() => {
                        console.log("error");
                    });
                }
            },
            created: () => {
                //pega lista de eventos
                $.get("http://localhost:8000/api/public/evento", data => {
                    lista_eventos.eventos = data;
                });
            }
        })
    }

    novoEvento() {
        var novoEvento = new Vue({
            el: '#novo-evento',
            data: {
                evento: {
                    titulo: "",
                    local: "",
                    responsavel: "",
                    foto_url: "",
                    artista: "",
                    horario_visitacao: "",
                    data_inicio: "",
                    data_fim: "",
                    categoria: ""
                },
            },
            methods: {
                fotoAdd: (event) => {
                    novoEvento.evento.foto_url = "img.png";
                    /*
                    var file = event.target.files[0];
                    //converter a imagem para BASE64
                    var reader = new FileReader();
                    reader.onloadend = function () {
                        this.evento.foto_url = reader.result;
                    }
                    reader.readAsDataURL(file);
                    */
                },
                cadastrar: () => {

                    $.post("http://localhost:8000/api/public/evento/cadastrar", novoEvento.evento).
                    done((data) => {
                        location.href = "http://localhost:8000/front-end/dashboard/gerenciar-eventos.html";
                    }).fail(() => {
                        console.log("error");
                    });
                }
            }
        });

    }

    editarEvento() {
        var editarEvento = new Vue({
            el: '#editar-evento',
            data: {
                evento: {},
            },
            methods: {
                fotoAdd: (event) => {
                    novoEvento.evento.foto_url = "img.png";
                    /*
                    var file = event.target.files[0];
                    //converter a imagem para BASE64
                    var reader = new FileReader();
                    reader.onloadend = function () {
                        this.evento.foto_url = reader.result;
                    }
                    reader.readAsDataURL(file);
                    */
                },
                salvar: () => {
                    $.post("http://localhost:8000/api/public/evento/editar", editarEvento.evento).
                    done((data) => {
                        console.log(evento);
                        console.log(data);
                        location.href = "http://localhost:8000/front-end/dashboard/gerenciar-eventos.html";
                    }).fail(() => {
                        console.log("error");
                    });
                },
            },
            created: () => {
                let query = location.search.slice(1); //pega a parte depois da ?
                let id = query.split('=')[1]; // pega o id do evento enviado
                console.log(id);
                $.get("http://localhost:8000/api/public/evento/" + id, data => {
                    editarEvento.evento = data;
                    console.log(data);
                });
            }
        });
    }

}