class ControllerRelatorio {
    constructor() {

    }

    relatorioItem() {
        var lista_relatorio = new Vue({
            el: '#lista_relatorio',
            data: {
                relatorios: [{
                        item: 'Bota de Couro',
                        funcionario: 'João Borges',
                        movimentacao: 'Adição'
                    },
                    {
                        item: 'Carroça de Madeira',
                        funcionario: 'João Borges',
                        movimentacao: 'Remoção'
                    }
                ]
            },
            methods: {

            },
            /*created: () => {
                //Pega a lista de relatórios
                $.get("http://localhost:8000/api/public/usuario", data => {
                    lista_relatorio.relatorios = data;
                });
            }*/
        });
    }

    relatorioFuncionario() {
        var lista_relatorio = new Vue({
            el: '#lista_relatorio',
            data: {
                relatorios: [{
                    nome: 'João Borges',
                        item: 'Bota de Couro',
                        movimentacao: 'Adição'
                    },
                    {
                        nome: 'João Borges',
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