import React from 'react'
import Video from './video'
import Collection from '../../data/collection'

export default class VideoShelf extends React.Component {

	render() {
		return (
			<div className="videoshelf">
				<section className="videoshelf__videos">
				{
					this.props.videos.map((video) => {
						return <article key={video.id} className="videoshelf__video"><Video {...video}/></article>
					})
				}
				</section>
			</div>
		)
	}
}

VideoShelf.propTypes = {
	videos: React.PropTypes.instanceOf(Collection).isRequired
};
