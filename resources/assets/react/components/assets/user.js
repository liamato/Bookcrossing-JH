import React from 'react'

export default class User extends React.Component {
	componentWillMount() {
		this.setState({active: this.props.active});
	}

	componentWillReciveProps(props) {
		this.setState({active: props.active});
	}

	toggle(ev) {
		var active = this.state.active;
		if (this.props.selectable){
			if (this.state.active) {
				active = false;
			} else {
				active = true;
			}
		}
		if (typeof(this.props.onclick) === 'function') {
			this.props.onclick(ev, active, this.props.id);
		}
		this.setState({active: active});
	}

	noPropagation(e) {
		e.stopPropagation();
	}

	save(e) {
		var parent = e.target.parentElement,
			o = {id: this.props.id};
		if (parent.getElementsByClassName('user__email--edit')[0].value != this.props.email) o.email = parent.getElementsByClassName('user__email--edit')[0].value
		if (parent.getElementsByClassName('user__name--edit')[0].value != this.props.name) o.name = parent.getElementsByClassName('user__name--edit')[0].value
		if (parent.getElementsByClassName('user__password--edit')[0].value && parent.getElementsByClassName('user__password--edit')[0].value != this.props.password) o.password = parent.getElementsByClassName('user__password--edit')[0].value
		this.props.save(o);
	}

	render() {
		if (!this.props.edit) {
			return (
				<div onClick={this.toggle.bind(this)} className={()=>{
						let ret = "user"
						if(this.state.active){ret += ' user--active'}
						if(this.props.selectable){ret += ' user--selectable'}
						return ret
					}()}>
					<span>{this.props.id}</span>
					<span>{this.props.name} - {this.props.email}</span>
				</div>
			)
		}
		return (
			<div onClick={this.toggle.bind(this)} className={()=>{
					let ret = "user"
					if(this.state.active){ret += ' user--active'}
					if(this.props.selectable){ret += ' user--selectable'}
					if(this.props.edit){ret += ' user--edit'}
					return ret
				}()}>
				<label htmlFor="">Nom</label>
				<input type="text" className="user__name--edit" defaultValue={this.props.name} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Email</label>
				<input type="text" className="user__email--edit" defaultValue={this.props.email} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Password</label>
				<input type="password" className="user__password--edit" onClick={this.noPropagation.bind(this)}/>
				<button onClick={this.save.bind(this)}>Guardar</button>
			</div>
		)
	}
}

User.propTypes = {
	// User description
	name: React.PropTypes.string.isRequired,
	id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	email: React.PropTypes.string.isRequired,


	selectable: React.PropTypes.bool.isRequired,

	active: React.PropTypes.bool.isRequired,

	edit: React.PropTypes.bool.isRequired,

	onclick: React.PropTypes.func,

	save: React.PropTypes.func
};

User.defaultProps = {
	selectable: false,
	active: false,
	edit: false,
};
