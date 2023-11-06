<style>
:root {
    --color-404-2 : white;
    --color-404-3 : #aaa;
}    
.mycenter { font-size: 1.5rem;  height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; }
.error { display: flex; flex-direction: row; justify-content: space-between; align-content: center; }

.number { font-weight: 900; font-size: 15rem; line-height: 1; }
.illustration { position: relative; width: 12.2rem; margin: 0 1rem; }
.circle { position: absolute; bottom: 0; left: 0; width: 12.2rem; height: 11.4rem; border-radius: 50%;  }
.clip { position: absolute; bottom: 0.3rem; left: 50%; transform: translateX(-50%); overflow: hidden; width: 12.5rem; height: 13rem; border-radius: 0 0 50% 50%; }
.paper { position: absolute; bottom: -0.3rem; left: 50%; transform: translateX(-50%); width: 9.2rem; height: 12.4rem; border: 0.3rem solid; background-color: white; border-radius: 0.8rem; }
.face { position: relative; margin-top: 2.3rem; }
.eyes { position: absolute; top: 0; left: 2.4rem; width: 4.6rem; height: 0.8rem; }
.eye { position: absolute; bottom: 0; width: 0.8rem; height: 0.8rem; border-radius: 50%; background-color: #293b49; }
.eye { animation-name: eye; animation-duration: 4s; animation-iteration-count: infinite; animation-timing-function: ease-in-out; }
.eye-left { left: 0; }
.eye-right { right: 0; }
@keyframes eye {  0% { height: 0.8rem; } 50% { height: 0.8rem; } 52% { height: 0.1rem; } 54% {  height: 0.8rem; }  100% { height: 0.8rem; } }
.rosyCheeks { position: absolute; top: 1.6rem; width: 1rem; height: 0.2rem; border-radius: 50%; background-color: #fdabaf; }
.rosyCheeks-left { left: 1.4rem; }
.rosyCheeks-right { right: 1.4rem; }
.mouth { position: absolute; top: 3.1rem; left: 50%; width: 1.6rem; height: 0.2rem; border-radius: 0.1rem; transform: translateX(-50%); background-color: #293b49; } 

.el-error .row { align-items: center; }
.el-error .text { font-size: 2em; font-weight: 300; line-height: 120%; }
.el-error .wrap { padding: 70px 0 100px; }
.el-error .btn-1 {  font-size: 15px; border:none; padding: 10px 20px; }
.el-error .mycenter, .el-error .text, .el-error .btn-d, .el-error .search { margin-bottom: 20px; }
.el-error .pic-404 img { width: 100%; }

.light-theme.el-error { background-color: var(--color-404-2); }
.light-theme .mycenter, .light-theme .text { color: var(--bg2); }
.light-theme .circle { background-color: var(--bg2); }
.light-theme .paper { border-color: var(--bg2); }
.light-theme .btn-1{ background-color: var(--bg2);  color: white;  }
.light-theme .btn-1:hover { background-color: var(--color-404-3);  color: var(--bg2);  }

@media only screen and (max-width : 991px) {  .el-error { text-align: center;  } }


</style>
<?php 
$mallow = '<div class="mycenter">
<div class="error">
<div class="number">4</div>

<div class="illustration">
    <div class="circle"></div>
    <div class="clip">
    <div class="paper">
        <div class="face">
        <div class="eyes">
            <div class="eye eye-left"></div>
            <div class="eye eye-right"></div>
        </div>
        <div class="rosyCheeks rosyCheeks-left"></div>
        <div class="rosyCheeks rosyCheeks-right"></div>
        <div class="mouth"></div>
        </div>
    </div>
    </div>
</div>

<div class="number">4</div>
</div>
</div>';

$e = get_field('placeholders', 'options');
$pic = $e['404_image'];
?>

<div class="row">
    <div class="col-lg-6">
       <div class="pic-404">
       <?php 
            if($pic) {
                bd_img($pic);
            } else {
                echo $mallow;
            }
        ?>    
        </div> 
    </div>    
    <div class="col-lg-1"></div>
    <div class="col-lg-5">
        <div class="text">Oops. The page you're looking for doesn't exist.</div>
        <div class="search"><?php echo get_search('Make a search...'); ?></div>
        <a class="btn btn-1" href="<?php echo home_url(); ?>">
            Back Home
        </a>
        </div>
    </div>    
</div>

