<!-- search -->
<div class="widget as-common cats year">
    <h4 class="wtitle">By Year</h4>
    <div id="cat-year">
    <?php
        global $wpdb;
        $limit = 0;
        $year_prev = null;

        $sql = "SELECT DISTINCT MONTH( post_date ) AS month ,  
        YEAR( post_date ) AS year, COUNT( id ) as post_count 
        FROM $wpdb->posts WHERE post_status = 'publish' and 
        post_date <= now( ) and post_type = 'post' GROUP BY month , 
        year ORDER BY post_date DESC";

        $months = $wpdb->get_results($sql);
        
        $i = 0;
        foreach($months as $month) :
            $year_current = $month->year;
            if ($year_current != $year_prev){
                if ($year_prev != null){
        ?>
                
        <?php } ?>

        <?php if($i > 0) echo '</ul></div>'; ?>            

        <h5 class="font-2 expander">
            <span data-toggle="collapse" data-target="#collapse-<?php echo $month->year; ?>"><?php echo $month->year; ?></span>
        </h5> 

        <div id="collapse-<?php echo $month->year; ?>" class="expand collapse <?php if($i==0) echo 'show'; ?>" data-parent="#cat-year">
        <ul class="bullet">        
        <?php } ?>

        <li>
            <a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>">
                <span class="archive-month"><?php echo date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span>
            </a>
        </li>

        <?php 
        $year_prev = $year_current;           
        if(++$limit >= 100) { break; }    
        ?>
        <?php 
        $i++;
        endforeach; 
        ?> 
        </ul>
    </div>
</div>