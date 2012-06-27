jQuery(document).ready(function($){
    $('#widget-list').append('<p class="clear description" style="border-bottom: 1px solid #ccc;">Wallow widgets</p>');
    bz_widgets = $('#widget-list .widget[id*=_wlw-]');
    $('#widget-list').append(bz_widgets);
});