import React from 'react'
import Video from './video'
import Collection from '../../data/collection'

export default class VideoShelf extends React.Component {

	render() {
		return (
			<div className="videoshelf">
				<ul className="videoshelf__videos">
				{
					this.props.videos.map((video) => {
						return <li key={video.id} className="videoshelf__video"><Video {...video}/></li>
					})
				}
				</ul>
			</div>
		)
	}
}

VideoShelf.propTypes = {
	videos: React.PropTypes.instanceOf(Collection).isRequired
};
