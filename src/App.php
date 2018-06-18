<?php
namespace tmc\mp\src;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 13:53
 */

use shellpress\v1_2_4\ShellPress;
use tmc\mp\src\Components\License;
use tmc\mp\src\Components\Settings;
use tmc\mp\src\Components\ShortCodes;
use tmc_mp_acf;

class App extends ShellPress {

	/** @var License */
	public $license;

	/** @var Settings */
	public $settings;

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

		$this->license = new License( $this );
		$this->settings = new Settings( $this );

		new ShortCodes( $this );

		//  ----------------------------------------
		//  AdminPageFramework
		//  ----------------------------------------

		if( is_admin() && ! wp_doing_ajax() && ! wp_doing_cron() ){

			$this::s()->requireFile( 'lib/tmc-admin-page-framework/admin-page-framework.php', 'TMC_v1_0_3_AdminPageFramework' );
			$this::s()->requireFile( 'src/AdminPages/tmc_mp_acf.php' );

			new tmc_mp_acf( $this::s()->options->getOptionsKey(), $this::s()->getMainPluginFile() );

		}

	}
}