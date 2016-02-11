import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'


/**
 * @route /:school/admin/forum
 * 
 * @uses ../components/routeMaped/home
 */

export default (<Route path="/:school/admin/forum">
	<IndexRoute component={Home}/>
	<Route path="/:school/admin/forum/add" component={Home}/>
	<Route path="/:school/admin/forum/edit(/:id)" component={Home}/>
	<Route path="/:school/admin/forum/remove(/:id)" component={Home}/>
</Route>)