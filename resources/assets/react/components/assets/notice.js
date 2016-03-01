import React from 'react'

export default class Notice extends React.Component {
	render() {
		return (
			<article className="post">
				<h2>{this.props.notice.title}</h2>
				<blockquote>{this.props.notice.body}</blockquote>
				<p>{this.props.notice.author}</p>
			</article>
		)
	}
}

Notice.propTypes = {
	notice: React.PropTypes.shape({
		author: React.PropTypes.string,
		body: React.PropTypes.string.isRequired,
		title: React.PropTypes.string.isRequired
	}).isRequired
};
