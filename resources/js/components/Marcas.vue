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
                                        <input type="number" min='0' class="form-control" id="inputId"  aria-describedby="IdHelp" v-model="campoBusca.id">
                                    </input-container-component>
                                </div>
                                    
                                <div class="col mb-3">
                                    <input-container-component  Id="inputNome" titulo="Marca" id-help="IdNome" texto-ajuda="Informe a marca">
                                        <input type="text" class="form-control" id="inputNome" aria-describedby="IdNome" v-model="campoBusca.nome">
                                    </input-container-component>
                                </div>
                            </div>
                        </template>

                        <template v-slot:rodape>
                            <button type="submit" class="btn btn-primary btn-sm float-right" @click="buscarMarcas()">Pesquisar</button>
                        </template>
                    </card-component>
                <!-- Fim do card de buscas -->

                <!-- inicio do card de listagens -->
                    <card-component Titulo="Relação de  Marcas">
                        <template v-slot:Conteudo>
                            <!-- listaMarcas.data está sendo passado por paginação, caso não fosse
                            feita a paginação bastaria retirar o .data -->
                            <table-component 
                                :marcasRegistradas="listaMarcas.data"
                                
                                :visualizar="{
                                                exibir      : true, 
                                                dataToggle  : 'modal', 
                                                dataTarget  : '#modalMarcaVisualizar'
                                            }"

                                :atualizar="true"

                                :deletar="{ 
                                            exibir : true,
                                            dataToggle : 'modal',
                                            dataTarget : '#modalMarcaDeletar'
                                          }"

                                :titulos="{
                                    id      : {titulo : 'Registro',     tipo : 'texto'},
                                    nome    : {titulo : 'Nome',   tipo : 'texto'},
                                    imagem  : {titulo : 'Imagem', tipo : 'imagem'},
                                }"
                            >
                            </table-component>
                        </template>

                        <template v-slot:rodape>
                            <div class="row">
                                <div class="col-10">
                                    <pagination-component>
                                        <template v-slot:pagination_slot>
                                            <li v-for="valor, key in listaMarcas.links" :key="key" :class="valor.active ? 'page-item active' : 'page-item'" @click="paginacao(valor)">
                                                <a class="page-link" v-html="valor.label" style="cursor:pointer;"></a>
                                            </li>
                                        </template>
                                    </pagination-component>
                                </div>

                                <div class="col-2">
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalMarcas">Adicionar</button>
                                </div>
                            </div>
                        </template>
                    </card-component>
                <!-- Fim do card de listagens -->

                <!-- Componente modal para adicionar marcas -->
                    <modal-component id="modalMarcas" titulo="Cadastro de marcas">
                        <template v-slot:alerts>
                            <alert-component tipo="success" :mensagemRetorno="mensagemRetorno" :situacao="situacaoCadastro" titulo="Cadastro realizado com sucesso" v-if="situacaoCadastro == 'Sucesso'"></alert-component>
                            <alert-component tipo="danger"  :mensagemRetorno="mensagemRetorno" :situacao="situacaoCadastro" titulo="Erro ao cadastrar nova marca" v-if="situacaoCadastro == 'Erro'"></alert-component>
                        </template>

                        <template v-slot:conteudo>
                            <input-container-component titulo="Nome da marca" Id="novoNome" textoAjuda="Informe o nome da marca" idHelp="novoNomeHelp">
                                <input  type="text" name="novoNome" id="novoNome" class="form-control" aria-describedby="novoNomeHelp" placeholder="Nome da marca" v-model="nomeMarca">
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

                <!-- Modal de visualização de marcas -->
                    <modal-component id="modalMarcaVisualizar" titulo="Registro de marca">
                        <template v-slot:alerts>
                        </template>

                        <template v-slot:conteudo>
                            <input-container-component titulo="Id" Id="idMarca" textoAjuda="Registro da marca" idHelp="MarcaId">
                                <input v-if="$store.state.item.id" type="text" name="idMarca" id='idMarca' class='form-control' :value="$store.state.item.id" aria-describedby="MarcaId" placeholder="Registro da marca"  disabled/>
                            </input-container-component>

                            <input-container-component  Id='nomeMarca' titulo="Nome" textoAjuda="Nome da marca" idHelp="MarcaNome">
                                <input v-if="$store.state.item.nome" type="text" id='nomeMarca' name='nomeMarca' class='form-control' :value="$store.state.item.nome" aria-describedby="MarcaNome" placeholder="Nome da marca" disabled />
                            </input-container-component>

                            <input-container-component Id='imagem' titulo="Imagem" textoAjuda="Logotipo" idHelp="Marcaimagem">
                                <img v-if="$store.state.item.imagem" :src="'storage/'+$store.state.item.imagem" class='img-fluid d-block mx-auto w-50'/>
                            </input-container-component>
                        </template>

                        <template v-slot:rodape>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </template>
                    </modal-component>
                <!-- Modal de visualização de marcas -->

                <!-- Modal de remoção de marcas -->
                    <modal-component id="modalMarcaDeletar" titulo="Deletar de marca">
                        <template v-slot:alerts>
                            <alert-component v-if="$store.state.transacao.status == 'sucesso'" estilo="success" tipo="success" titulo="Sucesso" :mensagemRetorno="$store.state.transacao"></alert-component>

                            <alert-component v-if="$store.state.transacao.status == 'erro'" tipo="danger" estilo="danger" titulo="Erro ao excluir marca" :mensagemRetorno="$store.state.transacao"></alert-component>
                        </template>

                        <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">
                            <input-container-component titulo="Id" Id="idMarca" textoAjuda="Registro da marca" idHelp="MarcaId">
                                <input v-if="$store.state.item.id" type="text" name="idMarca" id='idMarca' class='form-control' :value="$store.state.item.id" aria-describedby="MarcaId" placeholder="Registro da marca"  disabled/>
                            </input-container-component>

                            <input-container-component  Id='nomeMarca' titulo="Nome" textoAjuda="Nome da marca" idHelp="MarcaNome">
                                <input v-if="$store.state.item.nome" type="text" id='nomeMarca' name='nomeMarca' class='form-control' :value="$store.state.item.nome" aria-describedby="MarcaNome" placeholder="Nome da marca" disabled />
                            </input-container-component>
                        </template>

                        <template v-slot:rodape>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" @click="deletar()" v-if="$store.state.transacao.status != 'sucesso'">Remover</button>
                        </template>
                    </modal-component>
                <!-- Modal de remoção de marcas -->
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
                urlPagination : '',
                urlBusca: '',
                nomeMarca : '',
                arquivosImagem : [], //Podendo receber mais de um arquivo
                situacaoCadastro : '',
                mensagemRetorno: {},
                campoBusca : {id : '', nome : ''},
                listaMarcas: { data: [] }, //Esse objeto está sendo passado com um array vazio, dessa forma quando for utilizado em um map, um warning não será apresentado pois o objeto deixa de ser undefined
            }
        },

        methods:{
            buscarMarcas(){
                let dados = '';

                if(this.campoBusca){

                    //Percorrendo as chaves do campoBusca através de um for
                    for(let chave in this.campoBusca){
                        
                        //Necessário apresentar ; entre uma chave e outra
                        if(dados != ""){
                            dados += ";";
                        }

                        dados += chave + ":"+ this.campoBusca[chave];
                    }

                    if(dados != ""){
                        this.urlPagination = "page=1"; //Para manter sempre o indice atualizado a cada nova consulta
                        this.urlBusca = "&filtro="+dados;
                    }else{
                        //Caso não haja nenhum valor, porque senão o valor acima será passado como parâmetro
                        this.urlBusca = "";
                    }

                    this.index();
                }
            },

            paginacao(e){
                if(e.url){
                    //this.urlBase = e; //Ajustando o link base para a paginação

                    this.urlPagination = e.url.split("?")[1]; //pegando somente o indice da paginação de uma url
                    this.index() //Chamando o index com o link atualizado para a paginação
                }
            },

            carregarImagem(e){
                this.arquivosImagem = e.target.files //Forma de recuperar arquivos com o Vuejs
            },

            index(){
                let url = this.urlBase+"?"+this.urlPagination+this.urlBusca;
                //console.log(url);
                let config= {
                                headers: {
                                    'Accept': 'application/json',
                                    'Authorization': this.token
                                }
                            };

                axios.get(url, config)
                    .then(response => {
                        this.listaMarcas = response.data
                        //console.log(this.listaMarcas)
                    })
                    .catch(errors => {
                        //console.log(errors)
                    });
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
                         this.mensagemRetorno = {mensagem : "Marca "+ response.data.nome +" registrada com sucesso!"};
                         //console.log(response.data);
                     })
                     .catch(errors => {
                         this.situacaoCadastro = 'Erro';
                         this.mensagemRetorno = {mensagem : errors.message};
                         //console.log(errors);
                     });
                
            },

            deletar(){
                let confirmacao = confirm("Tem certeza que deseja deletar a marca: "+ this.$store.state.item.nome+"?");

                if(!confirmacao){
                    return false;
                }

                let url = this.urlBase+"/"+this.$store.state.item.id;

                let formData = new FormData();
                formData.append("_method", "delete");

                let config = {
                    headers : {
                        "Content-Type" : "application/json",
                        "Accept"       : "application/json",
                        "Authorization": this.token
                    }
                }

                axios.post(url, formData, config)
                     .then(response => {
                         console.log(response);
                         this.$store.state.transacao.status = 'sucesso';
                         this.$store.state.transacao.mensagem = response.data.msg;
                         this.buscarMarcas();
                     })
                     .catch(errors => {
                         this.$store.state.transacao.status = 'erro';
                         this.$store.state.transacao.mensagem = errors.response.data.error;
                     });
                
            }
        },

        mounted(){
            this.index();
        }
    }
</script>
