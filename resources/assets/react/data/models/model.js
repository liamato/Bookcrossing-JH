import request from 'superagent'
import config from '../../../config'
import { default as Im } from 'immutable'


var Model = class Model {
	const api = config.api.baseUrl+'/'

	static request() {
		request
		.get(`${this.api}/${this.url}/${}`)
		.accept('json')
		.end((err, req)=> {
			if (req.ok) {
				var school = JSON.parse(req.text);
				Object.keys(school).map((key) =>{
					if (school[key] instanceof Array) {
						school[key] = new Collection(school[key]);
					}
				});
			} else if (err) {
				console.log(err);
			}
			this.setState({school: this.||this.state.school}, callback);
		});
	}

	static all() {
		

	}


	update(item, callback) {
		if (!school) {
			request
			.get(`${config.api.baseUrl}/school/${this.props.params.school}`)
			.accept('json')
			.end((err, req)=> {
				if (req.ok) {
					var school = JSON.parse(req.text);
					Object.keys(school).map((key) =>{
						if (school[key] instanceof Array) {
							school[key] = new Collection(school[key]);
						}
					});
				} else if (err) {
					console.log(err);
				}
				this.setState({school: school||this.state.school}, callback);
			});
		} else {
			if (school.school) {
				school = school.school;
			}
			this.setState({
				school: Object.assign(this.state.school, school)
			}, callback);
		}
	}
}
window.Model = Model;

export default Model;