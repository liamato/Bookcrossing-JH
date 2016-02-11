import React from 'react'
import ReactDOM from 'react-dom'
import Router from 'react-router'
import createBrowserHistory from 'history/lib/createBrowserHistory'
import routes from './routes/main'

ReactDOM.render(
	(<Router history={ createBrowserHistory() }>{routes}</Router>),
	document.getElementById('container')
);
