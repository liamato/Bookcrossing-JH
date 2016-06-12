import React from 'react'


export default class Video extends React.Component {
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
			var video = parent.getElementsByClassName('video__code--edit')[0].value,
				r =RegExp("^\w*:\/\/[\w\.]*\/watch\?v\=(.{11}).*$|^\w*:\/\/[\w\.]*\/(.{11}).*$|^<iframe.*src\=.*\/\/[\w\.]*\/embed\/(.{11}).*$|^[A-Za-z0-9\_\-]{11}$", 'm');
		video = r.exec(video);
		if (video) {
			for (var x = video.length; x>-1;x--) {
				if (video[x]) {
					if (video[x] != this.props.code) o.code = video[x]
					break;
				}
			}
		}
		if (parent.getElementsByClassName('video__author--edit')[0].value != this.props.author) o.author = parent.getElementsByClassName('video__author--edit')[0].value
		if (parent.getElementsByClassName('video__trailer--edit')[0].value != this.props.trailer) o.trailer = parent.getElementsByClassName('video__trailer--edit')[0].value
		this.props.save(o);
	}

	render() {
		if (!this.props.edit) {
			return (
				<div className="video">
					<iframe src={`//www.youtube.com/embed/${this.props.code}?autohide=1&rel=0`} frameborde="0" allowFullScreen></iframe>
					{
						() => {
							if (this.props.author) {
								return <p>{this.props.author}</p>
							}
						}()
					}
				</div>
			)
		}
		return (
			<div onClick={this.toggle.bind(this)} className={()=>{
					let ret = "video"
					if(this.state.active){ret += ' video--active'}
					if(this.props.selectable){ret += ' video--selectable'}
					if(this.props.edit){ret += ' video--edit'}
					return ret
				}()}>
				<label htmlFor="">Codi del video</label>
				<input type="text" className="video__code--edit" defaultValue={this.props.code} onClick={this.noPropagation.bind(this)} pattern="^\w*:\/\/[\w\.]*\/watch\?v\=(.{11}).*$|^\w*:\/\/[\w\.]*\/(.{11}).*$|^<iframe.*src\=.*\/\/[\w\.]*\/embed\/(.{11}).*$|^[A-Za-z0-9\_\-]{11}$"/>
				<label htmlFor="">Autor</label>
				<input type="text" className="video__author--edit" defaultValue={this.props.author} onClick={this.noPropagation.bind(this)}/>
				<label htmlFor="">Tipus</label>
				<select className="video__trailer--edit" onClick={this.noPropagation.bind(this)}>
					<option value={0} selected={parseInt(this.props.trailer,10)==0?'selected':''}>BookTube</option>
					<option value={1} selected={parseInt(this.props.trailer,10)==1?'selected':''}>BookTrailer</option>
				</select>

				<button onClick={this.save.bind(this)}>Guardar</button>
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
	author: React.PropTypes.string,
	trailer: React.PropTypes.oneOfType([
		React.PropTypes.bool,
		React.PropTypes.string,
		React.PropTypes.number
	]).isRequired,
	created_at: React.PropTypes.string.isRequired,


	selectable: React.PropTypes.bool.isRequired,

	active: React.PropTypes.bool.isRequired,

	edit: React.PropTypes.bool.isRequired,

	onclick: React.PropTypes.func,

	save: React.PropTypes.func
};
