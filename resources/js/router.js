import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes: [
        { path: '/', component: require('./pages/dashboard').default },
        { path: '/about', component: require('./pages/about').default },
        { path: '/service', component: require('./pages/service').default },
        { path: '/portfolio', component: require('./pages/portfolio').default },
        { path: '/features', component: require('./pages/features').default },
        { path: '/client', component: require('./pages/client').default },
        { path: '/counter', component: require('./pages/counter').default },
        { path: '/pricing', component: require('./pages/pricing').default },
        { path: '/faq', component: require('./pages/faq').default },
        { path: '/contact', component: require('./pages/contact').default },
        { path: '/cta', component: require('./pages/cta').default },
        { path: '/user', component: require('./pages/user').default },
    ]
})
