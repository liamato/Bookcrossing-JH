import React from 'react'
import ReactDom from 'react-dom'
import Collection from '../../data/collection'
import request from 'superagent'
import config from '../../config'
import Resource from '../assets/resource'
import Post from '../assets/postAdmin'

class App extends React.Component {

	componentWillMount() {
		this.setState({selected: [], add: false, category: db.categories[0].id});
	}

	newPost() {
		this.setState({add: true});
	}

	add(item) {
		delete item.id;

		request
		.post(`${config.api.baseUrl}/school/${db.school}/post`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(item)
		.end((err, req) => {
			if(req.ok){
				let cp = this.props.posts.prepend([]);
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
		.del(`${config.api.baseUrl}/school/${db.school}/post/${item.id}`)
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
		.put(`${config.api.baseUrl}/school/${db.school}/post/${item.id}`)
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
			<select onChange={(e)=>{this.setState({category: e.target.value, add: false})}}>
				{
					db.categories.map((c) => {
						return <option key={c.id} value={c.id}>{c.name}</option>
					})
				}
			</select>
			{
				() => {
					if(!this.state.add){
						return <button onClick={this.newPost.bind(this)}>Afegir nou</button>
					}
					return <Post edit body="" title="" author="" id="-1" category_id={this.state.category} parent={0} save={this.add.bind(this)}/>
				}()
			}
			<Resource db={Object.assign((new Collection), this.props.posts).whereLoose('category_id', this.state.category).whereLoose('parent', 0)} props={{posts: this.props.posts, selected: this.state.selected, actions: {select:this.select.bind(this), remove:this.remove.bind(this), save:this.save.bind(this)}, add:this.add.bind(this)}} component={Post} mode="ser" selected={this.state.selected} select={this.select.bind(this)} remove={this.remove.bind(this)} save={this.save.bind(this)} />
		</div>
	}
}

App.propTypes = {
	posts: React.PropTypes.instanceOf(Collection).isRequired,

};


function reRender(posts) {
	posts = posts ? new Collection(posts) : new Collection(db.posts.slice(0));
	ReactDom.render(<App posts={posts} />, document.getElementById('app'));
}

reRender();
