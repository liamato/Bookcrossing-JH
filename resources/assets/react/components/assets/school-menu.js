import React from 'react'
import { Link } from 'react-router'
import request from 'superagent'
import { default as Im } from 'immutable'
import config from '../../config'
import Collection from '../../data/collection'

export default class Menu extends React.Component {

	componentWillMount() {
		this.setState({school: {name: '', slug: this.props.params.school}, schools: []});
		this.setSchool();
		this.getSchools();
	}

	componentDidUpdate(props, state) {
		if (this.props.params.school !== props.params.school) {
			this.setSchool()
		}
	}

	getSchools() {
		request
		.get(`${config.api.baseUrl}/school`)
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, req)=> {
			if (req.ok) {
				var schools = JSON.parse(req.text);
				if (schools instanceof Array) {
					schools = new Collection(schools);
				}
			} else if (err) {
				console.log(err);
			}
			this.setState({schools: schools||this.state.schools});
		});
	}

	setSchool(school, callback) {
		if (!school) {
			request
			.get(`${config.api.baseUrl}/school(all)/${this.props.params.school}`)
			.accept('json')
			.set('X-Requested-With', 'XMLHttpRequest')
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

	changeSchool(ev) {
		let target = ev.target
		this.props.history.pushState(this.props.location.key, '/'+target.value+this.props.location.pathname.substr(this.props.location.pathname.indexOf('/',1)))
		this.setState({school: {name: target.selectedOptions[0].text, slug: target.value}})
		this.setSchool()
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
				<select onChange={this.changeSchool.bind(this)}>
					{
						this.state.schools.map((school) => {
							return <option key={school.id} value={school.slug}>{school.name}</option>
						})
					}
				</select>
			</nav>
			{React.cloneElement(this.props.children, {school: this.state.school, updateSchool: this.setSchool.bind(this)})}
			<footer>{this.state.school.name}</footer>
		</div>)
	}
}
