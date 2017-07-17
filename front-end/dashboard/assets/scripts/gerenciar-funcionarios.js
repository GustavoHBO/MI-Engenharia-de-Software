var lista_funcionarios = new Vue({
  el: '#lista_funcionarios',
  data: {
    funcionarios: [
    {
        nome: 'Carlos Rodrigues',
        email: 'carlosrodrigues2008@hotmail.com',
        gerencia_itens: true,
        gerencia_eventos: true,
        gerencia_noticias: true
    },
    {
        nome: 'Maikon Filho',
        email: 'maikonfilhooo@hotmail.com',
        gerencia_itens: true,
        gerencia_eventos: false,
        gerencia_noticias: false
    }
    ]
},
beforeCreate: function () {
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            console.log(user.name);
        } else {
            window.location.href = "login.html";
            // No user is signed in.
        }
    });
}
});
