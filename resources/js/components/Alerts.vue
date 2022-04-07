<template>
    <div :class="estilo" role="alert">
        {{titulo}}
        <hr>
        <p>{{mensagemRetorno.mensagem}}</p>
    </div>
</template>

<script>
    export default {
        props: ['tipo', 'titulo', 'mensagemRetorno', 'situacao'],

        computed: {
            estilo(){
                return "alert alert-"+this.tipo;
            }
        }
    }
</script>
