<template>
    <div>

        <h1>Create new player</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'teamList'}">Teams</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'playerList'}">Teams players</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create new player</li>
            </ol>
        </nav>

        <form v-on:submit="saveForm()">

            <div class="col-xs-12 form-group">
                <label class="control-label">First name</label>
                <input type="text" v-model="player.first_name" class="form-control" required>
            </div>
            <div class="col-xs-12 form-group">
                <label class="control-label">Last name</label>
                <input type="text" v-model="player.last_name" class="form-control" required>
            </div>
            <div class="col-xs-12 form-group">
                <button class="btn btn-success">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            var app = this;
            return {
                errors: [],
                player: {
                    first_name: '',
                    last_name: ''
                }
            }
        },
        mounted() {
            var app = this;
            app.teamId = app.$route.params.teamId;
        },
        methods: {
            saveForm() {
                var app = this;
                var newPlayer = app.player;
                axios.post(`/api/v1/teams/${app.teamId}/players`, newPlayer)
                    .then(function (resp) {
                        app.$notify('Player successfully created!');
                        app.$router.push({name: 'playerList', params: {teamId: app.teamId}});
                    })
                    .catch(function (resp) {
                        app.$notify({
                            type: 'warn',
                            text: 'Could not create your player.'
                        });
                    });
            }
        }
    }
</script>