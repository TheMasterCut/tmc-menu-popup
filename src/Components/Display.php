<?php
namespace tmc\mp\src\Components;

/**
 * @author jakubkuranda@gmail.com
 * Date: 04.06.2018
 * Time: 13:21
 */

use shellpress\v1_3_84\src\Shared\Components\IComponent;
use tmc\mp\src\App;

class Display extends IComponent {

    const SUBMIT_AJAX_CALLBACK = 'tmc_sp_submit_callback';

	/**
	 * Called on creation of component.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		add_action( 'wp_footer',                                        array( $this, '_a_displayPopupRoot' ) );
		add_action( 'wp_enqueue_scripts',                               array( $this, '_a_enqueueScripts' ) );
		add_action( 'widgets_init',                                     array( $this, '_a_registerSidebars' ));

	}

	/**
	 * Checks if current page should display popup HTML.
	 *
	 * @return bool
	 */
	protected function shouldDisplayPopup() {

		return ! is_admin();

	}

	//  ================================================================================
	//  ACTIONS
	//  ================================================================================

	/**
	 * Called on wp_footer.
	 *
	 * @internal
	 *
	 * @return void
	 */
	public function _a_displayPopupRoot() {

		if( ! $this->shouldDisplayPopup() ) return;

		?>

        <div id="tmc_mp_root">

            <div data-tmc_mp_close class="tmc_mp_exit_area">

            </div>
            <div class="tmc_mp_sidebar">

                <div class="tmc_mp_mobile_close_area">
                    <span class="tmc_mp_close_button" data-tmc_mp_close></span>
                </div>
                <div class="tmc_mp_inner">

					<?php
                    ob_start();
					if( is_active_sidebar( 'tmc-menu-popup-widgets' ) ){

						echo '<ul class="widgets">';
						dynamic_sidebar( 'tmc-menu-popup-widgets' );
						echo '</ul>';

					} else {

					    if( current_user_can( 'manage_options' ) ){
					        echo '<div class="tmc_mp_error_message">';
					        printf( '<div>%1$s</div>', __( 'You need to enable Menu Popup TMC sidebar in WordPress options.', 'tmc_mp' ) );
					        printf( '<div>%1$s</div>', __( 'Just drag and drop your widgets into sidebar area.', 'tmc_mp' ) );
					        printf( '<div><a href="%1$s" target="_blank">%2$s</a></div>', admin_url( 'widgets.php' ), __( 'Option page for it is right here.', 'tmc_mp' ) );
							echo '<br/><br/>';
					        printf( '<div>%1$s</div>', __( 'You can also filter this content with:.', 'tmc_mp' ) );
					        printf( '<div><code>%1$s</code></div>', 'add_filter( \'tmc/menupopup/display/innerhtml/\', <callable> )' );
					        echo '</div>';
                        }

                    }

					$html = ob_get_clean();
					$html = apply_filters( 'tmc/menupopup/display/innerhtml', $html );

					//  Display.
                    echo $html;
					?>

                </div>

            </div>

        </div>

		<?php

	}

	/**
	 * Called on wp_enqueue_scripts.
     *
     * @internal
     *
     * @return void
	 */
	public function _a_enqueueScripts() {

	    if( ! $this->shouldDisplayPopup() ) return;

	    wp_enqueue_style( 'tmc_mp_style', $this::s()->getUrl( 'assets/css/style.css' ), array(), $this::s()->getFullPluginVersion() );

	    wp_enqueue_script( 'tmc_mp_script', $this::s()->getUrl( 'assets/js/front.js' ), array( 'jquery' ), $this::s()->getFullPluginVersion(), true );

    }

	/**
     * Registers main widgets area.
     * Called on widgets_init.
     *
	 * @return void
	 */
    public function _a_registerSidebars() {

	    register_sidebar(
            array(
                'name'              =>  __( 'Menu Popup TMC', 'tmc_mp' ),
                'id'                =>  'tmc-menu-popup-widgets',
                'description'       =>  __( 'Main widget area inside popup.', 'tmc_mp' ),
                'before_widget'     =>  '<aside id="%1$s" class="widget %2$s">',
                'after_widget'      =>  '</aside>',
                'before_title'      =>  '<h3 class="widget-title">',
                'after_title'       =>  '</h3>',
	        )
        );

    }

}