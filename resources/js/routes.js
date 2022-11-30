const Home = () => import('./components/Home.vue')
//importamos los componentes para el perros
const Mostrar = () => import('./components/perros/Mostrar.vue')
const Crear = () => import('./components/perros/Crear.vue')
const Editar = () => import('./components/perros/Editar.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'mostrarPerros',
        path: '/perros',
        component: Mostrar
    },
    {
        name: 'crearPerro',
        path: '/crear',
        component: Crear
    },
    {
        name: 'editarPerro',
        path: '/editar/:id',
        component: Editar
    },
    
]