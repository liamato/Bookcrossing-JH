import React from 'react'
import Resource from '../assets/resource'

export default class Post extends React.Component {
	componentWillMount() {
		this.setState({active: this.props.active, add: false});
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
		if (parent.getElementsByClassName('post__title--edit')[0].value != this.props.title) o.title = parent.getElementsByClassName('post__title--edit')[0].value
		if (parent.getElementsByClassName('post__author--edit')[0].value != this.props.author) o.author = parent.getElementsByClassName('post__author--edit')[0].value
		if (parent.getElementsByClassName('post__body--edit')[0].value != this.props.body) o.body = parent.getElementsByClassName('post__body--edit')[0].value
		this.props.save(o);
	}

	newPost() {
		this.setState({add: true});
	}

	render() {
		if (!this.props.edit) {
			return (
				<div onClick={this.toggle.bind(this)} className={()=>{
						let ret = "post"
						if(this.state.active){ret += ' post--active'}
						if(this.props.selectable){ret += ' post--selectable'}
						return ret
					}()}>
					<span>{this.props.id}</span>
					<span>{this.props.title} - {this.props.author}</span>
					<p>{this.props.body}</p>
					{
						() => {
							if(!this.state.add){
								return <button onClick={this.newPost.bind(this)}>Afegir nou</button>
							}
							return <Post edit body="" title="" author="" id="-1" category_id={this.props.category_id} parent={this.props.id} save={() => {this.props.setState({add: false});this.props.actions.add.bind(this)}}/>
						}()
					}
					<Resource db={this.props.posts.where('category_id',this.props.category_id).where('parent', this.props.id)} props={{posts: this.props.posts, actions: this.props.actions}} component={Post} selected={this.props.selected} select={this.props.actions.select} remove={this.props.actions.remove} save={this.props.actions.save} />
				</div>
			)
		}
		return (
			<div onClick={this.toggle.bind(this)} className={()=>{
					let ret = "post"
					if(this.state.active){ret += ' post--active'}
					if(this.props.selectable){ret += ' post--selectable'}
					if(this.props.edit){ret += ' post--edit'}
					return ret
				}()}>
				<label htmlFor="">Titol</label>
				<input type="text" className="post__title--edit" defaultValue={this.props.title} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Autor</label>
				<input type="text" className="post__author--edit" defaultValue={this.props.author} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Text</label>
				<input type="text" className="post__body--edit" defaultValue={this.props.author} onClick={this.noPropagation.bind(this)}/>
				<button onClick={this.save.bind(this)}>Guardar</button>
			</div>
		)
	}
}

Post.propTypes = {
	// Post description
	title: React.PropTypes.string.isRequired,
	body: React.PropTypes.string.isRequired,
	author: React.PropTypes.string.isRequired,
	id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	category_id: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	parent: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,


	selectable: React.PropTypes.bool.isRequired,

	active: React.PropTypes.bool.isRequired,

	edit: React.PropTypes.bool.isRequired,

	onclick: React.PropTypes.func,

	save: React.PropTypes.func
};

Post.defaultProps = {
	selectable: false,
	active: false,
	edit: false,
};
