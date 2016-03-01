import React from 'react'
import request from 'superagent'
import config from '../../../config'
import BookSearch from '../../assets/booksearch'
import Loading from '../../assets/loading'


export default class Liberate extends React.Component {

	componentWillMount() {
		this.setState({request: 0});
	}

	selectBook(ev, id, active) {
		this.setState({request: 1});
		request
		.put(`${config.api.baseUrl}/school/${this.props.params.school}/book/${id}`)
		.send({catched: false})
		.type('json')
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, req) => {
			this.setState({request: 2, res: [err, res]});
		});
	}

	render() {

		if (this.state.request === 0) {
			if (this.props.school.books) {
				return (
						<BookSearch onBookClick={this.selectBook.bind(this)} by="name" books={this.props.school.books.whereLoose('catched',true)} selectable/>
					)
			}
			return <Loading/>
		} else if(this.state.request === 1) {
			return <div>Alliberant llibre...</div>
		} else if (this.state.request === 2) {
			if (this.state.res[1].ok) {
				return <div>Llibre alliberat</div>				
			}
			return <div>Hi ha hagut un error</div>
		}
	}
}
