<?php

use tmc\mp\src\AdminPages\TabBasics;
use tmc\mp\src\AdminPages\TabTools;
use tmc\mp\src\App;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 14:05
 */

class tmc_mp_acf extends TMC_v1_0_3_AdminPageFramework {

	public function setUp() {

		//  ----------------------------------------
		//  Definition
		//  ----------------------------------------

		$this->oProp->bShowDebugInfo = false;

		$this->setRootMenuPageBySlug( 'Settings' );
		$this->setInPageTabTag( 'h2' );

		$this->addSubMenuItem( array(
			'title'         =>  'Menu Popup TMC',
			'page_slug'     =>  'tmc_mp_settings'
		) );

	}

	public function load() {

		//  ----------------------------------------
		//  Styles and scripts
		//  ----------------------------------------

		$this->enqueueStyle( App::s()->getUrl( 'lib/ShellPress/assets/css/AdminPage/style.css' ), '', '', array( 'version' => App::s()->getFullPluginVersion() ) );

		//  ----------------------------------------
		//  Tabs
		//  ----------------------------------------

		new TabBasics( $this, 'tmc_mp_settings', 'basics' );
		new TabTools( $this, 'tmc_mp_settings', 'tools' );

	}

}