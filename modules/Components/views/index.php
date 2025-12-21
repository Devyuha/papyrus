<?php $template->includes("includes/header", null, "Panel") ?>

        <?php $template->includes("includes/pagebar", [
                "pageTitle" => "Components",
                "pageNavs" => ["Home", "Components"]
        ], "Panel"); ?>

        <!-- Content Section -->
        <div class="content-section">
            <div class="section-body">
                <p>All components developed within Papyrus :</p>
                <br/>
                <div class="flex flex-col gap-4 p-5 border border-solid border-dark-100">
                    <p class="text-dark-100 text-sm font-semibold">Buttons :</p>
                    <div class="flex flex-row gap-2">
                        <button class="btn btn-sm btn-primary">Primary</button>
                        <button class="btn btn-sm btn-success">Success</button>
                        <button class="btn btn-sm btn-info">Info</button>
                        <button class="btn btn-sm btn-warning">Warning</button>
                        <button class="btn btn-sm btn-danger">Danger</button>
                    </div>

                    <div>
                        <button class="btn btn-sm btn-primary">Small</button>
                        <button class="btn btn-lg btn-info">Large</button>
                    </div>

                    <div>
                        <button class="btn btn-block btn-primary">Block</button>
                    </div>
                </div>
                <br/>
                <div class="flex flex-col gap-4 p-5 border border-solid border-dark-100">
                    <p class="text-dark-100 text-sm font-semibold">Alerts :</p>
                    <div class="flex flex-col gap-2">
                        <div class="alert alert-primary">
                            This is a primary alert.
                            <button class="alert-dismissable">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="alert alert-success">
                            This is a success alert.
                            <button class="alert-dismissable">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="alert alert-danger">
                            This is a danger alert.
                            <button class="alert-dismissable">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="alert alert-info">
                            This is a info alert.
                            <button class="alert-dismissable">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="alert alert-warning">
                            This is a warning alert.
                            <button class="alert-dismissable">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="flex flex-col gap-4 p-5 border border-solid border-dark-100">
                    <p class="text-dark-100 text-sm font-semibold">Pagination</p>
                    
                    <div class="pagination">
                        <span class="page-button disabled">
                            <button>
                                <i class="fa fa-long-arrow-left"></i>
                                Prev
                            </button>
                        </span>
                        <?php for($i = 0; $i < 10; $i++) : ?>
                            <a href="" class="page-button <?= $i === 0 ? "active" : "" ?>">
                                <button><?= $i+1 ?></button>
                            </a>
                        <?php endfor ?>
                        <a href="" class="page-button">
                            <button>
                                Next
                                <i class="fa fa-long-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

<?php $template->includes("includes/footer", null, "Panel") ?>
