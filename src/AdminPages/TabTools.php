<?php
namespace tmc\mp\src\AdminPages;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 14:29
 */

use shellpress\v1_3_84\src\Shared\AdminPageFramework\AdminPageTab;

class TabTools extends AdminPageTab {

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
				'title'         =>  __( 'Tools', 'tmc_mp' )
			)
		);

	}

	/**
	 * Called while current component is loaded.
	 */
	public function load() {
		// TODO: Implement load() method.
	}
}