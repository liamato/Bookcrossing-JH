import React from 'react'
import request from 'superagent'
import config from '../../../config'
import translate from '../../../translate'
import { default as Im } from 'immutable'
import Post from '../../assets/post'
import AddPost from '../../assets/addpost'

export default class Forum extends React.Component {

	componentWillMount() {
		this.setState({category: undefined});
		this.updateCategory();
	}

	componentDidMount() {
		if (!this.props.school.posts) {
			this.setPosts();
		}

	}

	componentWillReciveProps(props) {
		this.setPosts();
		this.updateCategory();

	}

	componentDidUpdate(props) {
		//this.setPosts();
		//this.updateCategory();
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
				this.updateCategory()
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
		} else if(category === undefined) {
			this.setPosts();
		}
	}

	changeHandler(e) {
		this.updateCategory(e.target.value);
	}

	writeMsg(msg) {
		console.log(msg);
	}

	render() {
		if(this.props.school.posts && this.props.school.categories && this.state.category !== undefined){
			return <div className="school-forum">
				<h1>{translate('forum', 'Forum')}</h1>
				<hr/>
				<div className="forum__controls">
				<select onChange={this.changeHandler.bind(this)} className="forum__category">
					{
						this.props.school.categories.map((category) => {
							return <option key={category.id} value={category.id} >{category.name}</option>
						})
					}
				</select>
				<AddPost parent={0} schoolSlug={this.props.school.slug} writeMsg={this.writeMsg.bind(this)} category={this.state.category} />
				</div>
				{
					this.props.school.posts.where('category_id',this.state.category,false).where('parent', 0, false).map((post) => {
						return	<Post key={post.id} {...post} posts={this.props.school.posts} schoolSlug={this.props.school.slug} writeMsg={this.writeMsg.bind(this)} category={this.state.category} />
					})
				}
			</div>
		}
		return <div></div>
	}
}
