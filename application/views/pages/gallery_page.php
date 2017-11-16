<body class="news-page">

<div class="content">
    <section class="container news-container content-container">
        <?php if (!isset($image_error)) : ?>
            <div class="row justify-content-between buttons-group">
                <button type="button" class="btn btn-danger delete-all" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php  echo $gallery_id;?>">Delete All</button>
                <!--            delete-all -> this class to handle this button in js and set coorect action in form popup-->
                <button type="button" class="btn btn-danger delete-selected" data-toggle="modal" data-target="#delete-image-popup">Delete Selected</button>
                <!--            delete-selected -> this class to handle this button in js and set coorect action in form popup-->

            </div>
        <?php endif; ?>
        <?php if (isset($image_error)) : ?>
            <a href="<?php echo base_url() . 'gallery/' . $gallery_id . '/page' ?>">Go to gallery page</a>
        <?php endif; ?>
        <div class="row justify-content-between images-wrapper">
            <div class="image-container col-12 col-md-4 add-image-block">
                <?php echo form_open_multipart("gallery/{$gallery_id}/upload-image", "id='uploadForm'") ?>
                    <div class="button-container">
                        <input type="file" name="file" id="file" class="add-button input-file" />
                        <label for="file">
                            <figure></figure>
                            <p>Choose file...</p>
                            <div class="invalid-feedback visible"><?php if (isset($image_error)) echo $image_error; ?></div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="upload-image">Upload</button>
                </form>
            </div>
            <?php foreach ($content as $content_item) : ?>
                <div class="image-container col-12 col-md-4">
                    <div class="image">
                        <img src="<?php echo '/uploads/img/user_id_' . $user_id . '/gallery_' . $content_item['gallery_fetch_name'] . '/' . $content_item['user_img']?>" alt="Your image" class="rounded">
                    </div>
                    <div class="custom-popover">
                        <button type="button" class="btn btn-primary zoom-button" data-src="<?php echo '/uploads/img/user_id_' . $user_id . '/gallery_' . $content_item['gallery_fetch_name'] . '/' . $content_item['user_img']?>">Zoom</button>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="chk[]" value="<?php echo $content_item['user_img']; ?>">
                            </label>
                        </div>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $content_item['user_img']; ?>">Delete image</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($pagination))echo $pagination; ?>
    </section>
</div>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="name">
                    <input type="hidden" name="gallery" value="<?php echo $gallery_id;?>">
                    <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="zoom-container">
    <div class="zoom-popup">
        <span class="fa fa-remove fa-2x close-button"></span>
        <img src="" alt="">
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/gallery-page.js"></script>
</body>
</html>
