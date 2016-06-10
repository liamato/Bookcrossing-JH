import React from 'react'
import ReactDom from 'react-dom'
import Collection from '../../data/collection'
import request from 'superagent'
import config from '../../config'
import Resource from '../assets/resource'
import Report from '../assets/notice'

class App extends React.Component {

	componentWillMount() {
		this.setState({selected: [], add: false});
	}

	newReport() {
		this.setState({add: true});
	}

	add(item) {
		delete item.id;

		request
		.post(`${config.api.baseUrl}/school/${db.school}/news`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(item)
		.end((err, req) => {
			if(req.ok){
				let cp = this.props.news.prepend([]);
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
		.del(`${config.api.baseUrl}/school/${db.school}/news/${item.id}`)
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
		.put(`${config.api.baseUrl}/school/${db.school}/news/${item.id}`)
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
						return <button onClick={this.newReport.bind(this)}>Afegir nou</button>
					}
					return <Report edit author="" body="" title="" id="-1" save={this.add.bind(this)}/>
				}()
			}
			<Resource db={Object.assign((new Collection), this.props.news)} component={Report} mode="ser" selected={this.state.selected} select={this.select.bind(this)} remove={this.remove.bind(this)} save={this.save.bind(this)} />
		</div>
	}
}

App.propTypes = {
	news: React.PropTypes.instanceOf(Collection).isRequired,

};


function reRender(news) {
	news = news ? new Collection(news) : new Collection(db.news.slice(0));
	ReactDom.render(<App news={news} />, document.getElementById('app'));
}

reRender();
