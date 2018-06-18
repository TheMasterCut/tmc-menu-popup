<?php
namespace tmc\mp\src\Components;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 14:45
 */

use shellpress\v1_2_4\src\Shared\Components\LicenseManagerSLM;

class License extends LicenseManagerSLM  {

	/**
	 * Called on creation of component.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		$this->registerAutomaticChecker();

		if( is_admin() ){

			$this->registerAPFForm( 'tmc_mp_acf', 'tmc_mp_settings', 'tools' );
			$this->registerNotices();

		}

	}

	/**
	 * Called when key has been activated.
	 *
	 * @return void
	 */
	protected function onKeyActivationCallback() {
		// TODO: Implement onKeyActivationCallback() method.
	}

	/**
	 * Called when key has been deactivated.
	 *
	 * @return void
	 */
	protected function onKeyDeactivationCallback() {
		// TODO: Implement onKeyDeactivationCallback() method.
	}

}