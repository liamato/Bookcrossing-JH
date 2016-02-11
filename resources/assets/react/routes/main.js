import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'
import App from '../components/app'

//Route: /:school
import school_routes from './school'
//Route: /admin
import admin_routes from './admin'


/**
 * @route /
 * 
 * @uses ../components/app
 * @uses ../components/routeMaped/home
 */

export default (
<Route path="/">
	<IndexRoute component={Home}/>
	{ admin_routes }
	<Route path="/login" component={Home}/>
	{ school_routes }
</Route>)