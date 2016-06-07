import React from 'react'

export default class Category extends React.Component {
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
		if (parent.getElementsByClassName('category__name--edit')[0].value != this.props.name) o.name = parent.getElementsByClassName('category__name--edit')[0].value
		if (parent.getElementsByClassName('category__slug--edit')[0].value != this.props.slug) o.slug = parent.getElementsByClassName('category__slug--edit')[0].value
		this.props.save(o);
	}

	render() {
		if (!this.props.edit) {
			return (
				<div onClick={this.toggle.bind(this)} className={()=>{
						let ret = "category"
						if(this.state.active){ret += ' category--active'}
						if(this.props.selectable){ret += ' category--selectable'}
						return ret
					}()}>
					<span>{this.props.id}</span>
					<span>{this.props.name} - <span>{this.props.slug}</span></span>
				</div>
			)
		}
		return (
			<div onClick={this.toggle.bind(this)} className={()=>{
					let ret = "category category--edit"
					if(this.state.active){ret += ' category--active'}
					if(this.props.selectable){ret += ' category--selectable'}
					return ret
				}()}>
				<label htmlFor="">Nom</label>
				<input type="text" className="category__name--edit" defaultValue={this.props.name} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Slug</label>
				<input type="text" className="category__slug--edit" defaultValue={this.props.slug} onClick={this.noPropagation.bind(this)}/>
				<button onClick={this.save.bind(this)}>Guardar</button>
			</div>
		)
	}
}

Category.propTypes = {
	// Category description
	name: React.PropTypes.string.isRequired,
	id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	slug: React.PropTypes.string.isRequired,


	selectable: React.PropTypes.bool.isRequired,

	active: React.PropTypes.bool.isRequired,

	edit: React.PropTypes.bool.isRequired,

	onclick: React.PropTypes.func,

	save: React.PropTypes.func
};

Category.defaultProps = {
	selectable: false,
	active: false,
	edit: false,
};
