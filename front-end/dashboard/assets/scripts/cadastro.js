var cadastroPage = new Vue({
    el: '#cadastro',
    data: {
        email: '',
        senha: '',
        senha2: '',
        nome: '',
        sobrenome: ''
    },
    methods: {
        createUser: function (event) {
            event.preventDefault();
            if (this.senha == this.senha2) {
                firebase.auth().createUserWithEmailAndPassword(this.email, this.senha).catch(function (error) {
                    let erro = error.code;
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
                // efetua o login e redireciona para o dashboard
                // cadastra o usuario no banco de dados
                firebase.auth().onAuthStateChanged(function (user) {
                    if (user) {
                        //cadastrar o usuario no banco de dados 

                        // ROTA PARA BANCO LOCAL, SUBSTITUIR PARA SERVIDOR QUANDO DISPONÍVEL ROTABANCOLOCAL
                        $.post("http://localhost:8000/api/public/usuario/new?id=" + user.uid + "&nome=" + this.nome + "&sobrenome=" + this.sobrenome)
                            .done(function (data) {
                                if (data) {
                                    //redirecionando para o dashboard
                                    window.location.href = "index.html?" + this.nome;
                                } else {}
                            }).fail(function (code) {
                                console.log(code);
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Algo deu errado!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Erro ao cadastrar usuario, tente novamente',
                                    class_name: 'gritter-light'
                                });

                            });

                        } else {
                        // No user is signed in.
                    }
                });
            } else {
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Senhas incompatíveis!',
                    // (string | mandatory) the text inside the notification
                    text: 'As duas senhas especificadas devem ser iguais e devem possuir no mínimo 6 caracteres',
                    class_name: 'gritter-light'
                });
            }
        }
    }
})