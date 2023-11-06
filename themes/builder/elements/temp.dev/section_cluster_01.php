<?php 
    global $cluster_id;
    $cluster_id++;

    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## set your parameters   
    section_cluster(
        array(
            'class'=>"section-cluster cluster-{$cluster_id}"
        )
    );

    ## start the cluster
    global $cluster;
    $cluster = create_fire($e['sections']);

    ## leave an admin message
    if(is_admin()) {
        $amt = $cluster - 1;
        echo "<div class=\"text-center p-4\">Group {$amt} Sections (below)</div>";
    }
?>

<?php 
    ## your code here....    
?>



