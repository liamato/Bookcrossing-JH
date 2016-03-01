import React from 'react'
import Collection from '../../data/collection'

export default class Post extends React.Component {
	render() {
		return (
			<article className="post">
				<h2>{this.props.title}</h2>
				<blockquote>{this.props.body}</blockquote>
				<p>id: {this.props.id}, parent: {this.props.parent}, category: {this.props.category_id}</p>
				<p>{this.props.author}</p>
				{
					this.props.posts.where('category_id',this.props.category_id).where('parent', this.props.id).map((post) => {
						return <Post key={post.id} {...post} posts={this.props.posts} />
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
	posts: React.PropTypes.instanceOf(Collection).isRequired
};
