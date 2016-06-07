import React from 'react'
import ReactDom from 'react-dom'
import Collection from '../../data/collection'
import request from 'superagent'
import config from '../../config'
import Resource from '../assets/resource'
import Category from '../assets/category'

class App extends React.Component {

	componentWillMount() {
		this.setState({selected: [], add: false});
	}

	newCategory() {
		this.setState({add: true});
	}

	add(item) {
		delete item.id;

		request
		.post(`${config.api.baseUrl}/school/${db.school}/category`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(item)
		.end((err, req) => {
			if(req.ok){
				let cp = this.props.categories.prepend([]);
				cp.push(JSON.parse(req.body));
				this.setState({add: false});
				reRender(cp);
			}
		});

	}

	select(selected, i, item) {
		this.setState({selected: selected});
	}

	remove(ndb, i, item) {
		request
		.del(`${config.api.baseUrl}/school/${db.school}/category/${item.id}`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.end((err, req) => {
			if (req.ok) {
				reRender(ndb);
			}
		});
	}

	save(ndb, i, item) {
		request
		.put(`${config.api.baseUrl}/school/${db.school}/category/${item.id}`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(item)
		.end((err, req) => {
			if (req.ok) {
				reRender(ndb);
			}
		});
	}

	render()
	{
		return <div>
			{
				() => {
					if(!this.state.add){
						return <button onClick={this.newCategory.bind(this)}>Afegir nou</button>
					}
					return <Category edit name="" slug="" id="-1" save={this.add.bind(this)}/>
				}()
			}
			<Resource db={Object.assign((new Collection), this.props.categories)} component={Category} mode="ser" selected={this.state.selected} select={this.select.bind(this)} remove={this.remove.bind(this)} save={this.save.bind(this)} />
		</div>
	}
}

App.propTypes = {
	categories: React.PropTypes.instanceOf(Collection).isRequired,

};


function reRender(categories) {
	categories = categories ? new Collection(categories) : new Collection(db.categories.slice(0));
	ReactDom.render(<App categories={categories} />, document.getElementById('app'));
}

reRender();
