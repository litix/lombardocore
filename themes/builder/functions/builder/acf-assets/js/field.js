/**
 * Included when FIELD_NAME fields are rendered for editing by publishers.
 */
( function( $ ) {



	function initialize_field( $field ) {
		/**
		 * $field is a jQuery object wrapping field elements in the editor.
		 */
		//console.log($field);
		$type = $field.data('type');
	
		//POP BUTTON
		if($type == 'acfe_pop_button')
		{
			$($field).each(function(){

				const pop_field = $(this).find('.pop-field');

				$(pop_field).each(function(){
					
					const modal  = $(this).children('.acfe-modal');
					const button = $(this).children('a.pop-modal');		
					//link wrapper (results)
					const link_wrap = $(this).children('.link-wrap');

					//button click modal
					button.click(function() { 
						//modal open
						modal.toggleClass('-open');
						//darken popup behind
						$('.acfe-modal.-fields').toggleClass('acfe-modal-sub');
					});					


					//modal close (save)
					function modal_close() {
						//title
						title = modal.find('.input-title').val();

						//type and text
						let ct = check_type();
						const url_text = ct[0],
							radio_val = ct[1];

						if(url_text ==='' && title === '') {
							//url text and title is ok
							button.css('display', 'inline-block');

							//link wrap none
							link_wrap.hide();		

						} else {
							check_target(); //target="_blank"
							
							button.hide(); //hide the button
							
							//link wrap display
							if(radio_val == 'url') {
								link_wrap.find('.link-url').attr('href', url_text);
							}
							link_wrap.find('.link-url').text(url_text);
							link_wrap.find('.link-title').text(title);
							link_wrap.css('display', 'inline-block');
						}						

					}		
					
					function modal_open() {
									
					}

					//pencil (edit) - open popup
					$(this).find('.-pencil').click(function() { 
						modal.toggleClass('-open');
						$('.acfe-modal.-fields').toggleClass('acfe-modal-sub');
					});

					// X (remove) - reset
					$(this).find('.-cancel').click(function() { 
						form_reset();
					});	

					function form_reset(){ 
						// radio (return to url)
						modal.find('.acf-radio-list li:first-child input').click();

						//title and text (url to blank, title to blank)
						modal.find('.input-url').val('');
						modal.find('.input-title').val('');

						//uncheck boxes
						modal.find('input[type="checkbox"]').prop( "checked", false );

						//show the button
						button.css('display', 'inline-block');

						//hide link wrap
						link_wrap.hide();
					}


					function check_target(){
						// target checkbox
						target = modal.find('input[type="checkbox"]:checked');

						if(target.length) {
							link_wrap.find('.acf-icon.-link-ext').css('display', 'inline-block');
						} else {
							link_wrap.find('.acf-icon.-link-ext').css('display', 'none');
						}					
					}	

					function check_type() {
						// url | post | term
						var radio = $(modal).find('.selected input[type="radio"]');
						var radio_val = radio.val();

						if(radio_val == 'url') {
							$(modal).find('.selected input[value="url"]').attr('checked','checked');
							url_text = modal.find('.input-url').val();	
						}

						if(radio_val == 'post') { 
							$(modal).find('.selected input[value="post"]').attr('checked','checked');
							url_text = modal.find('[role="textbox"]').attr('title');	
						}

						if(radio_val == 'term') { 
							$(modal).find('.selected input[value="term"]').attr('checked','checked');
							url_text = modal.find('[role="textbox"]').attr('title');	
						}			
						
						return [url_text, radio_val];
					}
			

					var elemToObserve = modal;
					var elemToObserve = elemToObserve[0];
					var prevClassState = elemToObserve.classList.contains('-open');
					var observer = new MutationObserver(function(mutations) {
						mutations.forEach(function(mutation) {
							if(mutation.attributeName == "class"){
								var currentClassState = mutation.target.classList.contains('-open');
								if(prevClassState !== currentClassState)    {
									prevClassState = currentClassState;

									if(currentClassState)
										modal_open();
									else
										modal_close();
										
								}
							}
						});
					});
					observer.observe(elemToObserve, {attributes: true});		
					
					
				});
			});
		}

		//POP MEDIA
		if($type == 'pop_media')
		{
			$($field).each(function(){

				var preview = $(this).find('.field-preview'); 
				var pop_note = $(this).find('.pop-note');
				var modal = $(this).find('.acfe-modal');

				$(this).find('.pop-field a.button').click(function() { 
					modal.toggleClass('-open');
					$('.acfe-modal.-fields').toggleClass('acfe-modal-sub');
					preview.removeClass('-hide-ny');

					$('.close').click(function() { 
						pop_note.click();
					});	
	
					$('.acfe-modal-opened .acfe-modal-overlay').click(function() { 
						pop_note.click();
					});	
				});

				var fields = $(this).find('.acf-fields'); 


				var mm = $(this).find('.acf-fields .mm');
				var th = $(this).find('.acf-fields .th');

				var select = $(this).find('select');
				var option = select.find(":selected").val();

				$.fn.select = function() {
					mm.hide();
					th.hide();

					if(option != 'm-image') {
						th.show();
					}	

					fields.find("[class*='" + option + "']").show();
				}

				//init
				$.fn.select();				

				$(select).on('change', function() {
					var option = $(this).find(":selected").val();					

					mm.hide();
					th.hide();

					if(option != 'm-image') {
						th.show();
					}	

					fields.find("[class*='" + option + "']").show();	

				});

				function YouTubeGetID(url){
					url = url.split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
					return (url[2] !== undefined) ? url[2].split(/[^0-9a-z_\-]/i)[0] : url[0];
				}

				function VimeoGetID(url){
					const match = /vimeo.*\/(\d+)/i.exec(url);
					if (match) {
						return match[1];
					}
				}

				//previewer
				pop_note.click(function() { 
					
					var opt = select.val();	

					if(opt == 'm-image') {
						preview.find('.prev-img').remove();
						mimg = fields.find('.m-image').find('img');
						mimg_src = mimg.attr('src');
						if(mimg_src) {
							preview.prepend('<img class="prev-img" src="' + mimg_src + '">');
						}
					}

					if(opt == 'm-video') {
						preview.find('.prev-img').remove();
						vid = fields.find('.m-video').find('a[data-name="filename"]').attr('href');
						preview.prepend('<video class="prev-img" src="' + vid + '"><source type="video/mp4" src="' + vid + '"></video>');
					}

					if(opt == 'm-youtube') {
						preview.find('.prev-img').remove();
						var yt = fields.find('.m-youtube').find('.input-url').val();

						if(yt) {
							var yt_id = YouTubeGetID(yt)	
							var yt_thumb = 'http://img.youtube.com/vi/' + yt_id + '/maxresdefault.jpg';
							preview.prepend('<img class="prev-img" src="' + yt_thumb + '">');
						}
					}

					if(opt == 'm-vimeo') {
						preview.find('.prev-img').remove();
						var vm = fields.find('.m-vimeo').find('.input-url').val();

						if(vm) {
							var vm_id = VimeoGetID(vm)	
							var vm_thumb = 'https://vumbnail.com/' + vm_id + '_large.jpg';
							preview.prepend('<img class="prev-img" src="' + vm_thumb + '">');
							
						}
					}

					if(opt != 'm-image') { 
						mimg = fields.find('.box-thumb').find('img');
						mimg_src = mimg.attr('src');
						if(mimg_src) {
							preview.find('.prev-img').remove();
							preview.prepend('<img class="prev-img" src="' + mimg_src + '">');
						}
					}
				});
				
				//previewer on image upload
				var IMG = modal.find('.acf-image-uploader .image-wrap img');
				var VID = modal.find('a[data-name="filename"]');
				

				observer = new MutationObserver((changes) => {
				  changes.forEach(change => {
					  
					  if(change.attributeName.includes('src')){
						//console.dir(IMG[0].src);
						preview.find('.prev-img').remove();
						preview.prepend('<img class="prev-img" src="' + IMG[0].src + '">');
					  }
					  
					  if(change.attributeName.includes('href')){
						//console.dir(img[0].src);
						preview.find('.prev-img').remove();
						preview.prepend('<video class="prev-img" src="' + VID[0].href + '"><source type="video/mp4" src="' + VID[0].href + '"></video>');
					  }					  
				  });
				});

				observer.observe(IMG[0], {attributes : true});	
				observer.observe(VID[0], {attributes : true});			
			});

		}

	
	}

	if( typeof acf.add_action !== 'undefined' ) {
		/**
		 * Run initialize_field when existing fields of this type load,
		 * or when new fields are appended via repeaters or similar.
		 */
		acf.add_action( 'ready_field/type=pop_media', initialize_field );
		acf.add_action( 'append_field/type=pop_media', initialize_field );

		acf.add_action( 'ready_field/type=acfe_pop_button', initialize_field );
		acf.add_action( 'append_field/type=acfe_pop_button', initialize_field );
	}



} )( jQuery );
