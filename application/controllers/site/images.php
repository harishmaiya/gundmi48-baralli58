<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Images extends MY_Controller { 
	function __construct(){
        parent::__construct();
	}
	
	public function index(){
		error_reporting(-1);
		$uploaddirOriginal = "server/php/rental/";	//a directory inside
		$uploaddirMobile = "server/php/rental/mobile/";	//a directory inside
		if (!file_exists($uploaddirMobile)) {
			mkdir($uploaddirMobile, 0777, true);
		}
		$uploaddirResize = "server/php/rental/resize/";	//a directory inside
		if (!file_exists($uploaddirResize)) {
			mkdir($uploaddirResize, 0777, true);
		}
		$uploaddirThumbnail = "server/php/rental/thumbnail/";	//a directory inside
		if (!file_exists($uploaddirThumbnail)) {
			mkdir($uploaddirThumbnail, 0777, true);
		}
		$files = scandir($uploaddirOriginal);
		foreach($files as $file){
			$source = $uploaddirOriginal.$file;
			if(is_file($source) && $file != 'Thumbs.db'){
				@copy($uploaddirOriginal.$file, $uploaddirMobile.$file);
				$this->ImageResizeWithCrop(500, 375, $file, $uploaddirMobile);
				@copy($uploaddirOriginal.$file, $uploaddirResize.$file);
				$this->ImageResizeWithCrop(1280, 960, $file, $uploaddirResize);
				@copy($uploaddirOriginal.$file, $uploaddirThumbnail.$file);
				$this->ImageResizeWithCrop(370, 245, $file, $uploaddirThumbnail);
				echo $source;echo '<br>';
			}
		}
	}
}
/* End of file images.php */

/* Location: ./application/controllers/site/images.php */