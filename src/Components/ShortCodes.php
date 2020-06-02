<?php
namespace tmc\mp\src\Components;
use shellpress\v1_3_84\src\Shared\Components\IComponent;
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

		$defAttrs = array(
			'open_icon'		=>	App::i()->settings->getOpenBtnIconUrl() ?: '',
			'open_text'		=>	App::i()->settings->getOpenBtnText() ?: ''
		);

		$attrs = shortcode_atts( $defAttrs, $attrs, $this::SHORTCODE_TAG );

		if( $attrs['open_icon'] ){

			return sprintf( '<span data-tmc_mp_open class="tmc_mp_open_button"><img src="%1$s" alt="%2$s"></span>', $attrs['open_icon'], $attrs['open_text'] );

		} else {

			return sprintf( '<span data-tmc_mp_open class="tmc_mp_open_button">%1$s</span>', $attrs['open_icon'] );

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