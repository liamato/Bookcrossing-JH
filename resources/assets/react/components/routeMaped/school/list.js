import React from 'react'
import request from 'superagent'
import config from '../../../config'
import { default as Im } from 'immutable'
import BookShelf from '../../assets/bookshelf'
import BookSearch from '../../assets/booksearch'
import Loading from '../../assets/loading'

export default class List extends React.Component {

	componentWillMount() {
		if (this.props.school.books) {
			this.setBooks();
		}
	}

	componentReciveProps(props) {
		this.setBooks();
	}

	setBooks() {
		request
		.get(`${config.api.baseUrl}/school/${this.props.params.school}/book`)
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, res) => {
			if (res.ok) {
				let json = JSON.parse(res.text);
				let a = Im.fromJS(this.props.school.books);
				let b = a.merge(Im.fromJS(json));
				if (a !== b) {
					this.props.updateSchool({books: json});
				}
			} else if(err) {
				console.log(err);
			}
		});
	}

	render() {
		if (this.props.school.books){
			if(this.props.school.books[0]){
				let uncatched = this.props.school.books.whereLoose('catched',0);
				let catched = this.props.school.books.whereLoose('catched',1);
				return (
					<div>
						<h1>Llibres</h1>
						<hr/>
						<h2>Per Agafar</h2>
						<BookShelf books={uncatched} controls/>
						<h2>Agafats</h2>
						<BookShelf books={catched} controls/>
					</div>
				)
			}
			return (
				<div>
					<h1>Llibres</h1>
					<hr/>
					<p>No hi ha llibres</p>
				</div>
			)
		}
		return <Loading/>
	} 
}
