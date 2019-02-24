<template>
    <div class="h-screen flex justify-center items-center">
        <div class="w-full max-w-xs">
            <h1 class="text-center mb-6">Login</h1>

            <form v-on:submit.prevent="login()" class="form-card">
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2">Email</label>
                    <input v-model="credentials.email" class="form-control" type="email"
                           name="email" placeholder="Email">
                </div>
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2">Password</label>

                    <input v-model="credentials.password" class="form-control"
                           type="password" name="password" placeholder="Password">
                </div>

                <button class="btn btn-primary mt-2">
                    Login
                </button>

            </form>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                },
            }
        },
        methods: {
            login() {
                var app = this;
                axios.post('/api/v1/login', this.credentials)
                    .then(function (resp) {
                        app.$notify('Successfully logged in !');
                        app.$store.dispatch('login', resp.data)
                        app.$router.push({name: 'teamList'});
                    })
                    .catch(function (resp) {
                        app.credentials.password = ''
                        app.$notify({
                            type: 'warn',
                            text: "Wrong credentials."
                        });
                    });
            }
        }
    }
</script>