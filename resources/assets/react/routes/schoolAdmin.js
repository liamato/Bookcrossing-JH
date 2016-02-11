import React from 'react'
import { Route, IndexRoute } from 'react-router'
import Home from '../components/routeMaped/home'

//Route: /:school/admin/news/
import news_routes from './schoolAdminNews'
//Route: /:school/admin/forum/
import forum_routes from './schoolAdminForum'


/**
 * @route /:school/admin/
 * 
 * @uses ../components/routeMaped/home
 */

export default (<Route path="/:school/admin">
	<IndexRoute component={Home}/>
	<Route path="/:school/admin/add" component={Home}/>
	<Route path="/:school/admin/edit(/:id)" component={Home}/>
	<Route path="/:school/admin/remove(/:id)" component={Home}/>
	<Route path="/:school/admin/profile" component={Home}/>
	{ news_routes }	
	{ forum_routes }
	<Route path="/:school/trailer" component={Home}/>
	<Route path="/:school/tube" component={Home}/>
</Route>)