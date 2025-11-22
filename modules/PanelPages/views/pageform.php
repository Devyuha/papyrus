    <form action="<?= $formUrl ?>" id="article-form" class="panel-form" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <?php $template->includes("includes/messages", null, "Auth") ?>
        <div class="grid grid-cols-12 gap-2">
            <div class="md:col-span-8">
                <div class="mb-3 border-b border-solid border-dark-400 py-2">
                    <input type="text" class="article-title" name="title" id="title" value="<?= $title ?? old('title') ?>" placeholder="Title" />
                </div>
                <div class="mb-3">
                    <div id="editor-container" class="editor-container"></div>
                    <input type="hidden" name="content" id="editor-content" value='<?= $content ?? old('content') ?>' />
                </div>
            </div>
            <div class="md:col-span-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Page Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="url">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" value="<?= $slug ?? old('slug') ?>" />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="page_type">Type</label>
                            <select class="form-control" name="type" id="page_type">
                                <option value="page" <?= (isset($type) && $type === "page") ? "selected" : "" ?>>Page</option>
                                <option value="chapter" <?= (isset($type) && $type === "chapter") ? "selected" : "" ?>>Chapter</option>
                            </select>
                        </div>

                        <div class="form-group" id="page_parent">
                            <label class="form-label" for="parent">Parent</label>
                            <select class="form-control" name="parent" id="parent">
                                <option value=""></option>
                                <?php if(isset($chapters) && $chapters->count() > 0) : ?>
                                    <?php foreach($chapters->getData() as $chapter) : ?>
                                        <option value="<?= $chapter["id"] ?>" <?= (isset($parent_id) && $parent_id === $chapter["id"]) ? "selected" : "" ?>><?= $chapter["title"] ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="tags">Tags</label>
                            <input type="text" class="form-control no-resize" rows="2" name="tags" id="tags" value="<?= $tags ?? old('tags') ?>" />
                            <span class="label-xs">Seperate tags with comma(,)</span>
                        </div>
                    </div>
                </div>
                <br />
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Media</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="banner-image">Banner Image</label>
                            <input type="file" class="form-control" accept="image/*" name="banner" id="banner-image" />
                        </div>

                        <div class="" id="banner-preview" <?= isset($banner_url) ? 'style="display: block;"' : '' ?>>
                            <img src="<?= $banner_url ?>" id="preview" alt="Banner Preview" />
                        </div>
                    </div>
                </div>
                <br/>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Meta Data (Optional)</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="meta-title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta-title" value="<?= $meta_title ?? old('meta_title') ?>" />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="meta-description">Meta Description</label>
                            <textarea class="form-control no-resize" rows="3" name="meta_description" id="meta-description"><?= $meta_description ?? old('meta_description') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="meta-tags">Meta Tags</label>
                            <input type="text" class="form-control no-resize" rows="2" name="meta_tags" id="meta-tags" value="<?= $meta_tags ?? old('meta_tags') ?>" />
                        </div>
                    </div>
                </div>
                <br />
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
