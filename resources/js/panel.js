import { panel } from "./Panel/default.js"
import BlockEditor from "./Editor/BlockEditor";
import Article from "./Panel/Article.js";
import Accordion from "./Panel/Components/Accordion.js";
import Primitives from "./Panel/Primitives.js";
import Page from "./Panel/Page.js";

// Initiate Panel
// Run after DOM Loaded
document.addEventListener("DOMContentLoaded", panel.init);

// const accordion = new Accordion();
// accordion.init();

const primitives = new Primitives();
primitives.init();

// Editor JS Setup
const editorContainer = document.getElementById("editor-container");
if(editorContainer) {
    const content = document.getElementById("editor-content");
    const editor = new BlockEditor("editor-container", {
        onChange: function(data) {
            content.value = JSON.stringify(data);
        }
    });
    editor.attachContentHandler(content);
}

// Initiate operations in article module
const article = new Article();
article.init();

// Handle page operations
const page = new Page();
page.init();
