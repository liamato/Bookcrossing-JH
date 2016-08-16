import React from 'react'
import request from 'superagent'
import config from '../../config'
import translate from '../../translate'
import Uid from 'uid'
import tinyInit from '../../tinyInit'

export default class AddPost extends React.Component {

	componentWillMount()
	{
		this.setState({btn: true});
	}

	componentDidUpdate()
	{
		var lang;
		if (window.localStorage && localStorage.lang) lang = localStorage.lang
		tinyInit(lang);
	}

	send(id, ev)
	{
		var path = `${config.api.baseUrl}/school/${this.props.schoolSlug}/post`;
		if (tinyMCE) {
			var body = tinyMCE.get(`body-${id}`).getContent();
		} else {
			var body = document.getElementById(`body-${id}`).value;
		}
		var snd  = {
			title: document.getElementById(`title-${id}`).value,
			body: body,
			author: document.getElementById(`author-${id}`).value,
			category_id: this.props.category
		};
		if (this.props.parent) snd.parent = this.props.parent

		request
		.post(path)
		.accept('json')
		.set('X-Requested-With', 'XMLHttpRequest')
		.send(snd)
		.end((err, req)=> {
			if (req.ok) {
				this.props.writeMsg('Missatge enviat correctament');
			} else if (err) {
				this.props.writeMsg('El missatge no s\'hapogut enviar');
				console.log(err);
			}
			this.close();
		});
	}

	close()
	{
		this.setState({btn: true});
	}

	open()
	{
		this.setState({btn: false});
	}

	render()
	{
		var uid = Uid();
		return <div className="addPost">
			{
				() => {
					if (this.state.btn) {
						return <button className="addPost__btn btn" onClick={this.open.bind(this)}>{translate('nuevo-comentario', 'Nou comentari')}</button>
					}
					return <div className="addPost__controls">
						<button className="addPost__close" onClick={this.close.bind(this)}>X</button>
						<input className="addPost__title" type="text" id={`title-${uid}`} placeholder={`${translate('titulo','Títol')}*`} required/>
						<textarea className="addPost__body tinymce" placeholder={`${translate('comentario','Comentari')}*`} id={`body-${uid}`} required></textarea>
						<input className="addPost__name" type="text" id={`author-${uid}`} placeholder={`${translate('nombre-seud','Nom o pseudonim')}*`}/>
						<button className="addPost__send" onClick={this.send.bind(this, uid)}>{translate('enviar', 'Enviar')}</button>
					</div>
				}()
			}
		</div>
	}

}

AddPost.propTypes = {
	parent: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number,
	]).isRequired,
	schoolSlug: React.PropTypes.string.isRequired,
	category: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number,
	]).isRequired,
	writeMsg: React.PropTypes.func.isRequired,
};
