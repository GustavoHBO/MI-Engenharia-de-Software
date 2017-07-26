class ControllerFuncionario {
    constructor() {

    }


    gerenciarFuncionario() {
        var lista_funcionarios = new Vue({
            el: '#lista_funcionarios',
            data: {
                funcionarios: {}
            },
            methods: {
                editar: (idFuncionario) => {
                    location.href = "editar-funcionario.html?funcionario=" + idFuncionario;
                },
                desativar: (idFuncionario) => {
                    $.post("http://localhost:8000/api/public/funcionario/desativar?id=" + idUsuario)
                        .done(function (data) {
                            if (data) {
                                $.get("http://localhost:8000/api/public/funcionario", data => {
                                    lista_funcionarios.funcionarios = data;
                                });
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Sucesso',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Funcionário desativado com sucesso',
                                    class_name: 'gritter-light'
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
                $.get("http://localhost:8000/api/public/funcionario", data => {
                    lista_funcionarios.funcionarios = data;
                });
            }
        });
    }

    novoFuncionario() {
        var NovoFuncionarioPage = new Vue({
            el: '#novo-funcionario',
            data: {
                nome,
                sobrenome,
                email,
                senha,
                gerenciar_itens,
                gerenciar_eventos,
                gerenciar_noticias,
            },
            methods: {

            },
        });

    }

    editarFuncionario() {
        var editarFuncionario = new Vue({
                el: '#editar-fucionario',
                data: {
                    funcionario,
                },
                methods: {

                },
                created: () => {
                    let query = location.search.slice(1); //pega a parte depois da ?
                    let id = query.split('=')[1]; // pega o id do evento enviado
                    $.get("http://localhost:8000/api/public/funcionario/" + id, data => {
                    editarFuncionario.funcionario = data;
                });
                }

            });
        }
}