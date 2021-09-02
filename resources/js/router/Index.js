import VueRouter from 'vue-router'
import Home from '../components/views/home/Index'
import TodoIndex from '../components/views/todos/Index'
import TodoShow from '../components/views/todos/Show'
import TodoEdit from '../components/views/todos/Edit'
import TodoCreate from '../components/views/todos/Create'


import ListIndex from '../components/views/lists/Index'
import ListShow from '../components/views/lists/Show'
import ListEdit from '../components/views/lists/Edit'
import ListCreate from '../components/views/lists/Create'


import Login from '../components/views/auth/Login'
import Register from '../components/views/auth/Register'
import Email from '../components/views/auth/passwords/Email'
import ResetPassword from '../components/views/auth/passwords/ResetPassword'
import Dashboard from '../components/views/dashboard/Index'
import store from '../store/Index'

const authenticated = (to,from,next) => {
	//User is authenticated
	if(store.getters.isAuthenticated){
		next()
		return
	}
	next('/login')
}

const notAuthenticated = (to, from, next) => {
	//Guest user
	if(!store.getters.isAuthenticated){
		next()
		return
	}
	next('/')
}

const routes = [
	{
		name: 'home',
		path: '/',
		component: Home
	},
	{
		name: 'todos.index',
		path: '/todos',
		component: TodoIndex
	},
	{
		name: 'todos.create',
		path: '/todos/create',
		component: TodoCreate,
		beforeEnter: authenticated
	},
	{
		name: 'todos.edit',
		path: '/todos/:id/edit',
		component: TodoEdit,
		beforeEnter: authenticated
	},
	{
		name: 'todos.show',
		path: '/todos/:id',
		component: TodoShow
	},

	

	,
	{
		name: 'lists.index',
		path: '/lists',
		component: ListIndex
	},
	{
		name: 'lists.create',
		path: '/lists/create',
		component: ListCreate,
		beforeEnter: authenticated
	},
	{
		name: 'lists.edit',
		path: '/lists/:id/edit',
		component: ListEdit,
		beforeEnter: authenticated
	},
	{
		name: 'lists.show',
		path: '/lists/:id',
		component: ListShow
	},








	{
		name: 'login',
		path: '/login',
		component: Login,
		beforeEnter: notAuthenticated
	},
	{
		name: 'register',
		path: '/register',
		component: Register,
		beforeEnter: notAuthenticated
	},
	{
		name: 'user.index',
		path: '/user',
		component: Dashboard,
		beforeEnter: authenticated
	},
	{
		name: 'passwod.reset',
		path: '/password/reset/:token',
		component: ResetPassword,
		beforeEnter: notAuthenticated
	},
	{
		name: 'password.email',
		path: '/password/email',
		component: Email,
		beforeEnter: notAuthenticated
	}
];


export default new VueRouter({
	mode: 'history',
	routes: routes
});