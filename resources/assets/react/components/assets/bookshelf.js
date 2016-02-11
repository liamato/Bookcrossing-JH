import React from 'react'
import Book from './book'
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
				case 'name':
					this.byName();
					break;
				case 'author':
					this.byAuthor();
					break;
				case 'id':
					this.byId();
					break;
				case 'code':
					this.byId();
					break;
				default:
					this.byName();
					break;
			}
		}
	}

	componentWillReceiveProps(props) {
		this.setState({books: props.books, active: props.active});
		if(props.controls) {
			this.setState({controls: true});
		}
	}

	componentDidUpdate() {
		if (this.props.by) {
			switch (this.props.by.toLowerCase()) {
				case 'name':
					this.byName();
					break;
				case 'author':
					this.byAuthor();
					break;
				case 'id':
					this.byId();
					break;
				case 'code':
					this.byId();
					break;
				default:
					this.byName();
					break;
			}
		}
	}

	by(sort) {
		let copy = this.state.books;
		if(this.state.by === sort) {
			copy = copy.reverse();
			if (this.state.direction){
				var direction = false;
			} else {
				var direction = true;
			}
		} else {
			copy = copy.sortBy(sort);
			var direction = true;
		}
		this.setState({books: copy, by: sort, direction: direction});
	}

	onBookClick(ev, id) {
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
								<button onClick={this.by.bind(this, 'id')}>Id</button>
								<button onClick={this.by.bind(this, 'name')}>Nom</button>
								<button onClick={this.by.bind(this, 'author')}>Autor</button>
							</div>)
						} else {
							return <div></div>
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
	by: React.PropTypes.oneOf(['name','author','id','code']),
	selectable: React.PropTypes.bool.isRequired,
	active: React.PropTypes.arrayOf(React.PropTypes.string).isRequired
};

BookShelf.defaultProps = {
	selectable: false,
	active: []
};