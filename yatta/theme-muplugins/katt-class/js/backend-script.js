jQuery(document).ready(function() {

	/** 
	* Media Upload field for meta box
	*
	* Inspered from: 
	* http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-3-extra-fields/
	* WP 3.5 Media Upload >
	* http://stackoverflow.com/questions/13847714/wordpress-3-5-custom-media-upload-for-your-theme-options 
	*/
	jQuery('.katt-backend-media-upload-choose-image-button').click(function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    wp.media.editor.send.attachment = function(props, attachment) {
	        jQuery('.katt-backend-media-upload-preview-image').attr('src', attachment.url);
	        //jQuery('.custom_media_url').val(attachment.url);
	        jQuery('.katt-backend-media-upload-image').val(attachment.id);
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open();
	    return false;       
	});
	jQuery('.katt-backend-media-upload-remove-image-button').click(function() {
		var defaultImage = jQuery(this).siblings('.katt-backend-media-upload-default-image').text();
		jQuery(this).siblings('.katt-backend-media-upload-image').val('');
		jQuery(this).siblings('.katt-backend-media-upload-preview-image').attr('src', defaultImage);
		return false;
	});





	/** 
	* Add/Remove and Sortable metabox
	*
	* Inspered from http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-3-extra-fields/
	*/
	numberOfGroup = jQuery('.katt-backend-repeatable').length;
	if ( numberOfGroup === 1 ) {
		jQuery('.katt-backend-repeatable-remove-container').css('display', 'none');
	}

	// 1- Add button and adds a new blank field row to the end of the list of fields.
	jQuery('.katt-backend-repeatable-add').click(function() {
		// Show the "Remove" button if there are more than one group
		numberOfGroup = jQuery('.katt-backend-repeatable').length;
		if ( numberOfGroup === 1 ) {
				jQuery('.katt-backend-repeatable-remove-container').css('display', 'block');
		}
		// Clone the group
		field = jQuery('.katt-backend-table li:last-child').clone(true);
		fieldLocation = jQuery('.katt-backend-table li:last-child');
		jQuery('input', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		jQuery('textarea', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		jQuery('select', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		
		field.insertAfter(fieldLocation, jQuery('.katt-backend-table li:last-child'));
		jQuery('.katt-backend-table li:last-child .katt-backend-media-upload-preview-image').attr('src' , katt_script_media_upload.default_image); // "skatt_script_media_upload.default_image" > ee wp_localize_script() function
		return false;
	});
	
	// 2- Gives each remove button the ability to remove that row when it is clicked.
	jQuery('.katt-backend-repeatable-remove').click(function() {
		numberOfGroup = jQuery('.katt-backend-repeatable').length;
		if ( numberOfGroup === 2 ) {
				jQuery('.katt-backend-repeatable-remove-container').css('display', 'none');
		}
		jQuery(this).closest('.katt-backend-repeatable').remove();
		return false;
	});

	// 3- Set the lists to be sortable and define a handle so that you can drag and drop the rows.
	jQuery('.katt-backend-groups').sortable({
		items: '> li',
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});

	/** 
	* Settings : add a class "katt-backend-link" to <table class"form-table"><th>
	*
	*/
	jQuery('.katt-backend-info').closest('tr').addClass('katt-backend-info-link');



	/** 
	* Hide/Show info notice
	*
	*/
	jQuery('.katt-backend-info-link').toggle(
	    function() {
	    	jQuery(this).find(jQuery('.katt-backend-info')).first().slideDown('500', 'swing');
		},
		function() {
			jQuery(this).find(jQuery('.katt-backend-info')).first().slideUp('500', 'swing');
		}
	);


	







});