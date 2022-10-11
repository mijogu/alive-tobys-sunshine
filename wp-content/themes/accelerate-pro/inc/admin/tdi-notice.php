<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Accelerate_TDI_Admin_Notice {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'admin_notices' ) );
		add_action( 'switch_theme', array( $this, 'remove_tdi_notice' ) );
	}

	public function admin_notices() {
		$plugin = 'themegrill-demo-importer/themegrill-demo-importer.php';

		if ( accelerate_plugin_version_compare( $plugin, '1.6.3' ) ) {
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
			}

			add_action( 'admin_notices', array( $this, 'tdi_notice' ), 0 );
		}

		add_action( 'admin_init', array( $this, 'ignore_tdi_notice' ), 0 );
	}

	public function tdi_notice() {
		$user_id        = get_current_user_id();
		$ignored_notice = get_user_meta( $user_id, 'ignore_accelerate_tdi_notice', true );

		if ( $ignored_notice ) {
			return;
		}
		?>
		<div class="error updated tdi-notice" style="position:relative;">
			<?php
			$plugin = 'themegrill-demo-importer/themegrill-demo-importer.php';

			$action_url = wp_nonce_url( 'update.php?action=upgrade-plugin&amp;plugin=' . $plugin, 'upgrade-plugin_' . $plugin );

			$msg = sprintf(
			/* Translators: 1: Plugin name */
				'<p>' . esc_html__( 'Action Required: Please update "%1$s" plugin to latest version to make sure your site is all secure. We released a security patch in the latest version of this plugin.', 'accelerate' ) . '</p>',
				'<strong>' . esc_html__( 'ThemeGrill Demo Importer', 'accelerate' ) . '</strong>'
			);

			$msg .= sprintf(
				'<p style="display: inline-block"><a href="%1$s" class="button-primary">%2$s</a></p>',
				esc_url( $action_url ),
				esc_html__( 'Update Now', 'accelerate' )
			);

			$msg .= sprintf(
			/* Translators: 1: Plugin name */
				'<p style="display: inline-block; margin-left: 5px;">' . esc_html__( 'Also, if the purpose of importing the demo via "%1$s" plugin is fulfilled, you can simply delete this plugin now.', 'accelerate' ) . '</p>',
				'<strong>' . esc_html__( 'ThemeGrill Demo Importer', 'accelerate' ) . '</strong>'
			);

			echo $msg;
			?>
			<a class="notice-dismiss" style="text-decoration:none;" href="?nag_ignore_accelerate_tdi_notice=0"></a>
		</div>
		<?php
	}

	public function ignore_tdi_notice() {
		$user_id = get_current_user_id();

		if ( isset( $_GET['nag_ignore_accelerate_tdi_notice'] ) && '0' == $_GET['nag_ignore_accelerate_tdi_notice'] ) {
			add_user_meta( $user_id, 'ignore_accelerate_tdi_notice', 'true', true );
		}

	}

	public function remove_tdi_notice() {
		$get_all_users = get_users();

		foreach ( $get_all_users as $user ) {
			$ignored_notice = get_user_meta( $user->ID, 'ignore_accelerate_tdi_notice', true );

			// Delete permanent notice remove data.
			if ( $ignored_notice ) {
				delete_user_meta( $user->ID, 'ignore_accelerate_tdi_notice' );
			}
		}
	}

}

new Accelerate_TDI_Admin_Notice();
