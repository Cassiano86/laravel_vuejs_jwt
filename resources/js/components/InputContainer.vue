<template>
    <div class="form-group">
        <label :for="Id" class="form-label text-dark font-weight-bold">{{ titulo }}</label>
        <slot></slot>
        <div :id="IdHelp" class="form-text text-muted">{{ textoAjuda }}</div> 
    </div> 
</template>

<script>
    export default{
        props : ["Id", "titulo", "IdHelp", "textoAjuda"]
    }
</script>
