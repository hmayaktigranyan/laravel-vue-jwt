<template>
    <div>


        <h1>Create new team</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'teamList'}">Teams</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create new team</li>
            </ol>
        </nav>
        <form v-on:submit="saveForm()">

                 <div class="col-xs-12 form-group">
                    <label class="control-label">Team name</label>
                    <input type="text" v-model="team.name" class="form-control" required>
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
            return {
                team: {
                    name: ''
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newTeam = app.team;
                axios.post('/api/v1/teams', newTeam)
                    .then(function (resp) {
                        app.$notify('Team successfully created!');
                        app.$router.push({name: 'teamList'});
                    })
                    .catch(function (resp) {
                        app.$notify({
                            type: 'warn',
                            text: 'Could not create your team.'
                        });
                    });
            }
        }
    }
</script>