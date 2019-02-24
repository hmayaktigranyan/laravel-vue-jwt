import VueRouter from 'vue-router';
import store from '../store';
import Home from '../components/Home.vue';
import Login from '../components/Login.vue';

import TeamList from '../components/teams/TeamList.vue';
import TeamCreate from '../components/teams/TeamCreate.vue';
import TeamEdit from '../components/teams/TeamEdit.vue';

import PlayerList from '../components/players/PlayerList.vue';
import PlayerCreate from '../components/players/PlayerCreate.vue';
import PlayerEdit from '../components/players/PlayerEdit.vue';

const router = new VueRouter({
    routes: [
        {path: '/', name: 'Home', component: Home, meta: {auth: false}},
        {path: '/login', name: 'Login', component: Login, meta: {auth: false}},
        {path: '/teams', component: TeamList, name: 'teamList'},
        {path: '/teams/create', component: TeamCreate, name: 'teamCreate'},
        {path: '/teams/edit/:id', component: TeamEdit, name: 'teamEdit'},
        {path: '/players/:teamId', component: PlayerList, name: 'playerList'},
        {path: '/players/:teamId/create', component: PlayerCreate, name: 'playerCreate'},
        {path: '/players/:teamId/edit/:id', component: PlayerEdit, name: 'playerEdit'},
        {path: '*', redirect: '/'}
    ]
});

router.beforeEach((to, from, next) => {
    if (!store.getters.isLogged && to.meta.auth !== false) {
        return next('/login')
    }

    if (store.getters.isLogged && to.name === 'Login') {
        return next('/')
    }

    next()
})

export default router