import React from 'react'
import request from 'superagent'
import config from '../../config'
import Uid from 'uid'

export default class AddPost extends React.Component {

	send(ev, id)
	{
		var path = `${config.api.baseUrl}/school/${this.props.school}/post`;
		var snd  = {
			title: document.getElementById(`title-${id}`).value,
			body: document.getElementById(`body-${id}`).value,
			author: document.getElementById(`author-${id}`).value,
			category_id: this.props.category,
			parent: this.props.parent
		};

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
		this.props.close();
	}

	render()
	{
		var uid = Uid();
		return <div className="addPost">
			<button onClick={this.close.bind(this)}>X</button>
			<input type="text" id={`title-${uid}`} placeholder="Titulo*" required/>
			<textarea placeholder="Comentario*" id={`body-${uid}`} required></textarea>
			<input type="text" id={`author-${uid}`} placeholder="Nombre o pseudonimo"/>
			<button onClick={this.send.bind(this, uid)}>Enviar</button>
		</div>
	}

}

AddPost.propTypes = {
	parent: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number,
	]).isRequired,
	school: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number,
	]).isRequired,
	category: React.PropTypes.oneOfType([
		React.PropTypes.string,
		React.PropTypes.number,
	]).isRequired,
	writeMsg: React.PropTypes.func.isRequired,
	close: React.PropTypes.func.isRequired,
};
