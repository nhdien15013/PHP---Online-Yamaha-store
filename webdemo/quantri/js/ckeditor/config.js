/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.filebrowserBrowseUrl = '/webdemo/quantri/js/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/webdemo/quantri/js/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/webdemo/quantri/js/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/webdemo/quantri/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/webdemo/quantri/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/webdemo/quantri/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
