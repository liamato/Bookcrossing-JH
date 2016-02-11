import React from 'react'
//import ReactDOM from 'react-dom'
import { Link } from 'react-router'
import request from 'superagent'
import { default as Im } from 'immutable'
import config from '../../config'
import Collection from '../../data/collection'
window.Collection = Collection;

export default class Menu extends React.Component {

	componentWillMount() {
		this.setState({school: {name: '', slug: this.props.params.school}});
		this.setSchool();
	}

	setSchool(school, callback) {
		if (!school) {
			request
			.get(`${config.api.baseUrl}/school/${this.props.params.school}`)
			.accept('json')
			.end((err, req)=> {
				if (req.ok) {
					var school = JSON.parse(req.text);
					Object.keys(school).map((key) =>{
						if (school[key] instanceof Array) {
							school[key] = new Collection(school[key]);
						}
					});
				} else if (err) {
					console.log(err);
				}
				this.setState({school: school||this.state.school}, callback);
			});
		} else {
			if (school.school) {
				school = school.school;
			}
			Object.keys(school).map((key) =>{
				if (school[key] instanceof Array) {
					school[key] = new Collection(school[key]);
				}
			});
			this.setState({
				school: Object.assign(this.state.school, school)
			}, callback);
		}
	}

	render() {
		return (
		<div>
			<nav>
				<Link to={`/${this.state.school.slug}`}>Inicio</Link>
				<Link to={`/${this.state.school.slug}/news`}>Novedades</Link>
				<Link to={`/${this.state.school.slug}/list`}>Llista de libros</Link>
				<Link to={`/${this.state.school.slug}/capture`}>Capturar libro</Link>
				<Link to={`/${this.state.school.slug}/liberate`}>Liberar libro</Link>
				<Link to={`/${this.state.school.slug}/register`}>Registrar libro</Link>
				<Link to={`/${this.state.school.slug}/forum`}>Foro</Link>				
				<Link to={`/${this.state.school.slug}/booktrailer`}>Booktrailer</Link>				
				<Link to={`/${this.state.school.slug}/booktube`}>Booktube</Link>				
			</nav>
			{React.cloneElement(this.props.children, {school: this.state.school, updateSchool: this.setSchool.bind(this)})}
			<footer>{this.state.school.name}</footer>
		</div>)
	}
}
