import React from 'react'

export default class Book extends React.Component {
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
		if (parent.getElementsByClassName('book__title--edit')[0].value != this.props.title) o.title = parent.getElementsByClassName('book__title--edit')[0].value
		if (parent.getElementsByClassName('book__author--edit')[0].value != this.props.author) o.author = parent.getElementsByClassName('book__author--edit')[0].value
		if (parent.getElementsByClassName('book__catch--edit')[0].checked != this.props.catched) o.catched = parent.getElementsByClassName('book__catch--edit')[0].checked
		if (parent.getElementsByClassName('book__check--edit')[0].checked != this.props.checked) o.checked = parent.getElementsByClassName('book__check--edit')[0].checked;
		this.props.save(o);
	}

	render() {
		if (!this.props.edit) {
			return (
				<div className="book" onClick={this.toggle.bind(this)} className={()=>{
						let ret = "book"
						if(this.state.active){ret += ' book--active'}
						if(this.props.selectable){ret += ' book--selectable'}
						return ret
					}()}>
					<span className="book__code">{this.props.id}</span>
					<span className="book__title">{this.props.title}</span>
					<span className="book__author">{this.props.author}</span>
				</div>
			)
		}
		return (
			<div onClick={this.toggle.bind(this)} className={()=>{
					let ret = "book"
					if(this.state.active){ret += ' book--active'}
					if(this.props.selectable){ret += ' book--selectable'}
					if(this.props.edit){ret += ' book--edit'}
					return ret
				}()}>
				<label htmlFor="">Titol</label>
				<input type="text" className="book__title--edit" defaultValue={this.props.title} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Autor</label>
				<input type="text" className="book__author--edit" defaultValue={this.props.author} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Agafat</label>
				<input type="checkbox" className="book__catch--edit" defaultChecked={this.props.catched} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Revisat</label>
				<input type="checkbox" className="book__check--edit" defaultChecked={true} onClick={this.noPropagation.bind(this)}/>
				<button onClick={this.save.bind(this)}>Guardar</button>
			</div>
		)
	}
}

Book.propTypes = {
	// Book description
	author: React.PropTypes.string.isRequired,
	id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	title: React.PropTypes.string.isRequired,


	selectable: React.PropTypes.bool.isRequired,

	active: React.PropTypes.bool.isRequired,

	edit: React.PropTypes.bool.isRequired,

	onclick: React.PropTypes.func,

	save: React.PropTypes.func
};

Book.defaultProps = {
	selectable: false,
	active: false,
	edit: false,
};
