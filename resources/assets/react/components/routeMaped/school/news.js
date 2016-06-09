import React from 'react'
import request from 'superagent'
import config from '../../../config'
//import uid from 'uid'
import { default as Im } from 'immutable'
import Notice from '../../assets/notice'
import Loading from '../../assets/loading'


export default class News extends React.Component {

	componentWillMount() {
		if (this.props.school.news) {
			this.setNews();
		}
	}

	componentReciveProps(props) {
		this.setNews();
	}

	setNews() {
		request
		.get(`${config.api.baseUrl}/school/${this.props.params.school}/news`)
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, res) => {
			if (res.ok) {
				var json = JSON.parse(res.text);
				var a = Im.fromJS(this.props.school.news);
				var b = a.merge(Im.fromJS(json));
				if (a !== b) {
					this.props.updateSchool({news: json});
				}
			} else if(err) {
				console.log(err);
			}
		});
	}

	render() {
		if(this.props.school.news){
			if(this.props.school.news[0]){
				let news = this.props.school.news.sortBy('created_at', true)

				return (
					<div>
						<h1>Novedades</h1>
						<hr/>
						{
							news.map((notice) => {
								return (
									<Notice {...notice} key={notice.id} />
								)
							})
						}
					</div>
				)
			}
			return (
				<div>
					<h1>Novedades</h1>
					<hr/>
					<p>No hi ha noticies</p>
				</div>
			)
		}
		return <Loading/>
	}
}
