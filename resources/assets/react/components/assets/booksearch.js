import React from 'react'
import BookShelf from './bookshelf'
import Collection from '../../data/collection'
import Uid from 'uid'

export default class BookSearch extends React.Component {


	componentWillMount() {
		this.setState({controls: [], books: new Collection, name: '', author: '', id: ''});
	}

	componentDidMount() {
		if (this.props.controls) {
			let cp = this.state.controls;
			if (this.props.controls instanceof Array) {
				loop:
				for(let v = 0; this.props.controls.length > v; v++) {
					switch (this.props.controls[v].toLowerCase()) {
						case 'name':
							cp.push('name');
							break;
						case 'author':
							cp.push('author');
							break;
						case 'id':
							cp.push('id');
							break;
						case 'all':
							cp = ['all'];
							break;
						case '*':
							cp = ['all'];
							break loop;
					}
				}
				if (!this.props.controls.length) {
					cp = [];
				}
			} else {
				if (typeof(this.props.controls) === 'string') {
					switch (this.props.controls.toLowerCase()) {
						case 'name':
							cp.push('name');
							break;
						case 'author':
							cp.push('author');
							break;
						case 'id':
							cp.push('id');
							break;
						case 'all':
							cp = ['all'];
							break;
						case '*':
							cp = ['all'];
							break;
					}
				} else {
					switch (this.props.controls) {
						case false:
							cp = []
							break;
						case true:
							cp = ['all'];
							break;
					}
				}
			}
			this.setState({controls: cp});
		}
	}

	by(books, val, step) {
		if (step != 'all') {
			return books.get(books.fragSearch(val, step));
		} else {
			var i = new Collection;
			['id', 'title', 'author'].map((s)=>{
				i.massInsert((new Collection(books.fragSearch(val, s))).diff(i.all()).all());
			}.bind(this));
			let ret = new Collection;
			i.map((v) => {
				ret.push(books.get(v));
			});
			return ret;
		}

	}

	search(ev) {
		if(ev.target.value) {
			var books = this.props.books;
			if (this.state.controls.indexOf('all') === -1) {
				['title', 'author', 'id'].map((s)=>{
					if (this.state.controls.indexOf(s) > -1) {
						books = this.by(books, ev.target.value, s);
					}
				});
			} else {
				books = this.by(books, ev.target.value, 'all');
			}
		} else {
			var books = new Collection;
		}
		this.setState({books: books});

	}


	render() {
		return (
			<div className="booksearch">
				{
					() => {
						if (this.state.controls.length){
							let uid = Uid();
							return (
									<div className="booksearch-controls">
										<label htmlFor={`search_${uid}`}>Search: </label>
										<input type="text" id={`search_${uid}`} onChange={this.search.bind(this)}/>
									</div>
								)
						} else {
							return <div></div>
						}
					}()
				}
				<BookShelf books={this.state.books} onBookClick={this.props.onBookClick} selectable={this.props.selectable} active={this.props.active}/>
			</div>
		)

	}
}

BookSearch.propTypes = {
	books: React.PropTypes.instanceOf(Collection).isRequired,
	onBookClick: React.PropTypes.func,
	/* serch by */
	controls: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.arrayOf(React.PropTypes.string),
		React.PropTypes.bool
	]),
	/* order */
	by: React.PropTypes.oneOf(['name','author','id','code']),
	selectable: React.PropTypes.bool,
	active: React.PropTypes.arrayOf(React.PropTypes.string)
};

BookSearch.defaultProps = {
	controls: '*'
};