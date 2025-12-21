<div class="table-responsive">
    <table class="table table-bordered">
        <?= $slot ?>
    </table>

    <?php if(isset($meta) && !empty($meta)) : ?>
        <div class="pagination">
            <?php if(isset($meta["prev_page"]) && $meta["prev_page"] <= 0) : ?>
                <span class="page-button disabled">
                    <button>
                        <i class="fa fa-long-arrow-left"></i>
                        Prev
                    </button>
                </span>
            <?php else : ?>
                <a href="" class="page-button">
                    <button>
                        <i class="fa fa-long-arrow-left"></i>
                    </button>
                </a>
            <?php endif ?>

            <?php if($meta["total_pages"] && $meta["total_pages"] > 0) : ?>
                <?php for($i = 0; $i < $meta["total_pages"]; $i++) : ?>
                    <a href="" class="page-button <?= $i === 0 ? "active" : "" ?>">
                        <button><?= $i+1 ?></button>
                    </a>
                <?php endfor ?>
            <?php endif ?>

            <?php if(isset($meta["next_page"]) && $meta["next_page"] <= 0) : ?>
                <span class="page-button disabled">
                    <button>
                        Next
                        <i class="fa fa-long-arrow-right"></i>
                    </button>
                </span>
            <?php else : ?>
                <a href="" class="page-button">
                    <button>
                        Next
                        <i class="fa fa-long-arrow-right"></i>
                    </button>
                </a>
            <?php endif ?>
        </div>
    <?php endif ?>
</div>
