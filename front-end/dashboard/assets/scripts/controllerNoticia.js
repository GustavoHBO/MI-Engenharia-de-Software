class ControllerNoticia {
   constructor() {

    }

    gerenciarNoticia() {
        var pesquisa = new Vue({
            el: '#lista_noticias',
            data: {
                noticias: {},
                pesquisa: "",
            },
            methods: {
                editar: (idNoticia) => {
                    location.href = "editar-noticia.html?noticia=" + idNoticia;
                },
                pesquisar: () => {
                    $.get("http://localhost:8000/api/public/noticia/buscar/" + pesquisa.pesquisa, data => {
                    lista_noticias.noticias = data;
                });
                }
            },
            created: () => {
                //pega lista de usuarios
                $.get("http://localhost:8000/api/public/noticia/listar", data => {
                    lista_noticias.noticias = data;
                });
            }
        })
    }

    novaNoticia() {
       var novaNoticia = new Vue({
            el: '#nova-noticia',
            data: {
                noticia: {
                    titulo: '',
                    descricao: '',
                    foto_url: '',
                    id_usuario: '',
                 },
            },
            methods: {
                cadastrar: () => {
                    novaNoticia.noticia.id_usuario = firebase.auth().currentUser.uid;
                    $.post("http://localhost:8000/api/public/noticia/cadastrar", novaNoticia.novaNoticia).
                    done((data) => {
                        location.href = "http://localhost:8000/gerenciar-noticias.html";
                    }).fail(() => {
                        console.log("error");
                    });

                },
                fotoAdd: (event) => {
                    novaNoticia.noticia.foto_url = "img.png";
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
            },
        });

    }

    editarNoticia(){
         var editarNoticia = new Vue({
            el: '#editar-noticia',
            data: {
            },
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