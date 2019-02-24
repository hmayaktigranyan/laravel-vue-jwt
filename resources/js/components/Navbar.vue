<template>
    <nav class="navbar">
        <router-link to="/" exact>
            Home
        </router-link>

        <ul class="nav">
            <li class="nav-item">
                <router-link to="/login" exact v-if="!isLogged" class="nav-link">
                    Login
                </router-link>
            </li>
            <router-link to="/teams" exact v-if="isLogged" class="nav-link">
                Teams
            </router-link>
            <li class="nav-item text-nowrap">
                <a href="#" @click="logout" v-if="isLogged" class="nav-link">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'Navbar',
        computed: mapGetters([
            'isLogged'
        ]),
        methods: {
            logout() {
                this.$store.dispatch('logout');
                this.$notify('Successfully logged out!');
            }
        }
    }
</script>