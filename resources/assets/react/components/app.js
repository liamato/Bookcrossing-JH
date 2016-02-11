import React from 'react'
import { Link } from 'react-router'

export default class App extends React.Component {
	render() {
		return <div>
			<nav>
				<Link to="/">Inicio</Link>
				<Link to="/news">Novedades</Link>
				<Link to="/list">Llista de libros</Link>
				<Link to="/list">Llista de libros</Link>
				<Link to="/list">Llista de libros</Link>
				<Link to="/list">Llista de libros</Link>				
			</nav>
			{this.props.children}
		</div>
	}
}