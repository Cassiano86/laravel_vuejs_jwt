<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Componente de  Marcas</div>

                    <div class="card-body">
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
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

</script>
