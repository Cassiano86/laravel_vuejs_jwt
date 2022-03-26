<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- inicio do card de buscas -->
                    <card-component Titulo="Busca de  Marcas">
                        <template v-slot:Conteudo>
                            <div class="row">
                                <div class="col mb-3">
                                    <input-container-component  Id="inputId" titulo="ID" id-help="IdHelp" texto-ajuda="Opcional. Informe o Id da marca">
                                        <input type="number" min='0' class="form-control" id="inputId"  aria-describedby="IdHelp">
                                    </input-container-component>
                                </div>
                                    
                                <div class="col mb-3">
                                    <input-container-component  Id="inputNome" titulo="Marca" id-help="IdNome" texto-ajuda="Informe a marca">
                                        <input type="text" class="form-control" id="inputNome" aria-describedby="IdNome">
                                    </input-container-component>
                                </div>
                            </div>
                        </template>

                        <template v-slot:rodape>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
                        </template>
                    </card-component>
                <!-- Fim do card de buscas -->

                <!-- inicio do card de listagens -->
                    <card-component Titulo="Relação de  Marcas">
                        <template v-slot:Conteudo>
                            <table-component></table-component>
                        </template>

                        <template v-slot:rodape>
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalMarcas">Adicionar</button>
                        </template>
                    </card-component>
                <!-- Fim do card de listagens -->

                <!-- Componente modal -->
                    <modal-component id="modalMarcas" titulo="Cadastro de marcas">
                        <template v-slot:alerts>
                            <alert-component tipo="success" :mensagemRetorno="mensagemRetorno" :titulo="situacaoCadastro" v-if="situacaoCadastro == 'Sucesso'"></alert-component>
                            <alert-component tipo="danger"  :mensagemRetorno="mensagemRetorno" :titulo="situacaoCadastro" v-if="situacaoCadastro == 'Erro'"></alert-component>
                        </template>

                        <template v-slot:conteudo>
                            <input-container-component titulo="Nome da marca" Id="novoNome" textoAjuda="Informe o nome da marca" idHelp="novoNomeHelp">
                                <input type="text" name="novoNome" id="novoNome" class="form-control" aria-describedby="novoNomeHelp" placeholder="Nome da marca" v-model="nomeMarca">
                            </input-container-component>

                            <input-container-component titulo="Logo da marca" Id="novaImagem" textoAjuda="Somente imagens no formato PNG" idHelp="novaImagemHelp">
                                <input type="file" name="novaImagem" id="novaImagem" class="form-control-file" aria-describedby="novaImagemHelp" placeholder="Nome da marca" @change="carregarImagem($event)">
                            </input-container-component>
                        </template>

                        <template v-slot:rodape>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="salvar()">Save changes</button>
                        </template>
                    </modal-component>
                <!-- Componente modal -->

            </div>
        </div>
    </div>
</template>

<script>
    export default{
        computed: {
            token() {
                let token = document.cookie.split('; ').find(row => row.startsWith('token=')).split('=')[1];

                return 'bearer '+token;
            }
        },
        data() {
            return {
                urlBase: "http://localhost:8000/api/v1/marca",
                nomeMarca : '',
                arquivosImagem : [], //Podendo receber mais de um arquivo
                situacaoCadastro : '',
                mensagemRetorno: []
            }
        },

        methods:{
            carregarImagem(e){
                this.arquivosImagem = e.target.files //Forma de recuperar arquivos com o Vuejs
            },

            salvar(){
                //Gerando os dados do formulário
                let formData = new FormData();
                formData.append('nome', this.nomeMarca);
                formData.append('imagem', this.arquivosImagem[0]);

                //Cabeçalhos de envio ao axios
                let config = {
                    headers : {
                        "Content-Type" : "multipart/form-data",
                        "Accept"       : "application/json",
                        'Authorization': this.token
                    }
                }

                //Criando uma requisição post com o axios
                axios.post(this.urlBase, formData, config)
                     .then(response => {
                         this.situacaoCadastro = 'Sucesso';
                         this.mensagemRetorno = response;
                         console.log(response);
                     })
                     .catch(errors => {
                         this.situacaoCadastro = 'Erro';
                         this.mensagemRetorno = errors;
                         console.log(errors);
                     });
                
            }
        }
    }
</script>
