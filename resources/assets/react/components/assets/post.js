import React from 'react'
import Collection from '../../data/collection'
import AddPost from './addpost'

export default class Post extends React.Component {

	render() {
		return (
			<article className="post">
				<h2>{this.props.title}</h2>
				<blockquote>{this.props.body}</blockquote>
				<p>id: {this.props.id}, parent: {this.props.parent}, category: {this.props.category_id}</p>
				<p>{this.props.author}</p>




				<AddPost parent={this.props.id} schoolSlug={this.props.schoolSlug} writeMsg={this.props.writeMsg} category={this.props.category_id}/>






				{
					this.props.posts.where('category_id',this.props.category_id).where('parent', this.props.id).map((post) => {
						return <Post key={post.id} {...post} posts={this.props.posts} schoolSlug={this.props.schoolSlug} writeMsg={this.props.writeMsg} />
					})
				}
			</article>
		)
	}
}

Post.propTypes = {
	author: React.PropTypes.string,
	body: React.PropTypes.string.isRequired,
	title: React.PropTypes.string.isRequired,
	category_id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number,
	]).isRequired,
	posts: React.PropTypes.instanceOf(Collection).isRequired,
	schoolSlug: React.PropTypes.string.isRequired,
	writeMsg: React.PropTypes.func.isRequired,
};
