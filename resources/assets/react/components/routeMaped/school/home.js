import React from 'react';
import translate from '../../../translate'

export default class SchoolHome extends React.Component {
	render() {
		return <div className="school-home" dangerouslySetInnerHTML={{__html: translate('home',`<h1>Què és BookCrossing<span>?</span></h1>
    <p>És la pràctica de deixar un llibre en un lloc públic perquè qualsevol persona el trobi, el llegeixi i el torni a deixar.</p>
    <p>L'Institut Jaume Huguet ha começat aquest projecte gràcies a la idea de la pàgina web de BookCrossing.</p>

    <h2>Com funciona<span>?</span></h2>

    <ol>
      <li>Tot el procés és anònim.</li>
      <li>Registra el llibre a la web. En registrar un llibre se't donarà un número que hauràs d'anotar a l'adhesiu que et facilitarà el centre i col·locar-lo a l'interior del llibre.</li>
      <li>Allibera el llibre al lloc que tu prefereixis.</li>
      <li>Captura un nou llibre que trobis. La persona que capturi el llibre hauria de notificar a la web que està capturat introduint el codi a la pestanya "Capturar llibre".</li>
      <li>Un cop llegit, tornes a alliberar-lo on tu vulguis i ho notifiques novament a la pestanya "Alliberar llibre" introduint el codi.</li>
    </ol>

    <h2>Recomanacions</h2>

    <ul>
        <li>Sigues generós/a: Alliberar un llibre significa desprendre d'ell amb l'esperança que algú ho aprofiti.</li>
        <li>Tingues il·lusió: De la mateixa manera tu tindràs accés a altres llibres que de no ser així mai hauries conegut.</li>
        <li>No siguis codiciós: No captures llibres que no vagis a llegir immediatament.</li>
        <li>Comparteix: Que els llibres circulin de forma lliure i gratuïta, compartir amb els altres sense ànim de possessió, no té preu.</li>
        <li>Col·labora: Sempre que capturis un llibre faràs una entrada al seguiment de la web perquè els altres sàpiguen que aquest llibre està sent llegit.</li>
        <li>Comunicació de la mateixa manera l'alliberament del llibre quan l'hagis acabat.</li>
    </ul>

    <h2>Pensa en els altres</h2>

    <ul>
        <li>El temps recomanable de possessió seria d'un mes.</li>
        <li>Cuida el llibre perquè molts més usuaris puguin beneficiar d'ell:
            <ul>
                <li>Introdueix el llibre en una bossa de plàstic transparent i amb tancament si vas a alliberar a la intempèrie.</li>
                <li>Si arriba a les teves mans en mal estat pots folrar.</li>
            </ul>
        </li>
    </ul>


    <h2>Que pretenem<span>?</span></h2>

    <ul>
        <li>Fomentar l'hàbit lector facilitant la lliure circulació de llibres en el nostre institut.</li>
        <li>Impulsar la curiositat afegint comentaris personals i anònims que incitin a llegir el llibre que alliberem.</li>
        <li>Reutilitzar llibres desaprofitats en la lleixa de l'oblit.</li>
        <li>Dinamitzar a través del web del centre l'intercanvi d'opinions , experiències i recomanacions entre els lectors.</li>
    </ul>`)}}></div>
	}
}
