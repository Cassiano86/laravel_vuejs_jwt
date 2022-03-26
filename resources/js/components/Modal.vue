<template>
    <!-- Modal -->
    <div class="modal fade" :id="id" tabindex="-1" :aria-labelledby="id" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">{{titulo}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <slot name="alerts"></slot>

                <slot name="conteudo"></slot>
            </div>
            <div class="modal-footer">
                <slot name="rodape"></slot>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
       props: ['id', 'titulo']
    }
</script>
<!-- Button trigger modal 
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
    </button>
-->