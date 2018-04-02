$(document).ready(function () {

    var $deleteLink = $('.delete-link');

    $deleteLink.on('click', function () {
        var $this = $(this);
        var $id = $this.siblings().filter('.film-id').data('id');

        $.get('/film-delete/' + $id )
            .done(function (r) {
                var $row = $this.parent().parent();
                $row.fadeOut();
                setTimeout(function () {
                    $row.remove();
                },500)
            })
            .fail(function () {

            });

    });

});
