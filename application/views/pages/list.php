<body>
<div class="content">
    <section class="container news-container content-container">
        <a href="/create-gallery" class="btn btn-primary">Create gallery</a>
        <?php foreach ($list_data as $item): ?>
            <div class="card card-custom">
                <img class="card-img-top" src="/uploads/img/user_id_<?php echo $user_id; ?>/gallery_<?php echo $item['fetch_name']; ?>/<?php echo $item['avatar']; ?>" alt="Card image cap">
                <div class="card-block">
                    <h4 class="card-title"><?php echo $item['name']; ?></h4>
                    <div class="buttons-group">
                        <a href="/gallery/<?php echo $item['id']; ?>" class="btn btn-primary">Open Gallery</a>
                        <button type="button" class="btn btn-danger delete-all" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $item['name']; ?>">Delete Gallery</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

</div>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <?php echo form_open('delete-gallery'); ?>
                    <input type="hidden" name="name">
                    <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script src="<?php echo base_url(); ?>public/js/gallery-list.js"></script>
</html>
