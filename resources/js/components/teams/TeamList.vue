<template>
    <div>
        <h1>Teams</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Teams</li>
            </ol>
        </nav>
        <div class="btn-toolbar  justify-content-end w-100" role="toolbar">

            <div class="btn-group mr-2">
                <router-link :to="{name: 'teamCreate'}" class="btn btn-primary">Add new team</router-link>
            </div>
        </div>

        <div v-if="teams.length == 0">There are no teams. Add your first team.</div>
        <table class="table table-bordered mt-4 ng-scope" v-if="teams.length >0">
            <thead>
            <tr>
                <th scope="col">
                    Name
                </th>
                <th scope="col">Created date</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="team, index in teams">
                <td scope="row">
                    {{ team.name }}
                </td>
                <td scope="row">
                    {{ team.created_at }}
                </td>

                <td>
                    <router-link :to="{name: 'playerList', params: {teamId: team.id}}" class="btn btn-info">
                        See team players
                    </router-link>
                    <router-link :to="{name: 'playerCreate', params: {teamId: team.id}}" class="btn btn-secondary">
                        Add team player
                    </router-link>

                    <router-link :to="{name: 'teamEdit', params: {id: team.id}}" class="btn btn-success">
                        Edit
                    </router-link>
                    <button
                            class="btn  btn-danger"
                            v-on:click="deleteEntry(team.id, index)">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                teams: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/teams')
                .then(function (resp) {
                    app.teams = resp.data;
                })
                .catch(function (resp) {
                    app.$notify({
                        type: 'warn',
                        text: "Could not load teams."
                    });
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/teams/' + id)
                        .then(function (resp) {
                            app.$notify({
                                type: 'warn',
                                text: 'Team deleted.'
                            });
                            app.teams.splice(index, 1);
                        })
                        .catch(function (resp) {
                            app.$notify({
                                type: 'warn',
                                text: 'Could not delete team.'
                            });
                        });
                }
            }
        }
    }
</script>