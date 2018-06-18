<?php
namespace tmc\mp\src\AdminPages;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 14:29
 */

use shellpress\v1_2_4\src\Shared\AdminPageFramework\AdminPageTab;
use tmc\mp\src\App;

class TabBasics extends AdminPageTab {

	/**
	 * Declaration of current element.
	 */
	public function setUp() {

		//  ----------------------------------------
		//  Definition
		//  ----------------------------------------

		$this->pageFactory->addInPageTab(
			array(
				'page_slug'     =>  $this->pageSlug,
				'tab_slug'      =>  $this->tabSlug,
				'title'         =>  __( 'Basics', 'tmc_mp' )
			)
		);

	}

	/**
	 * Called while current component is loaded.
	 */
	public function load() {

		//  ----------------------------------------
		//  Actions
		//  ----------------------------------------

		add_action( 'admin_notices',        array( $this, '_a_displayLicenseNotification' ) );

	}

	//  ================================================================================
	//  ACTIONS
	//  ================================================================================

	/**
	 * Called on admin_notices.
	 *
	 * @return void
	 */
	public function _a_displayLicenseNotification() {

		if( App::i()->license->getKey() ) return;

		$linkHtml = sprintf( '<a href="%1$s">%2$s</a>',
			add_query_arg( 'tab', 'tools' ),
			__( 'Menu needs active license to work properly.', 'tmc_sp' )
		);

		printf( '<div class="notice notice-error tmc-notice is-dismissible"><p>%1$s</p></div>', $linkHtml );

	}
}