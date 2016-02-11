import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'
import SchoolHome from '../components/routeMaped/school/home'
import SchoolNews from '../components/routeMaped/school/news'
import SchoolList from '../components/routeMaped/school/list'
import SchoolForum from '../components/routeMaped/school/forum'
import SchoolCapture from '../components/routeMaped/school/capture'
import Menu from '../components/assets/school-menu'

//Route: /:school/admin/
import admin_routes from './schoolAdmin'


/**
 * @route /:school/
 * 
 * @uses ../components/routeMaped/home
 * @uses ../components/routeMaped/school/home
 */

export default (<Route path="/:school" component={Menu}>
	<IndexRoute component={SchoolHome}/>
	<Route path="/:school/news" component={SchoolNews}/>
	<Route path="/:school/list" component={SchoolList}/>
	<Route path="/:school/capture" component={SchoolCapture}/>
	<Route path="/:school/liberate" component={Home}/>
	<Route path="/:school/register" component={Home}/>
	<Route path="/:school/forum(/:category)" component={SchoolForum}/>
	<Route path="/:school/booktrailer" component={Home}/>
	<Route path="/:school/booktube" component={Home}/>
	<Route path="/:school/login" component={Home}/>
	{ admin_routes }
</Route>)