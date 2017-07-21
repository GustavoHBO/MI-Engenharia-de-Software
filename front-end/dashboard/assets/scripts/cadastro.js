var cadastroPage = new Vue({
  el: '#cadastro',
  data: {
    email: '',
    senha: '',
    senha2: '',
    nome: '',
    sobrenome: ''
  },
  methods:{
    createUser: function (event) {
        event.preventDefault();
        firebase.auth().createUserWithEmailAndPassword(this.email, this.senha).catch(function (error) {
            let erro = error.code;
            if(erro == 'auth/weak-password'){
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Senha muito fraca!',
                    // (string | mandatory) the text inside the notification
                    text: 'A senha deve conter no mínimo 8 caracteres',
                    class_name: 'gritter-light'
                });
            } else if(erro == 'auth/email-already-in-use'){
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'E-mail inválido!',
                    // (string | mandatory) the text inside the notification
                    text: 'Este e-mail já se encontra em uso',
                    class_name: 'gritter-light'
                });
            }
        })
    }
  }
})