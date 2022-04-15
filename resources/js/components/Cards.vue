<template>
    
    <div class="card my-3">
        <div class="card-header">{{Titulo}}</div>

        <div class="card-body">
            <slot name="Conteudo"></slot>
        </div>

        <div class="card-footer">
            <slot name="rodape"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props : ["Titulo"],
        mounted() {
            //console.log('Component card.')
        }
    }
</script>
