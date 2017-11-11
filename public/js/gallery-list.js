document.addEventListener('DOMContentLoaded', function() {
    $('#delete-image-popup').on('shown.bs.modal', function (e) {
        var input = this.getElementsByTagName('input')[0],
            galleryName,
            form = this.getElementsByTagName('form')[0];
        galleryName = e.relatedTarget.getAttribute('data-name');
        input.setAttribute('value', galleryName);
    });
});