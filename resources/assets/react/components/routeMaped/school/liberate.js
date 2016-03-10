import React from 'react'
import request from 'superagent'
import config from '../../../config'
import BookSearch from '../../assets/booksearch'
import Loading from '../../assets/loading'
import Question from '../../assets/question'


export default class Liberate extends React.Component {

	componentWillMount() {
		this.setState({request: 0});
	}

	selectBook()
	{
		this.setState({request: 2});
		request
		.put(`${config.api.baseUrl}/school/${this.props.params.school}/book/${this.state.id}`)
		.send({catched: false})
		.type('json')
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, req) => {
			this.setState({request: 3, res: [err, req]});
			let cp = this.props.school.books;
			cp[cp.search(this.state.id,'id')].catched = "0";
			this.props.updateSchool({books: cp});
		});
	}

	askBook(ev, id, active)	{
		this.setState({request: 1, id: id});
	}

	cancelSelection()
	{
		this.setState({request: 0});
	}

	render() {

		if (this.state.request === 0) {
			if (this.props.school.books) {
				return (
						<BookSearch onBookClick={this.askBook.bind(this)} by="name" books={this.props.school.books.whereLoose('catched',true)} selectable/>
					)
			}
			return <Loading/>
		} else if(this.state.request === 1) {
			return <Question msg="Segur que vols alliberar quest llibre?" onAccept={this.selectBook.bind(this)} onDecline={this.cancelSelection.bind(this)} optional />
		} else if(this.state.request === 2) {
			return <div>Alliberant llibre...</div>
		} else if (this.state.request === 3) {
			if (this.state.res[1].ok) {
				return <div>Llibre alliberat</div>				
			}
			return <div>Hi ha hagut un error</div>
		}
	}
}
