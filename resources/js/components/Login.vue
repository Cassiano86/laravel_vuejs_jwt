<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login componente Vue.js</div>
                    <div class="card-body">
                        <form method="POST" action="" @submit.prevent="login($event)">

                            <input type="hidden" name="_token" :value="csrf_token">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus v-model="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right" >Senha</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Lembrar de mim
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>                                    
                                        <a class="btn btn-link" href="">
                                            Esqueci minha senha?
                                        </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: ["csrf_token"],
        
        //Criando o data em forma de objeto literal
        data() {
            return {
                email    : 'cassiano_tst@hotmail.com',
                password : 'senha123',
            }
        },

        methods : {
            login(e){
                let url = "http://localhost:8000/api/login";

                let config = {
                    "method" : "POST",
                    "body" : new URLSearchParams({
                        email : this.email,
                        password : this.password,
                    }),
                };

                //O método fetch é responsável por fazer request e responses HTTP, sendo nativo do JS
                //O método then envia uma resposta de forma assíncrona a aplicação e pode ser encadeada várias vezes dependendo da necessidade
                fetch(url, config)
                    .then(response => response.json())
                    .then(response_previous => {
                        
                        if(response_previous.access_token){
                            document.cookie = 'token='+response_previous.access_token+';SameSite = Lax';
                            
                        }
                        
                        //Permitindo que o submit ocorra depois de recuperar o token
                        e.target.submit();
                    });
                
            }
        }
    }
</script>
