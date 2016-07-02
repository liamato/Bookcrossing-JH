import React from 'react'
import request from 'superagent'
import config from '../../../config'
import translate from '../../../translate'
import VideoShelf from '../../assets/videoshelf'
import Loading from '../../assets/loading'
import uid from 'uid'


export default class Tube extends React.Component {

	componentWillMount() {
		this.setState({nv: false, request: 0});
		this.trailer();
	}

	componentDidMount() {
		this.mounted = true;
		this.props.history.listen(()=> {if(this.mounted){this.setState({});}}.bind(this));
	}

	componentDidUpdate(props, state) {
		if (this.props.route.path !== props.route.path) {
			this.trailer()
		}
	}

	componentWillUnmount() {
		this.mounted = false;
	}

	trailer() {
		if (this.props.route.trailer) {
			this.setState({type: 'trailer', trailer: 1});
		} else {
			this.setState({type: 'tube', trailer: 0});
		}
	}

	nv() {
		this.setState({nv: true});
	}

	nvc() {
		this.setState({nv: false});
	}

	addVideo(ev, id) {
		this.setState({request: 1});
		if (document.getElementById(`code-${id}`).value.match(/\w*:\/\/[\w\.]*\/watch\?v\=([A-Za-z0-9\_\-]{11}).*|\w*:\/\/[\w\.]*\/([A-Za-z0-9\_\-]{11}).*|<iframe.*src\=.*\/\/[\w\.]*\/embed\/([A-Za-z0-9\_\-]{11}).*|([A-Za-z0-9\_\-]{11})/)) {
			let match = document.getElementById(`code-${id}`).value.match(/\w*:\/\/[\w\.]*\/watch\?v\=([A-Za-z0-9\_\-]{11}).*|\w*:\/\/[\w\.]*\/([A-Za-z0-9\_\-]{11}).*|<iframe.*src\=.*\/\/[\w\.]*\/embed\/([A-Za-z0-9\_\-]{11}).*|([A-Za-z0-9\_\-]{11})/);
			match.shift();
			for (let x=0; x<match.length; x++) {
				if (match[x]) {
					match = match[x];
					break;
				}
			}
			request
			.post(`${config.api.baseUrl}/school/${this.props.params.school}/video`)
			.send({code: match, author: document.getElementById(`name-${id}`).value, trailer: this.state.trailer})
			.type('json')
			.accept('json')
			.set('X-Requested-With', 'XMLHttpRequest')
			.end((err, req) => {
				this.setState({request: 2, res: [err, res]});
			});
		} else {
			this.setState({request: 2, res: [{status: 406, text: "Code field hasn't correct format"},{error: 4, status: 406, text: "Code field hasn't correct format", notAcceptable: 406}]});
		}
	}

	render() {
		return (
			<div>
				<h1>{`Book${this.state.type}`}</h1>
				<hr/>
				{
					() => {
						if (this.state.nv) {
							if (this.state.request === 0) {
								let id = uid();
								return (
									<div className="new-video">
										<button onClick={this.nvc.bind(this)}>{translate('cerrar','Tancar')}</button>
										<input type="text" id={`code-${id}`} placeholder="https://www.youtube.com/watch?v=xxxxxxxxxxx"/>
										<input type="text" id={`name-${id}`} placeholder="Nom"/>
										<button onClick={this.addVideo.bind(this, id)}>{translate('sube-video','Puja el teu video')}</button>
									</div>
								)
							} else if (this.state.request === 1) {
								return (
									<div className="new-video">
										{translate('subiendo-video', 'EL video s\'esta pujant')}
									</div>
								)
							} else if (this.state.request === 2) {
								return (
									<div className="new-video">
										{
											() => {
												if (this.state.res[1].ok) {
													return <div>{translate('subido-video', 'El video s\'ha pujat')}</div>
												}
												return <div>{translate('un-error', 'Hi ha hagut un error')}</div>
											}()
										}
										<button onClick={this.nvc.bind(this)}>{translate('cerrar','Tancar')}</button>
									</div>
								)
							}
						}
						return <button onClick={this.nv.bind(this)}>{translate('sube-video','Puja el teu video')}</button>
					}()
				}
				{
					() => {
						if (this.props.school && this.props.school.videos) {
							return <VideoShelf videos={this.props.school.videos.whereLoose('trailer',this.state.trailer)}/>
						}
						return <Loading/>
					}()
				}
			</div>
		)
	}
}
