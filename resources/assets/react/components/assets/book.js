import React from 'react'

export default class Book extends React.Component {
	componentWillMount() {
		this.setState({selectable: this.props.selectable, active: this.props.active});
	}

	componentWillReciveProps(props) {
		this.setState({selectable: props.selectable, active: props.active});
	}

	toggle(ev) {
		var active = this.state.active;
		if (this.state.selectable){
			if (this.state.active) {
				active = false;
			} else {
				active = true;
			}
		}
		if (typeof(this.props.onclick) === 'function') {
			this.props.onclick(ev, this.props.id);
		}
		this.setState({active: active});
	}

	render() {
		return (
			<div onClick={this.toggle.bind(this)} className={()=>{
					let ret = "book"
					if(this.state.active){ret += ' book--active'}
					if(this.state.selectable){ret += ' book--selectable'}
					return ret
				}()}>
				<span>{this.props.id}</span>
				<span>{this.props.title} - {this.props.author}</span>
			</div>
		)
	}
}

Book.propTypes = {
	// Book description
	author: React.PropTypes.string.isRequired,
	id: React.PropTypes.string.isRequired,
	title: React.PropTypes.string.isRequired,


	selectable: React.PropTypes.bool.isRequired,

	active: React.PropTypes.bool.isRequired,

	onclick: React.PropTypes.func
};

Book.defaultProps = {
	selectable: false,
	active: false
};