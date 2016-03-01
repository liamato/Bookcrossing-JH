import React from 'react'
import request from 'superagent'
import config from '../../../config'
import { default as Im } from 'immutable'
import Post from '../../assets/post'

export default class Forum extends React.Component {
	constructor(props) {
		super(props);
		this.state = {};
 	}

 	componentWillMount() {
		this.updateCategory();
		if (!this.props.school.posts) {
			this.setPosts();
		}
	}

	componentReciveProps(props) {
		this.setPosts();
		this.updateCategory();
	}

	setPosts() {
		request
		.get(`${config.api.baseUrl}/school/${this.props.params.school}/post`)
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.end((err, res) => {
			if (res.ok) {
				let json = JSON.parse(res.text);
				var posts = {};
				if(this.props.school.posts){
					posts = this.props.school.posts;
				}
				var a = Im.fromJS(posts);
				var b = a.merge(Im.fromJS(json));
				var c = null;
				if (a !== b) {
					this.props.updateSchool({posts: json});
					c = undefined;
				}
				this.updateCategory(c)
			} else if(err) {
				console.log(err);
			}
		}.bind(this));
	}

	updateCategory(category, callback) {
		if (category === null) {
			if (!this.state.category) {
				category = undefined;
			} else {
				callback();
				return;
			}
		}
		if (!isNaN(category)) {
			this.setState({category: category}, callback);
		} else if(this.props.school.categories && category === undefined) {
			this.setState({category: this.props.school.categories[0].id}, callback);
		}
	}

	changeHandler(e) {
		this.updateCategory(e.nativeEvent.target.value);
	}


	render() {
		if(this.props.school.posts && this.props.school.categories){
			return <div>
			<select onChange={this.changeHandler.bind(this)}>
				{
					this.props.school.categories.map((category) => {
						return <option key={category.id} value={category.id}>{category.name}</option>
					})
				}
			</select>
			{
				this.props.school.posts.where('category_id',this.state.category,false).where('parent', 0, false).map((post) => {
					return	<Post key={post.id} {...post} posts={this.props.school.posts} />
				})
			}
			</div>
		}
		return <div></div>
	}
}
