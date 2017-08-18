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
                    $.post("http://localhost:8000/api/public/funcionario/desativar?id=" + idFuncionario)
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
                                    text: 'Erro ao deletar funcionario, tente novamente',
                                    class_name: 'gritter-light'
                                });
                            }
                        }).fail(function () {
                            window.scrollTo(0, 0); //subir a página
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Ocorreu um erro!',
                                // (string | mandatory) the text inside the notification
                                text: 'Erro ao deletar funcionario, tente novamente',
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
        var funcionarioPage = new Vue({
            el: '#novo-funcionario',
            data: {
                funcionario: {
                    id: '',
                    nome: '',
                    sobrenome: '',
                    email: '',
                    senha: '',
                    gerenciar_itens: false,
                    gerenciar_eventos: false,
                    gerenciar_noticias: false,
                },
                repsenha: "",
                erro: false,
            },
            methods: {
                cadastrar: () => {
                    console.log(funcionarioPage.funcionario);
                    if (funcionarioPage.funcionario.senha == funcionarioPage.repsenha) {
                        var user = firebase.auth().createUserWithEmailAndPassword(funcionarioPage.funcionario.email, funcionarioPage.funcionario.senha).catch(function (error) {
                            let erro = error.code;
                            console.log(error);
                            funcionarioPage.funcionario.erro = true;
                            if (erro == 'auth/weak-password') {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Senha muito fraca!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'A senha deve conter no mínimo 6 caracteres',
                                    class_name: 'gritter-light'
                                });
                            } else if (erro == 'auth/email-already-in-use') {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'E-mail inválido!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Este e-mail já se encontra em uso',
                                    class_name: 'gritter-light'
                                });
                            }
                        });
                        console.log(user)
                        if (!funcionarioPage.funcionario.erro) {
                            funcionarioPage.funcionario.id = user.uid;
                            $.post("http://localhost:8000/api/public/funcionario/new", funcionarioPage.funcionario).
                                done((data) => {
                                    location.href = "http://localhost:8000/front-end/dashboard/gerenciar-funcionarios.html";
                                }).fail(() => {
                                    console.log("error");
                                });
                        }
                    }
                    
                } 
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