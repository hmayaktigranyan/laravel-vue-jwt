<template>
    <div>

        <h1>Players</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'teamList'}">Teams</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Team players</li>
            </ol>
        </nav>
        <div class="btn-toolbar  justify-content-end w-100" role="toolbar">

            <div class="btn-group mr-2">
                <router-link :to="{name: 'playerCreate'}" class="btn btn-primary">Add new player</router-link>
            </div>
        </div>
        <div v-if="players.length == 0">There are no players in this team. Add your first player to team.</div>
        <table class="table table-bordered mt-4 ng-scope" v-if="players.length >0">
            <thead>
            <tr>
                <th scope="col">
                    First name
                </th>
                <th scope="col">
                    Last name
                </th>
                <th scope="col">Created date</th>
                <th scope="col">Updated date</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="player, index in players">
                <td scope="row">
                    {{ player.first_name }}
                </td>
                <td scope="row">
                    {{ player.last_name }}
                </td>
                <td scope="row">
                    {{ player.created_at }}
                </td>
                <td scope="row">
                    {{ player.updated_at }}
                </td>
                <td>
                    <router-link :to="{name: 'playerEdit', params: {id: player.id,teamId:player.team_id}}"
                                 class="btn btn-success">
                        Edit
                    </router-link>
                    <button
                            class="btn  btn-danger"
                            v-on:click="deleteEntry(player.id, index)">
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
                players: []
            }
        },
        mounted() {
            var app = this;
            let teamId = app.$route.params.teamId;
            app.teamId = teamId;
            axios.get(`/api/v1/teams/${teamId}/players`)
                .then(function (resp) {
                    app.players = resp.data;
                })
                .catch(function (resp) {
                    app.$notify({
                        type: 'warn',
                        text: "Could not load players."
                    });
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete(`/api/v1/teams/${app.teamId}/players/${id}`)
                        .then(function (resp) {
                            app.$notify({
                                type: 'warn',
                                text: 'Player deleted.'
                            });
                            app.players.splice(index, 1);
                        })
                        .catch(function (resp) {
                            app.$notify({
                                type: 'warn',
                                text: 'Could not delete player.'
                            });
                        });
                }
            }
        }
    }
</script>