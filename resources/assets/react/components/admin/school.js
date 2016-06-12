import React from 'react'
import ReactDom from 'react-dom'
import request from 'superagent'
import config from '../../config'
import School from '../assets/school'

class App extends React.Component {

	save(school) {
		request
		.put(`${config.api.baseUrl}/school/${this.props.id}`)
		.accept('json')
		.type('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.set('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
		.send(school)
		.end((err, req) => {
			if (req.ok) {
				reRender(JSON.parse(req.text));
			}
		});
	}

	render()
	{
		return <div>
			<School edit {...this.props} save={this.save.bind(this)}/>
		</div>
	}
}

App.propTypes = {
	name: React.PropTypes.string.isRequired,
	id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	slug: React.PropTypes.string.isRequired,

};


function reRender(school) {
	school = school ? school : db.school;
	ReactDom.render(<App {...school} />, document.getElementById('app'));
}

reRender();
