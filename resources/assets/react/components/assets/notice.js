import React from 'react'

export default class Notice extends React.Component {

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
			o = {};
		o.title = parent.getElementsByClassName('notice__title--edit')[0].value
		o.author = parent.getElementsByClassName('notice__author--edit')[0].value
		o.catched = parent.getElementsByClassName('notice__catch--edit')[0].checked
		o.checked = parent.getElementsByClassName('notice__check--edit')[0].checked;
		this.props.save(o);
	}

	render() {
		return (
			<article className="notice">
				<h2>{this.props.title}</h2>
				<blockquote>{this.props.body}</blockquote>
				<p>{this.props.author}</p>
			</article>
		)
		if (!this.props.edit) {
			return (
				<article onClick={this.toggle.bind(this)} className={()=>{
						let ret = "notice"
						if(this.state.active){ret += ' notice--active'}
						if(this.props.selectable){ret += ' notice--selectable'}
						return ret
					}()}>
					<h2>{this.props.notice.title}</h2>
					<blockquote>{this.props.notice.body}</blockquote>
					<p>{this.props.notice.author}</p>
				</article>
			)
		}
		return (
			<div onClick={this.toggle.bind(this)} className={()=>{
					let ret = "notice"
					if(this.state.active){ret += ' notice--active'}
					if(this.props.selectable){ret += ' notice--selectable'}
					if(this.props.edit){ret += ' notice--edit'}
					return ret
				}()}>
				<label htmlFor="">Titol</label>
				<input type="text" className="notice__title--edit" defaultValue={this.props.title} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Autor</label>
				<input type="text" className="notice__author--edit" defaultValue={this.props.author} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Noticia</label>
				<input type="text" className="notice__body--edit" defaultValue={this.props.body} onClick={this.noPropagation.bind(this)}/>
				<button onClick={this.save.bind(this)}>Guardar</button>
			</div>
		)
	}
}

Notice.propTypes = {
	author: React.PropTypes.string,
	body: React.PropTypes.string.isRequired,
	title: React.PropTypes.string.isRequired,


	selectable: React.PropTypes.bool.isRequired,

	active: React.PropTypes.bool.isRequired,

	edit: React.PropTypes.bool.isRequired,

	onclick: React.PropTypes.func,

	save: React.PropTypes.func
};

Notice.defaultProps = {
	selectable: false,
	active: false,
	edit: false,
};
