<?php 

  ## LINK assets/theme/tpl-footer-1.css
  load_assets(array('menu-config', 'tpl-footer-1'));

?>

<div class="mh"></div>


<footer class="element footer-0" data-theme="dark" data-tpl="default">  
<div class="wrap">
   <div class="container-xl">
<!--
   <div class="dtop">
      <div class="row">

         <div class="col-md-3">
            <?php echo do_shortcode('[footer-menu menu="0"]'); ?>
         </div>

         <div class="col-md-3">
            <?php echo do_shortcode('[footer-menu menu="1"]'); ?>
         </div>

         <div class="col-md-3">
            <?php echo do_shortcode('[footer-menu menu="2"]'); ?>
         </div>
         
         <div class="col-md-3">
            <div class="dcompany">
               <?php 
                  echo do_shortcode('[social-icons]'); 
                  echo do_shortcode('[company-name tag="h5"]'); 
                  echo do_shortcode('[contact-phone icon="0" linked="1" loop="1"]');
                  echo do_shortcode('[contact-address icon="0" linked="1" loop="1"]');
               ?>
            </div>
         </div>
      
      </div>
   </div>

   <div class="copyright">
      <div class="foot">
         <div class="f-left">
            <?php do_shortcode('[disclaimer echo=1]');  ?>
            <?php do_shortcode("[copyright echo=1]"); ?>
         </div>
         <div class="f-right">
            <?php do_shortcode('[mini-links echo=1]'); ?>
            <?php do_shortcode("[web-design echo=1]"); ?>
         </div>
      </div>
   </div>
-->
   </div>
</div>
</footer> 

<?php do_shortcode('[scroll-up echo="1"]'); ?>