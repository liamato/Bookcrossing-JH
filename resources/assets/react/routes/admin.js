import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'

//Route: /admin/school/
import school_routes from './adminSchool'


/**
 * @route /admin/
 * 
 * @uses ../components/routeMaped/home
 */

export default (<Route path="/admin">
	<IndexRoute component={Home}/>
	<Route path="/admin/add" component={Home}/>			
	<Route path="/admin/edit(/:id)" component={Home}/>			
	<Route path="/admin/remove(/:id)" component={Home}/>			
	<Route path="/admin/profile" component={Home}/>
	{ school_routes }
</Route>)