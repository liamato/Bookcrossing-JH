import React from 'react'
import request from 'superagent'
import config from '../../../config'
import { default as Im } from 'immutable'
import BookSearch from '../../assets/booksearch'
import Loading from '../../assets/loading'


export default class Capture extends React.Component {

	componentWillMount() {
		this.setState({request: 0});
	}

	selectBook(ev, id, active) {
		this.setState({request: 1});
		request
		.put(`${config.api.baseUrl}/school/${this.props.params.school}/book/${id}`)
		.send({catched: true})
		.type('json')
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, req) => {
			
			this.setState({request: 2, res: [err, req]});
		});
	}

	render() {

		if (this.state.request === 0) {
			if (this.props.school.books) {
				return (
						<BookSearch onBookClick={this.selectBook.bind(this)} by="name" books={this.props.school.books.whereLoose('catched',false)} selectable/>
					)
			}
			return <Loading/>
		} else if(this.state.request === 1) {
			return <div>Capturant llibre...</div>
		} else if (this.state.request === 2) {
			if (this.state.res[1].ok) {
				return <div>Llibre alliberat</div>				
			}
			return <div>Hi ha hagut un error</div>
		}
	}
}
