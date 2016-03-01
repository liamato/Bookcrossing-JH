import React from 'react'


export default class Video extends React.Component {
	render() {
		return (
			<div className="video">
				<iframe src={`//www.youtube.com/embed/${this.props.code}?autohide=1&rel=0`} frameborde="0" allowFullScreen></iframe>
			</div>
		)
	}
}

Video.propTypes = {
	id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	code: React.PropTypes.string.isRequired,
	trailer: React.PropTypes.oneOfType([
		React.PropTypes.bool,
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	created_at: React.PropTypes.string.isRequired,
	school_id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	])
};