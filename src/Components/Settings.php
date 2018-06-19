<?php
namespace tmc\mp\src\Components;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 15:05
 */

use shellpress\v1_2_4\src\Shared\Components\IComponent;

class Settings extends IComponent {

	/**
	 * Called on creation of component.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		$this::s()->options->setDefaultOptions(
			array(
				'shortcodes'    =>  array(
					'openBtnIcon'   =>  $this::s()->getUrl( 'assets/img/menu.png' ),
					'openBtnText'   =>  __( 'Menu', 'tmc_mp' )
				)
			)
		);

		$this::s()->event->addOnActivate( array( $this, '_a_fillOptionsDifferences' ) );

	}

	/**
	 * @return string|null
	 */
	public function getOpenBtnIconUrl() {

		return $this::s()->options->get( 'shortcodes/openBtnIcon' );

	}

	/**
	 * @return string|null
	 */
	public function getOpenBtnText() {

		return $this::s()->options->get( 'shortcodes/openBtnText' );

	}

	//  ================================================================================
	//  Activation
	//  ================================================================================

	/**
	 * Called on plugin activation.
	 */
	public function _a_fillOptionsDifferences() {

		$this::s()->options->fillDifferencies();
		$this::s()->options->flush();

	}

}