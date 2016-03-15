/**
 * Created by gustavo on 11/03/16.
 */

function bindFormsSubmit() {
    $('form:not([data-noajax])').unbind('submit');
    $('form:not([data-noajax])').bind('submit', function(e){
        var _form = $(this).closest('form');
        var _icon = $('button', this).children('i');
        $.ajax({
            url: _form.attr('action'),
            type: "POST",
            data: $(this).closest('form').serialize(),
            async: false,
            beforeSend: function () {
                var lastClass = $(_icon).attr('class').split(' ').pop();
                _icon.removeClass(lastClass).toggleClass('fa-spinner');
                return true;
            },
            success: function (data) {
                _form.parent().html(data);
                _icon.toggleClass('fa-spinner');
                bindFormsSubmit();
            }
        });
        e.preventDefault();
    });
}

$(document).ready(function(){
    bindFormsSubmit();
})