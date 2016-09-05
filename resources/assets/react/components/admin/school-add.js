import React from 'react'
import ReactDom from 'react-dom'
import request from 'superagent'
import config from '../../config'
import School from '../assets/school'
import User from '../assets/user'
import Category from '../assets/category'


class App extends React.Component {

	componentWillMount() {
		this.setState({step: 0, name: '', slug: '', user: {}, cname: '', cslug: '', errors: []});
	}

	componentDidUpdate(props, state) {
		if (this.state.step > 2) {
			this.save()
		}
	}

	slugit(text) {
		return (''+text).toLowerCase().replace(/[^a-z0-9\-_\s]/g, '').replace(/[\s]+/g,'-')
	}

	nameKeyUp(e) {
		this.setState({name: e.target.value, slug: (this.state.slug && this.state.slug != this.slugit(this.state.name) ? this.state.slug : this.slugit(e.target.value))})
	}

	slugKeyUp(e) {
		this.setState({slug: e.target.value})
	}

	cnameKeyUp(e) {
		this.setState({cname: e.target.value, cslug: (this.state.cslug && this.state.cslug != this.slugit(this.state.cname) ? this.state.cslug : this.slugit(e.target.value))})
	}

	cslugKeyUp(e) {
		this.setState({cslug: e.target.value})
	}


	validate() {
		var errors = []

		if (!this.state.name) {
			errors.push('Tens d\'introduir un nom')
		}

		if (!this.state.slug) {
			errors.push('Tens d\'introduir una URL')
		}

		if (db.schools) {
			db.schools.map((v,k) => {
				if (v.name == this.state.name) {
					errors.push('Ja existeix aquest nom')
				}

				if (v.slug == this.state.slug) {
					errors.push('Ja existeix aquesta URL')
				}
			})
		}

		if ((''+this.state.name).lenght > 40) {
			errors.push('EL nom es massa llarg')
		}

		if ((''+this.state.slug).lenght > 30) {
			errors.push('La URL es massa llarga')
		}

		if ((''+this.state.slug).toLowerCase() != this.slugit((''+this.state.slug).toLowerCase())) {
			errors.push('La URL conté caracters no permesos (nomes a-z, 0-9, "-" i "_")')
		}

		if (['admin','api','login','logout'].indexOf(this.state.slug) != -1) {
			errors.push('La URL esta reservada')
		}

		if (this.state.step > 0) {
			if (!this.state.user.name) {
				errors.push('Tens d\'introduir un administrador per la escola')
			}

			if (!this.state.user.email) {
				errors.push('Tens d\'introduir un email per el administrador')
			}

			if ((''+this.state.user.email) !== (''+this.state.user.email).replace(/[^a-z0-9\-_\.\@]/g, '')) {
				errors.push('El email conté caracters no permesos')
			}

			if (this.state.user.email && !(''+this.state.user.email).match(/([a-z0-9\-_\.]+)@([a-z0-9\-_\.])/)) {
				errors.push('El email no té un format correcte')
			}

			if (db.users) {
				db.users.map((v,k) => {
					if (v.email == this.state.user.email) {
						errors.push('El correu del administrador ja esta en us')
					}
				})
			}

			if (!this.state.user.password) {
				errors.push('Tens d\'introduir una contrassenya per el administrador')
			}
		}

		if (this.state.step > 1) {
			if (!this.state.cname) {
				errors.push('Tens d\'introduir el nom de la primera categoria de la escola')
			}

			if (!this.state.cslug) {
				errors.push('Tens d\'introduir una URL per la categoria')
			}

			if (db.categories) {
				db.categories.map((v,k) => {
					if (v.name == this.state.cname) {
						errors.push('Ja existeix aquest nom per la categoria')
					}

					if (v.slug == this.state.cslug) {
						errors.push('Ja existeix aquesta URL per la categoria')
					}
				})
			}

			if ((''+this.state.cslug).toLowerCase() != this.slugit((''+this.state.cslug).toLowerCase())) {
				errors.push('La URL per la categoria conté caracters no permesos (nomes a-z, 0-9, "-" i "_")')
			}

			if ((''+this.state.cname).lenght > 40) {
				errors.push('EL nom es massa llarg')
			}

			if ((''+this.state.cslug).lenght > 30) {
				errors.push('La URL per la cetegoria es massa llarga')
			}
		}

		this.setState({errors: errors});

		return errors.length == 0;
	}

	userSave(user, ev) {
		delete user.id
		this.setState({user: Object.assign(this.state.user, user)})
		this.next()
	}

	next() {
		if (this.state.step < 3) {
			if (this.validate()) {
				this.setState({step: this.state.step+1})
			}
		}
	}

	back() {
		if (this.state.step > 0) {
			this.setState({step: this.state.step-1})
		}
	}

	save() {
		request
		.post(window.location)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send({
			name: this.state.name,
			slug: this.state.slug,
			uname: this.state.user.name,
			umail: this.state.user.email,
			upassword: this.state.user.password,
			cname: this.state.cname,
			cslug: this.state.cslug
		})
		.end((err, req) => {
			if (req.ok) {
				window.location = db.redirectplaceholderurl.replace(':school:', this.state.slug);
			} else {
				this.setState({step: this.state.step-1, errors: ['Ha ocorregut un problema amb la connexió, proveu més tard']})
			}
		});
	}

	render() {
		if (this.state.step == 0) {
			return <div className="school-add">
				{
					() => {
						if (this.state.errors) {
							return <div className="school-add__errors">
								<ul className="errors">
									{
										this.state.errors.map((v,k) => {
											return <li className="errors__error" key={k}>{v}</li>
										})
									}
								</ul>
							</div>
						}
					}()
				}
				<h2>Escola</h2>
				<hr/>
				<label htmlFor="">Nom</label>
				<input type="text" className="school__name" lenght={40} placeholder="Institut Jaume Huguet" defaultValue={this.state.name} onChange={this.nameKeyUp.bind(this)}/>
				<label htmlFor="">URL</label>
				<input type="text" className="school__slug" lenght={30} placeholder="institut-jaume-huguet" value={this.state.slug} onChange={this.slugKeyUp.bind(this)}/>
				{
					() => {
						if (this.state.slug) {
							return <p>URL: { db.placeholderUrl.replace(':school:', this.state.slug) }</p>
						}
					}()
				}
				{
					() => {
						if (this.state.name && this.state.slug) {
							return <button onClick={this.next.bind(this)}>Següent</button>
						}
					}()
				}
			</div>
		} else if (this.state.step == 1) {
			return <div className="school-add">
			{
					() => {
						if (this.state.errors) {
							return <div className="school-add__errors">
								<ul className="errors">
									{
										this.state.errors.map((v,k) => {
											return <li className="errors__error" key={k}>{v}</li>
										})
									}
								</ul>
							</div>
						}
					}()
				}
				<h2>Escola</h2>
				<hr/>
				<p>Nom: {this.state.name}</p>
				<p>URL: { db.placeholderUrl.replace(':school:', this.state.slug) }</p>
				<h2>Administrador de la escola</h2>
				<hr/>
				<User edit save={this.userSave.bind(this)} id={-1} name={this.state.user.name||""} email={this.state.user.email||""} saveBtn="Següent"/>
				<button onClick={this.back.bind(this)}>Endarrera</button>
			</div>
		} else if (this.state.step == 2) {
			return <div className="school-add">
			{
					() => {
						if (this.state.errors) {
							return <div className="school-add__errors">
								<ul className="errors">
									{
										this.state.errors.map((v,k) => {
											return <li className="errors__error" key={k}>{v}</li>
										})
									}
								</ul>
							</div>
						}
					}()
				}
				<h2>Escola</h2>
				<hr/>
				<p>Nom: {this.state.name}</p>
				<p>URL: { db.placeholderUrl.replace(':school:', this.state.slug) }</p>
				<h2>Administrador de la escola</h2>
				<hr/>
				<User id="" name={this.state.user.name} email={this.state.user.email} />
				<h2>Primera categoria del forum</h2>
				<hr/>
				<label htmlFor="">Nom</label>
				<input type="text" length={40} placeholder="Resenyes de llibres" onChange={this.cnameKeyUp.bind(this)} defaultValue={this.state.cname}/>
				<label htmlFor="">URL</label>
				<input type="text" length={30} placeholder="resenyes-de-llibres" onChange={this.cslugKeyUp.bind(this)} value={this.state.cslug}/>
				<button onClick={this.back.bind(this)}>Endarrera</button>
				{
					() => {
						if (this.state.cname && this.state.cslug) {
							return <button onClick={this.next.bind(this)}>Guardar</button>
						}
					}()
				}
			</div>
		} else if (this.state.step == 3) {
			return <div className="school-add">
				<div>
					<ul>
						<li>Enviant ...</li>
					</ul>
				</div>
				<h2>Escola</h2>
				<hr/>
				<p>Nom: {this.state.name}</p>
				<p>URL: { db.placeholderUrl.replace(':school:', this.state.slug) }</p>
				<h2>Administrador de la escola</h2>
				<hr/>
				<User id="" name={this.state.user.name} email={this.state.user.email} />
				<h2>Primera categoria del forum</h2>
				<hr/>
				<p>Nom: {this.state.cname}</p>
				<p>URL: {this.state.cslug}</p>
			</div>
		}
	}
}


function reRender(school) {
	school = school ? school : db.school;
	ReactDom.render(<App {...school} />, document.getElementById('app'));
}

if (!db) db = {}

reRender();
