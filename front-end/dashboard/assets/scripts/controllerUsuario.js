class ControllerUsuario {
    constructor() {

    }

    gerenciarUsuario() {
        var lista_usuarios = new Vue({
            el: '#lista_usuarios',
            data: {
                usuarios: {}
            },
            methods: {
                /*editar: (idUsuario) => {
                    location.href = "editar-usuario.html?id=" + idUsuario;
                },*/
                desativar: (idUsuario) => { // função para desativar o usuario
                    $.post("http://localhost:8000/api/public/usuario/deletar?id=" + idUsuario)
                        .done(function (data) {
                            if (data) {
                                $.get("http://localhost:8000/api/public/usuario", data => {
                                    lista_usuarios.usuarios = data;
                                });
                            } else {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Ocorreu um erro!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Erro ao deletar usuario, tente novamente',
                                    class_name: 'gritter-light'
                                });
                            }
                        }).fail(function () {
                            window.scrollTo(0, 0); //subir a página
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Ocorreu um erro!',
                                // (string | mandatory) the text inside the notification
                                text: 'Erro ao deletar usuario, tente novamente',
                                class_name: 'gritter-light'
                            });
                        });
                }
            },
            created: () => {
                //pega lista de usuarios
                $.get("http://localhost:8000/api/public/usuario", data => {
                    lista_usuarios.usuarios = data;
                });
            }
        })
    }

    editarUsuario() {
        var editarUsuario = new Vue({
            el: '#editar-usuario',
            data: {
                usuario
            },
            methods: {

            },
            created: () => {
                let query = location.search.slice(1); //pega a parte depois da ?
                let id = query.split('=')[1]; // pega o id do usuario enviado
                $.get("http://localhost:8000/api/public/usuario/" + id, data => {
                    usuario = data;
                });
            }
        });
    }
}