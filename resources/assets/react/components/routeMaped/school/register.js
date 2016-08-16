import React from 'react'
import request from 'superagent'
import config from '../../../config'
import translate from '../../../translate'
import uid from 'uid'

export default class Register extends React.Component {

	componentWillMount() {
		this.setState({request: 0});
	}

	createBook(id, ev) {
		this.setState({request: 1});
		request
		.post(`${config.api.baseUrl}/school/${this.props.params.school}/book`)
		.send({title: document.getElementById(`title-${id}`).value, author: document.getElementById(`author-${id}`).value})
		.type('json')
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, req) => {
			this.setState({request: 2, res: [err, req]});
		});
	}

	render() {
		return <div className="school-register">
			<h1>{translate('registrar','Registrar')} {translate('libro', 'llibre')}</h1>
			<hr/>
			{
				() => {
					if (this.state.request === 0) {
						let id = uid();
						return (
								<div className="register">
									<input type="text" id={`title-${id}`} placeholder={translate('titulo','Títol')}/>
									<input type="text" id={`author-${id}`} placeholder={translate('autor', 'Autor')}/>
									<button onClick={this.createBook.bind(this, id)}>{translate('registrar', 'Registrar')}</button>
								</div>
							)
					} else if(this.state.request === 1) {
						return <div>{translate('regstrando', 'Registrant')} {translate('libro', 'llibre')}...</div>
					} else if (this.state.request === 2) {
						if (this.state.res[1].ok) {
							return <div>{translate('libro-registrado', 'Llibre registrat')}, {translate('codigo', 'Codi').toLowerCase()}: {this.state.res[1].body.id}</div>
						}
						return <div>{translate('un-error', 'Hi ha hagut un error')}</div>
					}
				}()
			}
		</div>
	}
}
