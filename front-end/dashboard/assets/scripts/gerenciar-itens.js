
// Instancia responsável pelo controle da lista de noticias
var lista_item = new Vue({
  el: '#lista_item',
  data: {
    itens: [
        { 
            titulo: 'Chapeu da independencia',
            classificacao: 'Coisa Velha',
            categoria: 'Colonial'
        },
        { 
            titulo: 'Miniatura de boi',
            classificacao: 'Bom',
            categoria: 'Colonial'
        },
        { 
            titulo: 'Espingarda',
            classificacao: 'Não sei',
            categoria: 'Ditadura'
        },
        { 
            titulo: 'Carroça de Madeira',
            classificacao: 'Coisa Velha',
            categoria: 'Automotivo'
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
});
