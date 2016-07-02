import React from 'react';
import request from 'superagent'
import config from '../../config'
import { Link } from 'react-router'
import uid from 'uid'



export default class Home extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			schools: []
		};
	}

	componentWillMount() {
			this.setSchools();
		if (!window.config){
		}
	}

	setSchools() {
		request
		.get(`${config.api.baseUrl}/school`)
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end(function(err, res) {
			if (res.ok) {
				var schools = JSON.parse(res.text);
			}else if (err) {
				console.log(err);
			}
			this.setState({schools: schools});
		}.bind(this));
	}

	render() {
		return <div>
			{
				this.state.schools.map(function(school){
					return <Link to={`/${school.slug}/`} key={school.id}>{school.name}</Link>
				})
			}
		</div>
	}
}
