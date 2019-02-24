<template>
    <div>

        <h1>Edit team</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'teamList'}">Teams</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit team</li>
            </ol>
        </nav>

        <form v-on:submit="saveForm()">
                 <div class="col-xs-12 form-group">
                    <label class="control-label">Team name</label>
                    <input type="text" v-model="team.name" class="form-control" required>
                </div>

                <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Update</button>
                </div>

        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.teamId = id;
            axios.get('/api/v1/teams/' + id)
                .then(function (resp) {
                    app.team = resp.data;
                })
                .catch(function () {
                    app.$notify({
                        type: 'warn',
                        text: "Could not load team."
                    });
                });
        },
        data: function () {
            return {
                teamId: null,
                team: {
                    name: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newTeam = app.team;
                axios.patch('/api/v1/teams/' + app.teamId, newTeam)
                    .then(function (resp) {
                        app.$notify('Team successfully saved!');
                        app.$router.push({name: 'teamList'});
                    })
                    .catch(function (resp) {
                        app.$notify({
                            type: 'warn',
                            text: "Could not save team."
                        });
                    });
            }
        }
    }
</script>