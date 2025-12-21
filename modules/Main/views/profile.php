<?php $template->includes("includes/header") ?>

        <?php $template->includes("includes/pagebar", [
                "pageTitle" => "Profile",
                "pageNavs" => ["Home", "Profile"]
        ]); ?>

        <!-- Content Section -->
        <div class="content-section">
            <div class="section-header">
                Welcome to Your Dashboard
            </div>
            <div class="section-body">
                <p>This is a custom-built admin panel created with vanilla HTML, CSS, and JavaScript. It features:</p>
                <ul style="margin: 20px 0; padding-left: 20px;">
                    <li>Fully responsive design that works on all devices</li>
                    <li>Collapsible sidebar with smooth animations</li>
                    <li>Modern UI with clean design principles</li>
                    <li>No external dependencies or frameworks</li>
                    <li>Customizable and extensible architecture</li>
                </ul>
                <p>Start building your amazing application from here!</p>
            </div>
        </div>

<?php $template->includes("includes/footer") ?>
