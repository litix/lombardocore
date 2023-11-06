<?php 
    global $tpath, $post;
    $dot1 = $tpath . '/images/icons/map-icon.svg';

    load_assets(array('usmap'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    section_class("simplemap-01");
    div_start('dflex', array('data'=>data_set($opt)));  

?>

<div class="container-xl">         
    <?php if(!is_admin()): ?>

        <div class="col-info">
            <div class="map-bg simplemap">
                <div id="usmap"></div>
            </div>
        </div>        

    <?php else: ?>
        <div class="p-5 text-center">Simple Map</div>
    <?php endif; ?>            
</div>    

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>
//https://simplemaps.com/docs/main-settings    

var simplemaps_usmap_mapdata={
    main_settings: {
    //General settings
	width: "responsive", //or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    popups: "on_hover",
    
    //State defaults
    state_description: "",
    state_color: "#E5E5E5",
    state_hover_color: "#CFD2DB",
    state_url: "",
    border_size: 1,
    border_color: "#ffffff",
    all_states_inactive: "yes",
    all_states_zoomable: "no",
    
	//Location defaults
	location_description: "",
    location_color: "#FF0067",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_url: "",
    location_size: 25,
    location_type: "square",
    location_border_color: "#FFFFFF",
    location_border: 2,
    location_hover_border: 2.5,
    all_locations_inactive: "no",
    all_locations_hidden: "no",
    
    //Label defaults
    label_color: "#ffffff",
    label_hover_color: "#ffffff",
    label_size: 22,
    label_font: "Arial",
    hide_labels: "no",
   
    //Zoom settings
    manual_zoom: "no",
    back_image: "no",
    arrow_box: "no",
    navigation_size: "40",
    navigation_color: "#f7f7f7",
    navigation_border_color: "#636363",
    initial_back: "no",
    initial_zoom: -1,
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 0.99,
    zoom_time: 0.5,
    
    //Popup settings
    popup_color: "white",
    popup_opacity: 0.9,
    popup_shadow: 0,
    popup_corners: 0,
    popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
    popup_nocss: "no",
    popup_orientation: "above",
    popup_centered: "yes",
    
    //Advanced settings
    div: "usmap",
    auto_load: "yes",
    js_hooks: 'yes', 
    rotate: "0",
    url_new_tab: "yes",
    images_directory: "default",
    import_labels: "no",
    fade_time: 0.1,
    link_text: "",
    state_image_url: "",
    state_image_position: "",
    location_image_url: ""    
  },
  state_specific: {
    HI: { name: " " },
    AK: { name: " " },
    FL: { name: "Florida" },
    NH: { name: "New Hampshire" },
    VT: { name: "Vermont" },
    ME: { name: "Maine" },
    RI: { name: "Rhode Island" },
    NY: { name: "New York" },
    PA: { name: "Pennsylvania" },
    NJ: { name: "New Jersey" },
    DE: { name: "Delaware" },
    MD: { name: "Maryland" },
    VA: { name: "Virginia" },
    WV: { name: "West Virginia" },
    OH: { name: "Ohio" },
    IN: { name: "Indiana" },
    IL: { name: "Illinois" },
    CT: { name: "Connecticut" },
    WI: { name: "Wisconsin" },
    NC: { name: "North Carolina" },
    DC: { name: "District of Columbia" },
    MA: { name: "Massachusetts" },
    TN: { name: "Tennessee" },
    AR: { name: "Arkansas" },
    MO: { name: "Missouri" },
    GA: { name: "Georgia" },
    SC: { name: "South Carolina" },
    KY: { name: "Kentucky" },
    AL: { name: "Alabama" },
    LA: { name: "Louisiana" },
    MS: { name: "Mississippi" },
    IA: { name: "Iowa" },
    MN: { name: "Minnesota" },
    OK: { name: "Oklahoma" },
    TX: { name: "Texas" },
    NM: { name: "New Mexico" },
    KS: { name: "Kansas"  },
    NE: { name: "Nebraska"  },
    SD: { name: "South Dakota"  },
    ND: { name: "North Dakota"  },
    WY: { name: "Wyoming"  },
    MT: { name: "Montana"  },
    CO: { name: "Colorado"   },
    UT: { name: "Utah"    },
    AZ: { name: "Arizona" },
    NV: { name: "Nevada"  },
    OR: { name: "Oregon"  },
    WA: { name: "Washington" },
    CA: { name: "California" },
    MI: { name: "Michigan"   },
    ID: { name: "Idaho"  },
    GU: { name: "Guam" },
    VI: { name: "Virgin Islands" },
    PR: { name: "Puerto Rico" },
    MP: { name: "Northern Mariana Islands" },
    AS: { name: "American Samoa" }
  },
  labels: {},
  regions: {
    "0": {
      states: [],
      zoomable: "no"
    }
  }, 

  locations: {

    <?php 
        $i = 0;

        $opt = $e['display_fields'];        
        $rp = $e['items'];

        if($rp):
        foreach($rp as $r):
              
            $img = $r['image'];
            $title = el_title($r['title'], array('css'=>'ititle', 'echo'=>0));
            $imgtitle = strip_tags($r['title']);
            $text = el_text($r['text'], array('css'=>'dtext', 'echo'=>0));
            $text = str_replace(array("\r", "\n"), '', $text);

            $loc = $r['location'];
            $lat = $loc['lat'];
            $lon = $loc['lon'];

            $data = data_set($opt, 0);

            $url = '';
            
            if(isset($r['button'])) {
               $btn = $r['button'];           
               $url = $btn['url'];
            }

            $src = image_src($img);
            $img = '';
            if($src != '')
                $img = "<img src=\"{$src}\" alt=\"{$imgtitle}\">";
            $pop = "<div class=\"pop-map\" {$data}>{$img}{$title}{$text}</div>";
    ?>
    
        "<?php _e($i); ?>": {
            lat: "<?php _e($lat); ?>",
            lng: "<?php _e($lon); ?>",
            description: '<?php _e($pop); ?>',
            url: "<?php _e($url) ?>",
            name: "",
            size: "22",
            type: "image",      
            image_url: "<?php _e($dot1); ?>",
            //image_hover_url: "<?php //_e($dot2); ?>",
        },
    
    <?php 
        $i++;
    endforeach;
    endif;
    ?>

  },
};   
</script>
<?php endif; ?> 