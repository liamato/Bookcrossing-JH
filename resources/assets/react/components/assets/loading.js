import React from 'react'
import translate from '../../translate'

export default class Loading extends React.Component {

	render() {
		return (<p>{translate('cargando', 'Carregant')}...</p>)
	}
}
