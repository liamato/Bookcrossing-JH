import React from 'react'
import request from 'superagent'
import config from '../../../config'
import translate from '../../../translate'
import { default as Im } from 'immutable'
import BookShelf from '../../assets/bookshelf'
import BookSearch from '../../assets/booksearch'
import Loading from '../../assets/loading'

export default class List extends React.Component {

	componentWillMount() {
		if (!this.props.school.books) {
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
			var title = translate('libro', 'Llibre');
			title= title[0].toUpperCase()+title.slice(1)+'s';
			if(this.props.school.books[0]){
				let uncatched = this.props.school.books.whereLoose('catched',0);
				let catched = this.props.school.books.whereLoose('catched',1);
				return (
					<div className="school-list">
						<h1 className="school-list__title">{title}</h1>
						<hr className="school-list__break"/>
						<section className="list-column">
							<h2>{translate('disponibles','Disponibles')}</h2>
							<BookShelf books={uncatched} controls/>
						</section>
						<section className="list-column">
							<h2>{translate('capturados','Capturats')}</h2>
							<BookShelf books={catched} controls/>
						</section>
					</div>
				)
			}
			return (
				<div className="school-list">
					<h1>{title}</h1>
					<hr/>
					<p>{translate('no-resultados', 'No hi han resultats')}</p>
				</div>
			)
		}
		return <Loading/>
	}
}
