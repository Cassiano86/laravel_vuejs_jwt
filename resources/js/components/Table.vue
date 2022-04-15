<template>
    <table class="table table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th v-for="titulo, key in titulos" :key="key" scope="col">
                    {{titulo.titulo}}
                </th>
                <th v-if="visualizar.exibir || atualizar || deletar.exibir">Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="obj, chave in objetosFiltrados" :key="chave">
                <td v-for="valor, chaveIndice in obj" :key="chaveIndice">
                    <!-- Verificando qual o tipo de dado está sendo retornado -->
                    <span v-if="titulos[chaveIndice].tipo == 'texto'">{{valor}}</span>
                    <span v-if="titulos[chaveIndice].tipo == 'imagem'">
                        <img :src="'../storage/'+valor" alt="Imagem seletiva" width="50" height="50">
                    </span>
                    <span v-if="titulos[chaveIndice].tipo == 'data'">{{valor}}</span>
                </td>
                <td>
                    <button v-if="visualizar.exibir" class="btn btn-outline-success" :data-toggle="visualizar.dataToggle" :data-target="visualizar.dataTarget" @click="setItems(obj)">Visualizar</button>

                    <button v-if="atualizar" class="btn btn-outline-primary">Atualizar</button>

                    <button v-if="deletar.exibir" class="btn btn-outline-danger" :data-toggle="deletar.dataToggle" :data-target="deletar.dataTarget" @click="setItems(obj)">Deletar</button>
                </td>
            </tr>
        </tbody>
    </table>          
</template>

<script>
    export default{
        props: ["marcasRegistradas", 'titulos', 'visualizar', 'atualizar', 'deletar'],
        
        methods: {
            setItems(obj){
                //Passando o valor do obj para o componente vuex
                this.$store.state.item = obj;

                //Retonando a normalidad de um state
                this.$store.state.transacao.status   = '';
                this.$store.state.transacao.mensagem = '';
            }
        },

        mounted() {
            //console.log('Chegou no mounted da component-table');
        },

        computed: {
            objetosFiltrados() {
                //Recuperando os campos do objeto titulo
                let campos = Object.keys(this.titulos);
                let dadosRetorno = [];

                //Percorrendo os dados de marcasRegistradas
                this.marcasRegistradas.map((valor , chave) => {
                    let itemFiltrado = {};
                    
                    campos.forEach(campo => {
                        itemFiltrado[campo] = valor[campo];
                    });

                    //Passando os dados a cada iteração com o objeto
                    dadosRetorno.push(itemFiltrado);
                });
                
                return dadosRetorno;
            }
        }
    }
</script>
