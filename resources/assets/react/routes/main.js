import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'
import SchoolHome from '../components/routeMaped/school/home'
import SchoolNews from '../components/routeMaped/school/news'
import SchoolList from '../components/routeMaped/school/list'
import SchoolForum from '../components/routeMaped/school/forum'
import SchoolCapture from '../components/routeMaped/school/capture'
import SchoolLiberate from '../components/routeMaped/school/liberate'
import SchoolRegister from '../components/routeMaped/school/register'
import SchoolTube from '../components/routeMaped/school/tube'
import Menu from '../components/assets/school-menu'


/**
 * @route /
 * 
 * @uses ../components/routeMaped/home
 */
export default (
<Route path="/">
	<IndexRoute component={Home}/>

	/**
	 * @route /:school/
	 * 
	 * @uses ../components/routeMaped/home
	 * @uses ../components/routeMaped/school/home
	 * @uses ../components/routeMaped/school/news
	 * @uses ../components/routeMaped/school/list
	 * @uses ../components/routeMaped/school/capture
	 * @uses ../components/routeMaped/school/liberate
	 * @uses ../components/routeMaped/school/register
	 * @uses ../components/routeMaped/school/forum
	 */
	<Route path="/:school" component={Menu}>
		<IndexRoute component={SchoolHome}/>
		<Route path="/:school/news" component={SchoolNews}/>
		<Route path="/:school/list" component={SchoolList}/>
		<Route path="/:school/capture" component={SchoolCapture}/>
		<Route path="/:school/liberate" component={SchoolLiberate}/>
		<Route path="/:school/register" component={SchoolRegister}/>
		<Route path="/:school/forum(/:category)" component={SchoolForum}/>
		<Route path="/:school/booktrailer" trailer component={SchoolTube}/>
		<Route path="/:school/booktube" component={SchoolTube}/>
		<Route path="/:school/login" component={Home}/>
	</Route>
</Route>)
