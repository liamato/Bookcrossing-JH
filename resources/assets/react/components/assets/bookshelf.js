import React from 'react'
import Book from './book'
import translate from '../../translate'
import Collection from '../../data/collection'

export default class BookShelf extends React.Component {

	componentWillMount() {
		this.setState({books: this.props.books, direction: true, active: this.props.active});
		if(this.props.controls) {
			this.setState({controls: true});
		}
	}

	componentDidMount() {
		if (this.props.by) {
			switch (this.props.by.toLowerCase()) {
				case 'title':
					this.by('title');
					break;
				case 'author':
					this.by('author');
					break;
				case 'id':
					this.by('id');
					break;
				case 'code':
					this.by('id');
					break;
				default:
					this.by('title');
					break;
			}
		}
	}

	componentWillReceiveProps(props) {
		this.setState({books: props.books, active: props.active});
		if(props.controls) {
			this.setState({controls: true});
		}
		if (this.props.by) {
			switch (this.props.by.toLowerCase()) {
				case 'title':
					this.by('title', props.books);
					break;
				case 'author':
					this.by('author', props.books);
					break;
				case 'id':
					this.by('id', props.books);
					break;
				case 'code':
					this.by('id', props.books);
					break;
				default:
					this.by('title', props.books);
					break;
			}
		}
	}

	by(sort, books) {
		if (!books) books = this.state.books;
		let copy = books;
		if(this.state.by === sort) {
			copy = copy.reverse();
			if (this.state.direction){
				var direction = false;
			} else {
				var direction = true;
			}
		} else {
			if (sort == 'id') {
				copy = copy.sortByNumeric(sort);
			} else {
				copy = copy.sortBy(sort);
			}
			var direction = true;
		}
		this.setState({books: copy, by: sort, direction: direction});
	}

	onBookClick(ev, active, id) {
		let cp = this.state.active;
		if (cp.indexOf(id) > -1) {
			cp.splice(cp.indexOf(id),1);
		} else {
			cp.push(id);
			}
			if (typeof(this.props.onBookClick) === 'function') {
				this.props.onBookClick(ev, id, cp);
			}
			this.setState({active: cp});
		}

	render() {
		return (
			<div className="bookshelf">
				{
					() => {
						if (this.state.controls) {
							return (<div className="bookshelf__controls">
								<button className="bookshelf__control bookshelf__control-code" onClick={this.by.bind(this, 'id', this.state.books)}>{translate('codigo', 'Codi')} <span className={`${this.state.by == 'id' ? this.state.direction ? 'triangle' : 'triangle triangle--reverse' : ''}`}/></button>
								<button className="bookshelf__control bookshelf__control-title" onClick={this.by.bind(this, 'title', this.state.books)}>{translate('titulo', 'Títol')} <span className={`${this.state.by == 'title' ? this.state.direction ? 'triangle' : 'triangle triangle--reverse' : ''}`}/></button>
								<button className="bookshelf__control bookshelf__control-author" onClick={this.by.bind(this, 'author', this.state.books)}>{translate('autor', 'Autor')} <span className={`${this.state.by == 'author' ? this.state.direction ? 'triangle' : 'triangle triangle--reverse' : ''}`}/></button>
							</div>)
						} else {
							return <div/>
						}

					}()

				}
				<ul className="bookshelf__books">
				{
					this.state.books.map((book) => {
						return <li key={book.id} className="bookshelf__book"><Book {...book} onclick={this.onBookClick.bind(this)} active={(this.state.active.indexOf(book.id) > -1)} selectable={this.props.selectable}/></li>
					})
				}
				</ul>
			</div>
		)
	}
}

BookShelf.propTypes = {
	books: React.PropTypes.instanceOf(Collection).isRequired,
	controls: React.PropTypes.bool,
	by: React.PropTypes.oneOf(['title','author','id','code']),
	selectable: React.PropTypes.bool.isRequired,
	active: React.PropTypes.arrayOf(React.PropTypes.string).isRequired
};

BookShelf.defaultProps = {
	by: 'title',

	selectable: false,
	active: []
};
