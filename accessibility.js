jQuery(document).ready(function ($) {
    $('#scanBtn').on('click', function () {
        const html = $('#htmlInput').val();
        $('#accessibilityOutput').text('Scanning...');

        $.post(accessibility_ajax.ajax_url, {
            action: 'check_accessibility',
            html: html
        }, function (response) {
            $('#accessibilityOutput').text(JSON.stringify(response, null, 2));
        });
    });
});
