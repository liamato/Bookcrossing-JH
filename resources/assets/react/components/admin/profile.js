import React from 'react'
import ReactDom from 'react-dom'
import request from 'superagent'
import config from '../../config'
import User from '../assets/user'

class App extends React.Component {

	save(user) {
		request
		.put(`${config.api.baseUrl}/user/${this.props.id}`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(user)
		.end((err, req) => {
			if (req.ok) {
				reRender(JSON.parse(req.text));
			}
		});
	}

	render()
	{
		return <div>
			<User edit {...this.props} save={this.save.bind(this)}/>
		</div>
	}
}

App.propTypes = {
	name: React.PropTypes.string.isRequired,
	id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	email: React.PropTypes.string.isRequired,

};


function reRender(user) {
	user = user ? user : db.user;
	ReactDom.render(<App {...user} />, document.getElementById('app'));
}

reRender();
