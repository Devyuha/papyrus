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
                <a href="<?= get_url(["page" => $meta["current_page"] - 1]) ?>" class="page-button">
                    <button>
                        <i class="fa fa-long-arrow-left"></i>
                        Prev
                    </button>
                </a>
            <?php endif ?>

            <?php if($meta["total_pages"] && $meta["total_pages"] > 0) : ?>
                <?php for($i = 1; $i <= $meta["total_pages"]; $i++) : ?>
                    <a href="<?= get_url(["page" => $i]) ?>" class="page-button <?= $i === $meta["current_page"] ? "active" : "" ?>">
                        <button><?= $i ?></button>
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
                <a href="<?= get_url(["page" => $meta["current_page"]+1]) ?>" class="page-button">
                    <button>
                        Next
                        <i class="fa fa-long-arrow-right"></i>
                    </button>
                </a>
            <?php endif ?>
        </div>
    <?php endif ?>
</div>
