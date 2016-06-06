import React from 'react'
import ReactDom from 'react-dom'
import Collection from '../../data/collection'
import request from 'superagent'
import config from '../../config'
import Resource from '../assets/resource'
import Book from '../assets/book'
import Uid from 'uid'

class App extends React.Component {

	componentWillMount() {
		this.setState({selected: [], add: false});
	}

	newBook() {
		this.setState({add: true});
	}

	add(item) {
		delete item.id;

		request
		.post(`${config.api.baseUrl}/school/${db.school}/book`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(item)
		.end((err, req) => {
			console.log('add');
			console.log(req);
			console.log(err);
		});

	}

	select(selected, i, item) {
		this.setState({selected: selected});
	}

	remove(ndb, i, item) {
		request
		.del(`${config.api.baseUrl}/school/${db.school}/book/${item.id}`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.end((err, req) => {
			console.log('remove');
			console.log(req);
			console.log(err);
		});
	}

	save(ndb, i, item) {
		request
		.put(`${config.api.baseUrl}/school/${db.school}/book/${item.id}`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(item)
		.end((err, req) => {
			console.log('add');
			console.log(req);
			console.log(err);
		});
	}

	render()
	{
		return <div>
			{
				() => {
					if(!this.state.add){
						return <button onClick={this.newBook.bind(this)}>Afegir nou</button>
					}
					return <Book edit title="" author="" id="-1" save={this.add.bind(this)}/>
				}()
			}
			<Resource db={this.props.books} component={Book} mode="ser" selected={this.state.selected} select={this.select.bind(this)} remove={this.remove.bind(this)} save={this.save.bind(this)} />
		</div>
	}
}

App.propTypes = {
	books: React.PropTypes.instanceOf(Collection).isRequired,

};


function reRender(books) {
	books = books ? new Collection(books) : new Collection(db.books);
	ReactDom.render(<App books={books} />, document.getElementById('app'));
}

reRender();
