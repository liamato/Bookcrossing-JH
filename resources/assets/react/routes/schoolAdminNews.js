import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'


/**
 * @route /:school/admin/news
 * 
 * @uses ../components/routeMaped/home
 */

export default (<Route path="/:school/admin/news">
	<IndexRoute component={Home}/>
	<Route path="/:school/admin/news/add" component={Home}/>
	<Route path="/:school/admin/news/edit(/:id)" component={Home}/>
	<Route path="/:school/admin/news/remove(/:id)" component={Home}/>
</Route>)