<template>
    <div :class="estilo" role="alert">
        {{titulo}}
        <hr>
        {{ mensagemRetorno }}
    </div>
</template>

<script>
    export default {
        props: ['tipo', 'titulo', 'mensagemRetorno'],

        computed: {
            estilo(){
                return "alert alert-"+this.tipo;
            }
        }
    }
</script>
