import React from 'react'
import Collection from '../../data/collection'

export default class Resource extends React.Component {

	componentWillMount() {
		this.setState({edit: null});
	}

	select(i, item, e, active, id) {
		let cp = this.props.selected.slice(0);
		if (!active) {
			cp.splice(cp.indexOf(i),1);
		} else {
			cp.push(i);
		}
		this.props.select(cp, i, item);
	}

	save(i, item, o) {
		let cp = this.props.db.prepend([]);
		cp[i] = Object.assign(item, o);
		this.setState({edit: null});
		this.props.save(cp, i, o);
	}

	edit(i, item, e) {
		this.setState({edit: item.id});
	}

	remove(i, item, e) {
		let cp = this.props.db.prepend([]);
		cp.forget(i);
		if (item.id == this.state.edit) this.setState({edit: null});
		this.props.remove(cp,i,item);
	}

	inOptions(option) {
		var mode = this.props.mode;
		if (mode.length && mode.length < 4) {
			return mode.indexOf(option) !== -1;
		}
		return false
	}

	render() {
		var C = this.props.component;
		return <div className={()=>{var ret="resource ";if(this.props.className){ret+=this.props.className;}return ret}()}>
			{
				this.props.db.map((item, i) => {
					return <div className="resource-item" key={i}>
					<div className="resource-item__controls">
					{
						() => {
							if (this.inOptions('e') && this.state.edit !== item.id) {
								return <button onClick={this.edit.bind(this, i, item)} className="resource-item__edit resource-item__control">Editar</button>
							}
						}()
					}
					{
						() => {
							if (this.inOptions('r')) {
								return <button onClick={this.remove.bind(this, i, item)} className="resource-item__remove resource-item__control">Esborrar</button>
							}
						}()
					}
					</div>
					<C {...item} {...this.props.props} save={this.save.bind(this, i, item)} edit={this.state.edit == item.id} onclick={this.select.bind(this, i,item)} active={this.props.selected.indexOf(item.id) !== -1} selectable={this.inOptions('s')} />
					</div>
				})
			}
		</div>
	}
}

Resource.PropTypes = {
	db: React.PropTypes.instanceOf(Collection).isRequired,
	component: React.PropTypes.object.isRequired,
	mode: React.PropTypes.string.isRequired,
	selected: React.PropTypes.arrayOf(React.PropTypes.number),
	select: React.PropTypes.func,
	remove: React.PropTypes.func,
	save: React.PropTypes.func,
	className: React.PropTypes.string,
	props: React.PropTypes.object,
};

Resource.defaultProps = {
	mode: 'ser',
	selected: []
};
