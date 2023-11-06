<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('04_checklist');
div_start('pt-[70px] pb-[100px]');
?>

<div class="site-container relative z-10">
    <?php if ($e['title']) : ?>
    <h2 class="text-sky-950 text-[40px] font-bold font-barlow leading-[48px]"><?php echo $e['title']; ?></h2>
    <?php else : ?>
    <p class="h-2 w-1/3 animate-pulse bg-[#777] rounded"></p>
    <?php endif; ?>
    <div class="tw-border mt-[25px] mb-[30px]"></div>

    <div class="flex flex-wrap justify-between gap-[20px] mt-[10px] tablet:gap-[45px] list">
        <?php if ($e['list']) : ?>
        <?php foreach ($e['list'] as $list) : ?>
        <div
            class='basis-[505px] flex gap-[17px] justify-start tablet:flex-grow-1 tablet:flex-shirnk-1 tablet:basis-full item'>
            <div class="basis-[30px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7 5.83333C6.35567 5.83333 5.83333 6.35567 5.83333 7V21C5.83333 21.6444 6.35567 22.1667 7 22.1667H21C21.6444 22.1667 22.1667 21.6444 22.1667 21V14C22.1667 13.3556 22.689 12.8333 23.3333 12.8333C23.9777 12.8333 24.5 13.3556 24.5 14V21C24.5 22.9331 22.9331 24.5 21 24.5H7C5.06701 24.5 3.5 22.9331 3.5 21V7C3.5 5.06701 5.06701 3.5 7 3.5H18.6667C19.311 3.5 19.8333 4.02234 19.8333 4.66667C19.8333 5.31099 19.311 5.83333 18.6667 5.83333H7ZM23.6751 5.00837C24.1306 4.55277 24.8694 4.55277 25.325 5.00837C25.7805 5.46399 25.7805 6.20268 25.325 6.65829L14.825 17.1583C14.3694 17.6139 13.6306 17.6139 13.1751 17.1583L9.67504 13.6583C9.21943 13.2027 9.21943 12.464 9.67504 12.0084C10.1307 11.5528 10.8693 11.5528 11.325 12.0084L14 14.6834L23.6751 5.00837Z"
                        fill="#0588BF" />
                </svg>
            </div>
            <div class="flex-1 tw-description">
                <?php echo $list['description']; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <?php $count = 0;
            while ($count < 6) :
            ?>
        <div
            class='basis-[505px] flex gap-[17px] justify-start tablet:flex-grow-1 tablet:flex-shirnk-1 tablet:basis-full item'>
            <div class="basis-[30px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7 5.83333C6.35567 5.83333 5.83333 6.35567 5.83333 7V21C5.83333 21.6444 6.35567 22.1667 7 22.1667H21C21.6444 22.1667 22.1667 21.6444 22.1667 21V14C22.1667 13.3556 22.689 12.8333 23.3333 12.8333C23.9777 12.8333 24.5 13.3556 24.5 14V21C24.5 22.9331 22.9331 24.5 21 24.5H7C5.06701 24.5 3.5 22.9331 3.5 21V7C3.5 5.06701 5.06701 3.5 7 3.5H18.6667C19.311 3.5 19.8333 4.02234 19.8333 4.66667C19.8333 5.31099 19.311 5.83333 18.6667 5.83333H7ZM23.6751 5.00837C24.1306 4.55277 24.8694 4.55277 25.325 5.00837C25.7805 5.46399 25.7805 6.20268 25.325 6.65829L14.825 17.1583C14.3694 17.6139 13.6306 17.6139 13.1751 17.1583L9.67504 13.6583C9.21943 13.2027 9.21943 12.464 9.67504 12.0084C10.1307 11.5528 10.8693 11.5528 11.325 12.0084L14 14.6834L23.6751 5.00837Z"
                        fill="#0588BF" />
                </svg>
            </div>
            <div class="flex-1 tw-description animate-pulse">
                <p class="h-2 bg-[#777] rounded"></p>
                <p class="h-2 bg-[#777] rounded"></p>
            </div>
        </div>
        <?php $count++;
            endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php div_end(); ?>