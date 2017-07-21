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
            console.log(error.code);
            console.log(this.email)
            console.log(this.senha)
        })
    }
  }
})