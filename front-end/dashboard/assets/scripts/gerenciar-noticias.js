

// Instancia responsável pelo controle da lista de noticias
var lista_eventos = new Vue({
  el: '#lista_noticias',
  data: {
    noticias: [
        { 
            titulo: 'Novos itens chegam ao museu',
            data: '10/09/2017',
            escritor: 'Ricardo Nogueira'
        },
    ]
  }
})