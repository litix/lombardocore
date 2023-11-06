<?php
## ACF FIELD : Billy's Pop Media
## see ACF Fields > Content > Pop Media

## LINK functions/shortcode/code-pop-media.php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class billy_acf_field_pop_media extends \acf_field {
	/**
	 * Controls field type visibilty in REST requests.
	 * @var bool
	 */
	public $show_in_rest = true;

	/**
	 * Environment values relating to the theme or plugin.
	 * @var array $env Plugin or theme context such as 'url' and 'version'.
	 */

	private $env;

	/*------------------------------------------------*/

	public function __construct() {

		$this->name = 'pop_media';
		$this->label = __( 'Pop Media', 'TEXTDOMAIN' );
		$this->category = 'content'; 

		$this->env = array(
			'url'     => site_url( str_replace( ABSPATH, '', __DIR__ ) ), // URL to the acf-FIELD-NAME directory.
			'version' => '1.0', // Replace this with your theme or plugin version constant.
		);

		parent::__construct();
	}

	/*------------------------------------------------*/

	/**
	 * Settings to display when users configure a field of this type.
	 * These settings appear on the ACF “Edit Field Group” admin page when
	 * setting up the field.
	 *
	 * @param array $field
	 * @return void
	 */

	public function render_field_settings( $field ) {
		/*
		acf_render_field_setting(
			$field,
			array(
				'label'			=> __( 'Font Size','TEXTDOMAIN' ),
				'instructions'	=> __( 'Customise the input font size','TEXTDOMAIN' ),
				'type'			=> 'number',
				'name'			=> 'font_size',
				'append'		=> 'px',
			),
		);
		*/


	}

	/*------------------------------------------------*/

	/**
	 * HTML content to show when a publisher edits the field on the edit screen.
	 * @param array $field The field settings and values.
	 * @return void
     */

	public function render_field( $field ) {

		$value = $field['value'];
		$sub_fields = $this->get_sub_fields($field);
		$class = '';
		?>

		<div class="pop-field">
			
		<?php //acf_hidden_input(array('name' => $field['name'])); ?>
		<div class="acfe-modal" data-title="<?php echo $field['label']; ?>" data-size="medium" data-footer="<?php _e('Close', 'acfe'); ?>">
			<div class="acfe-modal-wrapper">
				<div class="acfe-modal-content">
				
				<div class="acf-fields -left">

					<?php foreach($sub_fields as $sub_field): ?>
                		<?php acf_render_field_wrap($sub_field); ?>
        			<?php endforeach; ?>

				</div>
					
				</div>
			</div>
		</div>

		<?php 
			$preview = $this->pop_validation($field);
			if(isset($preview))
				$class = ($preview['display'] == true) ? '' : '-hide-ny';
		?>

		<div class="pop-media-field field-preview <?php echo $class; ?>">
			<?php 
				if(isset($preview['output']))
					echo $preview['output']; 
			?>
			<div class="overlay"></div>
			<span class="pop-note">update</span>
		</div>

		<a href="#" class="button" data-name="pop-button" target="">Pop Media</a>

		</div>

		<?php
		//echo '<pre>'; print_r( $field ); echo '</pre>';
	}

	/*------------------------------------------------*/

	function pop_validation($field) {
		
		$value = $field['value'];

		if($field['value']):

		$output    = '';
		$preivew   = '';

		$type      = $value['media-type'];
		$image 	   = $value['image']; 
		$video 	   = $value['video'];
		$thumbnail = $value['thumbnail']; 
		$yt 	   = $value['url'];
		$vm        = $value['vurl'];		

		$display = false;

		if($type == 'm-image'):
			$preview = el_img($image, array('echo'=>false, 'class'=>'pop-thumb prev-img'));
			
			if($image)
				$display = true;
		endif;	

		if($type == 'm-youtube'):
			$thumb = youtube_thumb($yt);
			$preview = el_img($thumb, array('echo'=>false, 'class'=>'pop-thumb prev-img'));

			if($yt)
				$display = true;
		endif;	

		if($type == 'm-vimeo'):
			$thumb = vimeo_thumb($vm);
			$preview = el_img($thumb, array('echo'=>false, 'class'=>'pop-thumb prev-img'));

			if($vm)
				$display = true;
		endif;	

		if($type == 'm-video'):
			$preview = el_video($video, array('echo'=>false, 'class'=>'pop-thumb prev-img', 'autoplay'=>''));

			if($video)
				$display = true;
		endif;	

		if($type != 'm-image' and $thumbnail):
			$preview = el_img($thumbnail, array('echo'=>false, 'class'=>'pop-thumb prev-img'));
		endif;

		if($display == true) {
			$output = $preview;
		}

		return array('output'=>$output, 'display'=>$display);

		endif;
	}

	/*------------------------------------------------*/

    /**
     * get_sub_fields
     *
     * @param $field
     *
     * @return mixed|null
     */
    function get_sub_fields($field){
        
        // get value
        $value = $field['value'];
        
        // storage
        $sub_fields = array();
		
        
		$sub_fields[] = array (
			'name' => 'media-type',        
			'label' => 'Media Type',
			'type' => 'select',
			'choices' => array(
				'm-image' => 'Image',
				'm-video' => 'Video',
				'm-youtube' => 'Youtube Video',
				'm-vimeo' => 'Vimeo Video',
			),
			//'value' => $value['media-type']     
			'value'  => isset($value['media-type']) ? $value['media-type'] : '',
		); 		

		// image
		$sub_fields[] = array (
			'name' => 'image',			
			'label' => 'Image',
			'library' => 'all',
			'type' => 'image',
			'required' => 0,
			'acfe_thumbnail' => 0,
			'return_format' => 'array',	
			'preview_size' => 'thumbnail',	
			'wrapper' => array (
				'width' => '',
				'class' => 'm-image mm',
				'id' => '',
			),
			//'value'  => $value['image'] 	     
			'value'  => isset($value['image']) ? $value['image'] : '',
		);
		
		// video
		$sub_fields[] = array (
			'name' => 'video',			
			'label' => 'Video',
			'library' => 'all',
			'type' => 'file',
			'required' => 0,
			'acfe_thumbnail' => 0,
			'return_format' => 'array',
			'preview_size' => 'medium',	
			'wrapper' => array (
				'width' => '',
				'class' => 'm-video mm',
				'id' => '',
			),
			'value'  => isset($value['video']) ? $value['video'] : '',
		);

		// youtube url
		/*
		$sub_fields[] = array(
			'name'              => 'url',
			'key'               => 'url',
			'label'             => __('Youtube URL', 'acf'),
			'type'              => 'text',
			'placeholder'		=> 'https://www.youtube.com/watch?v=6ab8c-UBmSs',
			'required'          => false,
			'class'             => 'input-url',
			'value'             => isset($value['type']) && $value['type'] === 'url' ? $value['value'] : '#', 
			'wrapper' => array (
				'width' => '',
				'class' => 'm-youtube mm',
				'id' => '',
			),			
			'conditional_logic' => array(
				array(
					array(
						'field'     => 'type',
						'operator'  => '==',
						'value'     => 'url',
					)
				)
			)
		);

		// vimeo url
		$sub_fields[] = array(
			'name'              => 'vurl',
			'key'               => 'vurl',
			'label'             => __('Vimeo URL', 'acf'),
			'type'              => 'text',
			'placeholder'		=> 'https://vimeo.com/643800930',
			'required'          => false,
			'class'             => 'input-url',
			'value'             => isset($value['type']) && $value['type'] === 'url' ? $value['value'] : '#', 
			'wrapper' => array (
				'width' => '',
				'class' => 'm-vimeo mm',
				'id' => '',
			),			
			'conditional_logic' => array(
				array(
					array(
						'field'     => 'type',
						'operator'  => '==',
						'value'     => 'url',
					)
				)
			)
		);			
		*/

		$sub_fields[] = array(
            'name'      	=> 'url',
            'key'       	=> 'url',
            'label'     	=> __('Link text', 'acf'),
            'type'      	=> 'text',
			'placeholder'	=> 'https://www.youtube.com/watch?v=6ab8c-UBmSs',
            'required'  	=> false,
            'class'     	=> 'input-url',
			'wrapper' => array (
				'width' => '',
				'class' => 'm-youtube mm',
				'id' => '',
			),			
			'value'  => isset($value['url']) ? $value['url'] : '',
        );

		$sub_fields[] = array(
            'name'      	=> 'vurl',
            'key'       	=> 'vurl',
            'label'     	=> __('Link text', 'acf'),
            'type'      	=> 'text',
			'placeholder'	=> 'https://vimeo.com/643800930',
            'required'  	=> false,
            'class'     	=> 'input-url',
			'wrapper' => array (
				'width' => '',
				'class' => 'm-vimeo mm',
				'id' => '',
			),			
			'value'  => isset($value['vurl']) ? $value['vurl'] : '',
        );		

	

		// thumbnail
		$sub_fields[] = array (
			'name' => 'thumbnail',			
			'label' => 'Thumbnail',
			'library' => 'all',
			'type' => 'image',
			'required' => 0,
			'acfe_thumbnail' => 0,
			'return_format' => 'array',	
			'preview_size' => 'thumbnail',	
			'wrapper' => array (
				'width' => '',
				'class' => 'box-thumb th',
				'id' => '',
			),
			//'value'  => $value['thumbnail'] 	     
			'value'  => isset($value['thumbnail']) ? $value['thumbnail'] : '',
		);
		


       
        // Sub Fields Fitlers
        #$sub_fields = apply_filters('acfe/fields/pop_media/sub_fields',                         $sub_fields, $field, $value);
        #$sub_fields = apply_filters('acfe/fields/pop_media/sub_fields/name=' . $field['_name'], $sub_fields, $field, $value);
        #$sub_fields = apply_filters('acfe/fields/pop_media/sub_fields/key=' . $field['key'],    $sub_fields, $field, $value);
        
        foreach($sub_fields as &$sub_field){
            
			$key = '';
			if(isset($sub_field['key']))
				$key = $sub_field['key'];
            
            if(isset($value[ $key ])){ // add value
                
                $sub_field['value'] = $value[ $key ]; // this is a normal value
                
            }elseif(isset($sub_field['default_value'])){               
                
                $sub_field['value'] = $sub_field['default_value']; // no value, but this subfield has a default value
                
            }
            
            
            $sub_field['prefix'] = $field['name']; // update prefix to allow for nested values
            
            $sub_field = acf_validate_field($sub_field); // validate sub field
            
        }
        
        return $sub_fields;
        
    }

	/*------------------------------------------------*/

	/**
	 * Enqueues CSS and JavaScript needed by HTML in the render_field() method.
	 * Callback for admin_enqueue_script.
	 * @return void
	 */

	public function input_admin_enqueue_scripts() {
		global $acf_assets;
		//$url = trailingslashit( $this->env['url'] );
		$url = $this->env['url'];
		$version = $this->env['version'];

		wp_register_script( 'billy-pop-media', 
		$acf_assets . "js/field.js", array( 'acf-input' ), $version);

		wp_register_style(
			'billy-pop-media',
			$acf_assets . "css/field.css",
			array( 'acf-input' ),
			$version
		);

		wp_enqueue_script( 'billy-pop-media' );
		wp_enqueue_style( 'billy-pop-media' );
	}
}

/*------------------------------------------------*/

acf_register_field_type( 'billy_acf_field_pop_media' );

