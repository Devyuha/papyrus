import {
    makeSlug
} from "./utils.js";

class Article {
    init() {
        const form = document.getElementById("article-form");
        if(form) {
            this.processSlug();
            this.bannerPreview();
            this.handlePageParent();
            this.handlePageParentOnLoad();
        }
    }

    processSlug() {
        const titleInput = document.getElementById("title");
        const slugInput = document.getElementById("slug");
        titleInput.addEventListener("change", function(e) {
            let slug = makeSlug(e.target.value);
            slugInput.value = slug;
        })
    }

    bannerPreview() {
        const bannerInput = document.getElementById("banner-image");
        const bannerPreview = document.getElementById("banner-preview");

        bannerInput.addEventListener("change", (e) => {
            const file = e.target.files[0];
            const preview = bannerPreview.querySelector("img");

            if(file && file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    preview.src = event.target.result;
                    bannerPreview.style.display = "block";
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                bannerPreview.style.display = "none";
            }
        })
    }

    handlePageParent() {
        const pageType = document.getElementById("page_type");
        const pageParent = document.getElementById("page_parent");

        if(pageType && pageParent) {
            pageType.addEventListener("change", (e) => {
                const value = e.target.value;
                if(value === "page") {
                    pageParent.style.display = "block";
                } else {
                    pageParent.style.display = "none";
                }
            });
        }
    }

    handlePageParentOnLoad() {
        document.addEventListener("DOMContentLoaded", () => {
            const pageType = document.getElementById("page_type");
            const pageParent = document.getElementById("page_parent");

            if(pageType && pageParent) {
                const value = pageType.value;
                if(value === "page") {
                    pageParent.style.display = "block";
                } else {
                    pageParent.style.display = "none";
                }
            }
        });
    }
}

export default Article;
