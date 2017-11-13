<body>
<div class="content">
    <section class="container news-container content-container">
        <h2>Create your gallery:</h2>
        <div class="invalid-feedback visible" id="limitError"><?php if (isset($limit_error)) echo $limit_error; ?></div>
        <?php echo form_open_multipart('/create-gallery-form', "class='create-gallery-form'") ?>
            <label class="custom-file">
                <input type="file" id="file2" name="file" class="custom-file-input" required>
                <span class="custom-file-control"></span>
            </label><br>
            <div class="invalid-feedback visible" id="fileError"><?php if (isset($error))echo $error; ?></div>
            <input type="text" class="form-control" id="galleryName" name="galleryName" value="<?php echo set_value('galleryName'); ?>" placeholder="Enter Gallery Name" required>
            <div class="invalid-feedback visible"><?php echo form_error('galleryName'); ?></div>
            <button type="submit" class="btn btn-primary" id="create-gallery-btn" name="submit">Submit</button>
        </form>
    </section>
</div>

<script src="<?php echo base_url(); ?>/public/js/gallery-page-create.js"></script>
</body>
</html>