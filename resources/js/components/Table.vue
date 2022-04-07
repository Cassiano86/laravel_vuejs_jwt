<template>
    <table class="table table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th v-for="titulo, key in titulos" :key="key" scope="col">
                    {{titulo.titulo}}
                </th>
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
            </tr>
        </tbody>
    </table>          
</template>

<script>
    export default{
        props: ["marcasRegistradas", 'titulos'],
        
        mounted() {
            console.log('Chegou no mounted da component-table');
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
