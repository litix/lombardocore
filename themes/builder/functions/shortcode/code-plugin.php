<?php
function el_table($acf='', $array=array()) {  

    $default = array( 
        //default will negate null values
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'br'        =>  true,
        'span'      =>  true,
        'echo'      =>  true,
        'data'      =>  '',
        'style'     =>  array(),
    );

    #parameters
    $param = array_merge($default, $array);

    #class
    $class = implode(" ", array('d-table table table-hover', $param['class']));
    $class = tag_attr_class($class);

    #style
    $ss = array_merge(array('s'=>true), $param['style']);
    $style = css_style($ss);

    $tag = '';
    $output = '';
    
    #content
    $content = "";
    if(class_exists('jh_acf_field_table')):
    if( !empty($acf)) {

        $tag = 'table';
        $table = $acf;

        if ( ! empty( $table['caption'] ) ) {
            $content = '<caption>' . $table['caption'] . '</caption>';
        }

        if ( ! empty( $table['header'] ) ) {
            $content .= '<thead>';
            $content .= '<tr>';
                    foreach ( $table['header'] as $th ) {
                        
                        $_th = $th['c'];

                        if($param['br'] == true) {
                            $_th = nl2br($th['c']);
                        }

                        $content .= "<th>" . $_th . "</th>";
                    }
            $content .= '</tr>';
            $content .= '</thead>';
        }

        $content .= '<tbody>';
            foreach ( $table['body'] as $tr ) {
                $content .= '<tr>';
                    foreach ( $tr as $td ) {
                        
                        $_td = $td['c'];

                        if($param['br'] == true) {
                            $_td = nl2br($td['c']);
                        }

                        $tdd = "<td>{$_td}</td>"; //default

                        if($param['span'] == true) // use col/row span
                            $tdd = use_tdspan($_td);
                        
                        if($_td != "") {
                            $content .= $tdd;
                        }                      

                    }
                $content .= '</tr>';
            }
        $content .= '</tbody>';
    }
    endif;

    #validation
    if(!class_exists('jh_acf_field_table')) { 
        $tag = 'div';
        $content = '<div class="error text-center p-5">
            Table Plugin Error<br>
            https://wordpress.org/plugins/advanced-custom-fields-table-field/
        </div>';        
    }    

    #attributes
    $attr = array(
        $tag,
        $class, 
        $param['id'], 
        $param['data'], 
        $style
    );

    $tag_attr = implode(" ", $attr); 
       

    if( !empty($acf)) {
        #output
        $output = "<{$tag_attr}>$content</$tag>";

        #div
        if($param['div'])
            $output = tag_wrap($param['div'], $output);
    }

    #echo
    if($param['echo'] == 1)
        echo $output;

    return $output;
   
}

function use_tdspan($_td) {   

    $td = "<td>{$_td}</td>";
    $kwr = "row:";
    $kwc = "col:";


    ## row
    if(strpos($_td, $kwr) > 0) :
        //$amt = substr($_td, strlen($_td)-1);

        // get the last number inside of string
        if(preg_match_all('/\d+/', $_td, $num))
            $amt = end($num[0]);

        //replace the keyword in the string
        $_td = str_replace("{$kwr}{$amt}", "", $_td);

        //create the rowspan
        $td = "<td rowspan=\"{$amt}\">{$_td}</td>";

    endif;


    ## col
    if(strpos($_td, $kwc) > 0) :
        //$amt = substr($_td, strlen($_td)-1);

        // get the last number inside of string
        if(preg_match_all('/\d+/', $_td, $num))
            $amt = end($num[0]);

        //replace the keyword in the string
        $_td = str_replace("{$kwc}{$amt}", "", $_td);

        //create the rowspan
        $td = "<td colspan=\"{$amt}\">{$_td}</td>";
        
    endif;    
    
    if($_td == '-') :
        $td = "<td></td>";
    endif;
    
    return $td;
}

?>