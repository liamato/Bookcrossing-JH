import React from 'react'
import ReactDom from 'react-dom'
import Collection from '../../data/collection'
import request from 'superagent'
import config from '../../config'
import Resource from '../assets/resource'
import Video from '../assets/video'

class App extends React.Component {

	componentWillMount() {
		this.setState({selected: [], add: false});
	}

	newVideo() {
		this.setState({add: true});
	}

	add(item) {
		delete item.id;

		request
		.post(`${config.api.baseUrl}/school/${db.school}/video`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(item)
		.end((err, req) => {
			if(req.ok){
				let cp = this.props.videos.prepend([]);
				cp.push(JSON.parse(req.text));
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
		.del(`${config.api.baseUrl}/school/${db.school}/video/${item.id}`)
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
		.put(`${config.api.baseUrl}/school/${db.school}/video/${item.id}`)
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
						return <button onClick={this.newVideo.bind(this)}>Afegir nou</button>
					}
					return <Video edit name="" email="" id="-1" save={this.add.bind(this)}/>
				}()
			}
			<Resource db={this.props.videos} component={Video} mode="ser" selected={this.state.selected} select={this.select.bind(this)} remove={this.remove.bind(this)} save={this.save.bind(this)} />
		</div>
	}
}

App.propTypes = {
	videos: React.PropTypes.instanceOf(Collection).isRequired,

};


function reRender(videos) {
	videos = videos ? new Collection(videos) : new Collection(db.videos);
	ReactDom.render(<App videos={videos} />, document.getElementById('app'));
}

reRender();
