<?php
namespace tmc\mp\src\AdminPages;

/**
 * @author jakubkuranda@gmail.com
 * Date: 18.06.2018
 * Time: 14:29
 */

use shellpress\v1_3_84\src\Shared\AdminPageFramework\AdminPageTab;
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
		//  Sections
		//  ----------------------------------------

		$this->pageFactory->addSettingSections(
//			array(
//				'section_id'        =>  'appearance',
//				'title'             =>  __( 'Appearance', 'tmc_sp' ),
//				'page_slug'         =>  $this->pageSlug,
//				'tab_slug'          =>  $this->tabSlug,
//			),
			array(
				'section_id'        =>  'shortcodes',
				'title'             =>  __( 'Shortcodes', 'tmc_sp' ),
				'page_slug'         =>  $this->pageSlug,
				'tab_slug'          =>  $this->tabSlug,
				'description'       =>  array(
					sprintf( '<p>%1$s <code>[tmc_mp_open]</code></p>',
						__( 'To display menu button, use shortcode: ', 'tmc_mp' )
					),
					sprintf( '<p>%1$s</p>',
						__( 'This shortcode will work even in built in WordPress navigation menus.', 'tmc_mp' )
					),
					sprintf( '<p>%1$s <code>%2$s</code></p>',
						__( 'You can trigger shortcodes in your own code like this: ', 'tmc_mp' ),
						htmlentities( '<?php echo do_shortcode( \'[tmc_mp_open]\' ); ?>' )
					)
				)
			),
			array(
				'section_id'        =>  'submit',
				'page_slug'         =>  $this->pageSlug,
				'tab_slug'          =>  $this->tabSlug,
				'save'              =>  false
			)
		);

		//  ----------------------------------------
		//  Fields
		//  ----------------------------------------

		$this->pageFactory->addSettingFields(
			'appearance',
			array(
				'field_id'          =>  'bgColor',
				'type'              =>  'color',
				'title'             =>  __( 'Background color', 'tmc_sp' )
			),
			array(
				'field_id'          =>  'textColor',
				'type'              =>  'color',
				'title'             =>  __( 'Text color',   'tmc_sp' )
			),
			array(
				'field_id'          =>  'colorAccentPrimary',
				'type'              =>  'color',
				'title'             =>  __( 'Primary accent',   'tmc_sp' )
			),
			array(
				'field_id'          =>  'colorAccentSecondary',
				'type'              =>  'color',
				'title'             =>  __( 'Secondary accent',   'tmc_sp' )
			)
		);

		$this->pageFactory->addSettingFields(
			'shortcodes',
			array(
				'field_id'          =>  'openBtnIcon',
				'type'              =>  'image',
				'title'             =>  __( 'Open button icon', 'tmc_sp' )
			),
			array(
				'field_id'          =>  'openBtnText',
				'type'              =>  'text',
				'title'             =>  __( 'Open button text', 'tmc_sp' ),
				'tip'               =>  __( 'If the icon is not set or could not be loaded, this text will be displayed instead of.', 'tmc_sp' )
			)
		);

		$this->pageFactory->addSettingFields(
			'submit',
			array(
				'field_id'          =>  'submit',
				'type'              =>  'submit',
				'save'              =>  false
			)
		);

	}

}