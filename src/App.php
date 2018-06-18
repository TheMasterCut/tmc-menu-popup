<?php
namespace tmc\mp\src;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 13:53
 */

use shellpress\v1_2_4\ShellPress;

class App extends ShellPress {

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

	}
}