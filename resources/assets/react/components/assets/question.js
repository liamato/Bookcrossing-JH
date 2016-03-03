import React from 'react'


export default class Question extends React.Component {
	render()
	{
		return (
			<div className="question">
				{
					() => {
						if (this.props.title) {
							return <h3 className="question__title">{this.props.title}</h3>
						}
					}()
				}
				<div className="question__msg">
					{this.props.msg}
				</div>
				<div className={()=>{let x="question__controls";return this.props.optional?`${x} question--optional`:x}}>
					<button onClick={this.props.onAccept.bind(this)} className="question__accept">{this.props.acceptMsg}</button>
					{
						() => {
							if (this.props.optional) {
								<button onClick={this.props.onDecline.bind(this)} className="question__decline">{this.declineMsg}</button>
							}
						}()
					}
				</div>
			</div>
		);
	}
}

Question.propTypes = {
	title: React.PropTypes.node,
	msg: React.PropTypes.node.isRequired,
	onAccept: React.PropTypes.func.isRequired,
	acceptMsg: React.PropTypes.string,
	onDecline: React.PropTypes.func,
	declineMsg: React.PropTypes.string,
	optional: React.PropTypes.bool.isRequired,
};

Question.defaultProps = {
	optional: false,
	acceptMsg: "Accept",
	declineMsg: "Decline",
};
