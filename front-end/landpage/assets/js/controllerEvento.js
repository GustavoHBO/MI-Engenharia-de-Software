class ControllerEvento {
    constructor() {
    }

    listaEventos() {
        var listaEventos = new Vue({
            el: '#lista-eventos',
            data: {
                events: [{
                    titulo: 'Exposição de Obras',
                    artista: 'Fulano',
                    data: '25/04/2017 a 05/05/2017',
                    local: 'Sala do Artesanato',
                    custo: '10',
                    horario: '14 às 16',
                    categoria: 'Exibição Temporária',
                    descricao: 'Exposição de obras sobre a cultura brasileira do século 20',
                    imagem: 'http://placehold.it/300x400'
                },
                {
                    titulo: 'Exposição de Obras',
                    artista: 'Fulano',
                    data: '25/04/2017 a 05/05/2017',
                    local: 'Sala do Artesanato',
                    custo: '10',
                    horario: '14 às 16',
                    categoria: 'Exibição Temporária',
                    descricao: 'Exposição de obras sobre a cultura brasileira do século 20',
                    imagem: 'http://placehold.it/300x400'
                },
                {
                    titulo: 'Exposição de Obras',
                    artista: 'Fulano',
                    data: '25/04/2017 a 05/05/2017',
                    local: 'Sala do Artesanato',
                    custo: '10',
                    horario: '14 às 16',
                    categoria: 'Exibição Temporária',
                    descricao: 'Exposição de obras sobre a cultura brasileira do século 20',
                    imagem: 'http://placehold.it/300x400'
                }]
            },
            methods: {

            }
        });
    }
}