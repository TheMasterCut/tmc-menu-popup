<?php
namespace tmc\mp\src\Components;
use shellpress\v1_2_4\src\Shared\Components\IComponent;
use tmc\mp\src\App;
use WP_Term;

/**
 * @author jakubkuranda@gmail.com
 * Date: 11.06.2018
 * Time: 14:35
 */

class ShortCodes extends IComponent {

	const SHORTCODE_TAG = 'tmc_mp_open';

	/**
	 * Called on creation of component.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		//  ----------------------------------------
		//  Actions
		//  ----------------------------------------

		add_action( 'init',                                             array( $this, '_a_initShortcodes' ) );

		//  ----------------------------------------
		//  Filters
		//  ----------------------------------------

		add_filter( 'wp_nav_menu_objects',                              array( $this, '_f_applyShortcodesOnNavMenu' ) );

	}

	/**
	 * Renders shortcode output HTML.
	 *
	 * @return string
	 */
	public function getOpenPopupShortcode( $attrs ) {

		$iconUrl    = App::i()->settings->getOpenBtnIconUrl();
		$btnText    = App::i()->settings->getOpenBtnText();

		if( $iconUrl ){

			return sprintf( '<span data-tmc_mp_open style="cursor: pointer; display: inline-block;"><img src="%1$s" alt="%2$s"></span>', $iconUrl, $btnText );

		} else {

			return sprintf( '<span data-tmc_mp_open style="cursor: pointer;">%1$s</span>', $btnText );

		}

	}

	//  ================================================================================
	//  ACTIONS
	//  ================================================================================

	/**
	 * Registers shortcodes.
	 * Called on init.
	 *
	 * @return void
	 */
	public function _a_initShortcodes() {

		add_shortcode( $this::SHORTCODE_TAG, array( $this, 'getOpenPopupShortcode' ) );

	}

	//  ================================================================================
	//  FILTERS
	//  ================================================================================

	/**
	 * @param string[] $items
	 *
	 * @return string[]
	 */
	public function _f_applyShortcodesOnNavMenu( $items ) {

		foreach( $items as $key => $item ){ /** @var WP_Term $item */
			if( strpos( $item->title, ShortCodes::SHORTCODE_TAG ) ){
				$item->title = do_shortcode( $item->title );
				$item->url = '';
			}
		}

		return $items;

	}

}