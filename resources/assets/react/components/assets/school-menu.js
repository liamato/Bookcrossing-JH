import React from 'react'
import { Link } from 'react-router'
import request from 'superagent'
import { default as Im } from 'immutable'
import config from '../../config'
import translate from '../../translate'
import Collection from '../../data/collection'

export default class Menu extends React.Component {

	componentWillMount() {
		if (db && db.school) {
			Object.keys(db.school).map((key) =>{
				if (db.school[key] instanceof Array) {
					db.school[key] = new Collection(db.school[key]);
				}
			});
			this.setState({school: db.school});
		} else {
			this.setState({school: {name: '', slug: this.props.params.school}});
			this.setSchool();
		}
		if (db && db.schools) {
			this.setState({schools: db.schools});
		} else {
			this.setState({schools: []});
			this.getSchools();
		}
		if (window.localStorage) {
			if (!localStorage.lang) {
				let sc = ['ca','es','en'];
				for (var x in navigator.languages) {
					if (sc.indexOf(navigator.languages[x]) != -1) {
						localStorage.lang = navigator.languages[x]
						break;
					}
				}
			}
		}
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
		this.props.history.pushState(this.props.location.key, '/'+target.value+(this.props.location.pathname.indexOf('/',1) != -1 ? this.props.location.pathname.substr(this.props.location.pathname.indexOf('/',1)) : ''))
		this.setState({school: {name: target.selectedOptions[0].text, slug: target.value}})
		this.setSchool()
	}

	changeLang(ev) {
		localStorage.lang = ev.target.value;
		this.forceUpdate()
	}

	render() {
		let lang = window.localStorage && localStorage.lang ? localStorage.lang : 'ca';
		return (
		<div className="app">
			<nav className="navigation">
				<Link className="navigation__link" to={`/${this.state.school.slug}`}>{translate('inicio','Inici')}</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/news`}>{translate('novedades','Novetats')}</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/list`}>{translate('lista-libros','Llista de llibres')}</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/capture`}>{translate('capturar','Capturar')} {translate('libro','llibre')}</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/liberate`}>{translate('liberar','Alliberar')} {translate('libro','llibre')}</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/register`}>{translate('registrar','Registrar')} {translate('libro','llibre')}</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/forum`}>{translate('forum','Forum')}</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/booktrailer`}>Booktrailer</Link>
				<Link className="navigation__link" to={`/${this.state.school.slug}/booktube`}>Booktube</Link>
				<div className="navigation__link">
				<select className="navigation__link navigation__select" value={lang} onChange={this.changeLang.bind(this)}>
					<option value="ca">Català</option>
					<option value="es">Castellano</option>
					<option value="en">English</option>
				</select>
				</div>
			</nav>
			<main className="main">
				{React.cloneElement(this.props.children, {school: this.state.school, updateSchool: this.setSchool.bind(this)})}
			</main>
			<footer className="footer">
				<select className="footer__school" onChange={this.changeSchool.bind(this)} value={this.state.school.slug}>
					{
						this.state.schools.map((school) => {
							return <option key={school.id} value={school.slug}>{school.name}</option>
						})
					}
				</select>
			</footer>
		</div>)
	}
}
