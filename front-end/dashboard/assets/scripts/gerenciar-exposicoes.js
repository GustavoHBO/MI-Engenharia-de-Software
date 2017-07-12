
// Instancia responsável pelo controle da lista de exposições
var lista_exposicoes = new Vue({
  el: '#lista_exposicoes',
  data: {
    exposicoes: [
        { 
            nome: '',
            titulo: 'Animais Selvagens',
            local: 'Auditório',
            data_inicio: '10/09/2017',
            data_fim: '20/09/2017',
            descricao: ''
        },
    ]
  },
    beforeCreate: function () {
        firebase.auth().onAuthStateChanged(function(user) {
                if (user) {
                    console.log('logado');
                } else {
                    window.location.href = "login.html";
                    // No user is signed in.
                }
            });
    }
})