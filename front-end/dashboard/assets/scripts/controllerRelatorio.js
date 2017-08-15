class ControllerRelatorio {
    constructor() {

    }

    relatorioItem() {
        var lista_relatorio = new Vue({
            el: '#lista_relatorio',
            data: {
                relatorios: [{
                        item: 'Bota de Couro',
                        funcionario: 'Carlos Rodrigues',
                        movimentacao: 'Adição'
                    },
                    {
                        item: 'Carroça de Madeira',
                        funcionario: 'Fernando Guigs',
                        movimentacao: 'Remoção'
                    }
                ]
            },
            methods: {

            }
        });
    }

    relatorioFuncionario() {
        var lista_relatorio = new Vue({
            el: '#lista_relatorio',
            data: {
                relatorios: [{
                        nome: 'Carlos Rodrigues',
                        item: 'Bota de Couro',
                        movimentacao: 'Adição'
                    },
                    {
                        nome: 'Fernando Guigs',
                        item: 'Carroça de Madeira',
                        movimentacao: 'Remoção'
                    }
                ]
            },
            methods: {

            }
        });

    }
}