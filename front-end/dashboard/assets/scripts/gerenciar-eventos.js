

// Instancia responsável pelo controle da lista de eventos
var lista_eventos = new Vue({
  el: '#lista_eventos',
  data: {
    eventos: [
        { 
            titulo: 'Palestra - Manutenção de itens',
            local: 'Auditório',
            data_inicio: '10/09/2017',
            data_fim: '20/09/2017'
        },
        { 
            titulo: 'Passeio - Colegio Pirralhos',
            local: 'Ala A',
            data_inicio: '15/10/2017',
            data_fim: '15/10/2017'
        }
    ]
  }
})
