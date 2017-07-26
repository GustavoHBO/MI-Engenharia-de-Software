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
                desativar: () => {

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
                    this.evento.foto_url = "img.png";
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
                    $.post("http://localhost:8000/api/public/evento/cadastrar?titulo="+ novoEvento.titulo +
                    "&local="+ novoEvento.local + "&responsavel=" + novoEvento.responsavel + "&foto_url="+ novoEvento.foto_url + "&artista=" + novoEvento.artista + 
                    "&horario_visitacao="+ novoEvento.horario_visitacao + "&data_inicio="+ novoEvento.data_inicio + "&data_fim="+ novoEvento.data_fim + "&categoria=" + novoEvento.categoria).
                    done( (data) => {
                        console.log(evento);
                        console.log(data);
                    }).fail( () => {
                        console.log("error");
                    });
                }
            }
        });

    }

    editarEvento() {
        var editarEvento = new Vue({
            el: '#editar-evento',
            data: {},
            methods: {

            },
            created: () => {
                let query = location.search.slice(1); //pega a parte depois da ?
                let id = query.split('=')[1]; // pega o id do evento enviado
                console.log(id);
            }
        });
    }

}