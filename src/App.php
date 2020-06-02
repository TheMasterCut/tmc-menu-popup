<?php
namespace tmc\mp\src;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 13:53
 */

use shellpress\v1_3_84\ShellPress;
use tmc\mp\src\Components\Settings;
use tmc\mp\src\Components\ShortCodes;
use tmc\mp\src\Components\Display;
use tmc_mp_acf;

class App extends ShellPress {


	/** @var Settings */
	public $settings;

	/** @var Display */
	public $display;

	/**
	 * Called automatically after core is ready.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		//  ----------------------------------------
		//  Definition
		//  ----------------------------------------

		$this::s()->autoloading->addNamespace( 'tmc\mp', dirname( $this::s()->getMainPluginFile() ) );

		//  ----------------------------------------
		//  Components
		//  ----------------------------------------

		$this->settings = new Settings( $this );
		$this->display = new Display( $this );

		new ShortCodes( $this );

	}
}