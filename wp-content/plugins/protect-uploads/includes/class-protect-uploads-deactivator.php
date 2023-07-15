<?php 
class Alti_ProtectUploads_Deactivator extends Alti_ProtectUploads {

	public function run() {
		$plugin = new Alti_ProtectUploads_Admin($this->plugin_name, $this->version);
		$plugin->remove_index();
		$plugin->remove_htaccess();
		delete_option( $this->get_plugin_name().'-protection' );

	}

}