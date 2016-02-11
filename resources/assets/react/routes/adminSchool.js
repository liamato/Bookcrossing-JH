import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'


/**
 * @route /admin/school
 * 
 * @uses ../components/routeMaped/home
 */

export default (<Route path="/admin/school">
	<IndexRoute component={Home}/>
	<Route path="/admin/school/add" component={Home}/>
	<Route path="/admin/school/edit(/:id)" component={Home}/>
	<Route path="/admin/school/remove(/:id)" component={Home}/>
</Route>)