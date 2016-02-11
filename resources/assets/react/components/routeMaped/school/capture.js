import React from 'react'
import request from 'superagent'
import config from '../../../config'
import { default as Im } from 'immutable'
import BookSearch from '../../assets/booksearch'


export default class Capture extends React.Component {

	componentWillMount() {
		this.setState({request: 0});
	}

	selectBook(ev, id, active) {
		this.setState({request: 1});
		request
		.put(`${config.api.baseUrl}/${this.props.school.name}/books/${id}`)
		.send({catched: true})
		.type('json')
		.accept('json')
		.end((err, req) => {
			
			this.setState({request: 2});
		});

		console.log(ev)
		console.log(id)
		console.log(active)
	}

	render() {

		if (this.state.request === 0) {
			return (
					<BookSearch onBookClick={this.selectBook.bind(this)} by="name" books={this.props.school.books} selectable/>
				)
		} else if(this.state.request === 1) {
			return <div>Capturant llibre...</div>
		} else if (this.state.request === 2) {
			return <div>Llibre capturat</div>
		}
	}
}