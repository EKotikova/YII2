
jQuery(document).ready(function () {
   var TriggerClickList = 1;
    if (typeof sessionStorage['work'] == "undefined") {
        sessionStorage['work'] = '1';
    };
    $('input.select-on-check-all').hide();
    /* вызов модального окна для добавления организации*/

    var nav = document.querySelector('.navbar');
        nav.className += "my_top_navbar";
    jQuery(document).on('click', '.activity-create-link', function (e) {
        var _url = jQuery(this).closest('a').data('url');
        var _title = jQuery(this).closest('a').data('title');
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#mymodal').removeAttr('tabindex');
               /* var div = document.getElementsByClassName("required");
                for (var i=0; i<div.length;i++) {
                    var label=div.item(i).getElementsByTagName('label');
                    for (var l=0;l<label.length;l++){
                        label.item(l).innerHTML+='<span class="read">*</span>';
                    }
                }*/
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4><br/>');

            }
        });
    });

    jQuery(document).on('click', '.order ', function (e) {
        var content_class = document.querySelector('.modal-content');
        content_class.className = 'modal-content';
        (this).className = 'btn-close';
            $('#modalHeader_child>h4').detach();
            $('#modalHeader_agreements>h4').detach();
            $('#modalHeader>h4').detach();
        jQuery('#mymodal').modal('hide');
        jQuery('._title').remove();
        // var content_class = document.querySelector('.map');
        // if(content_class.className === 'map') {
        //     content_class.className = 'modal-content';
        //     (this).className = 'btn-close';
        //     $('#modalHeader_child>h4').detach();
        //     $('#modalHeader_agreements>h4').detach();
        //     $('#modalHeader>h4').detach();
        //
        // }
        // if(content_class.className === 'modal-content'){
        //         (this).className = 'btn-close';
        //     $('#modalHeader_child>h4').detach();
        //     $('#modalHeader_agreements>h4').detach();
        //     $('#modalHeader>h4').detach();
        //     }




        //$('#modalHeader>h4').detach();
        // $('#modalHeader_agreements>h4').detach();



    });

    jQuery(document).on('click', '.order1', function (e) {
        var content_class = document.querySelector('.map_child');
        content_class.className='modal-content';
        (this).className = 'btn-close';
        $('#modalHeader_child>h4').detach();
    });

    jQuery(document).on('click','#modalCancel',function (){
        jQuery('#mymodal').modal('hide');
        jQuery('._title').remove();
    });

    jQuery(document).on('click','#modalCancel',function (){
        jQuery('#mymodal_child').modal('hide');
        jQuery('.block-title').remove();
    });

    jQuery(document).on('click','#modalCancel',function (){
        jQuery('#mymodal_additional').modal('hide');
        jQuery('._title').remove();
    });

    jQuery(document).on('click','#modalCancel',function (){
        jQuery('#mymodal_calendar').modal('hide');
        jQuery('._title').remove();
    });


    //вызов модального окна для редактирования, изменения и просмотра
    jQuery(document).on('click', '.activity-view-link', function (e) {
           e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.agrements-view-link', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.agreements-update-link', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.additional-view-link', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.additional-update-link', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.calendar-plans-update-link', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });


    jQuery(document).on('click', '.update_source', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                var modal = document.querySelector('#mymodal');
                var input_val = modal.querySelector('#source-value');
                input_val.setAttribute('disabled','disabled');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.map_records', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                var modal = document.querySelector('#mymodal');
                var input_val = modal.querySelector('#source-value');
                input_val.setAttribute('disabled','disabled');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.map_records-link', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.agreements-bp_view', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                var modal = document.querySelector('#mymodal');
                var input_val = modal.querySelector('#source-value');
                input_val.setAttribute('disabled','disabled');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.agreements-bp-update-link', function (e) {
        e.preventDefault();
        var bclose = document.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal .modal-body').html(data);
                jQuery('#mymodal').modal('show');
                jQuery('#modalHeader').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal').removeAttr('tabindex');
            }
        });
        return false;
    });


    jQuery(document).on('click', '.agreements_view', function (e) {
        e.preventDefault();

        var model_el = document.getElementById('mymodal_agreements');
        var bclose_agreements = model_el.querySelector('.btn-close');
        bclose_agreements.className += ' order';

        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal_agreements .modal-body').html(data);
                jQuery('#mymodal_agreements').modal('show');

                var mod_content = model_el.getElementsByClassName('modal-content');
                var agreement_view = model_el.getElementsByClassName('agreements-view');
                if(agreement_view.item(0).className === "details-block  agreements-view"){
                    mod_content.item(0).className += ' map_agreements';
                }

                jQuery('#modalHeader_agreements').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal_agreements').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.addagreements', function (e) {
        e.preventDefault();
        var model_el = document.getElementById('mymodal_additional');
        var bclose = model_el.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");
        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal_additional .modal-body').html(data);
                jQuery('#mymodal_additional').modal('show');


                var mod_content = model_el.getElementsByClassName('modal-content');
                var agreement_view = model_el.getElementsByClassName('additional-agreements-view');
                if(agreement_view.item(0).className === "additional-agreements-view"){
                    mod_content.item(0).className += ' map_additonal';
                }

                jQuery('#modalHeader_additional').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal_additional').removeAttr('tabindex');
            }
        });
        return false;
    });

    jQuery(document).on('click', '.additional-block', function (e) {
        e.preventDefault();
        var model_el = document.getElementById('mymodal_child');
        var bclose_add = model_el.querySelector('.btn-close');
        bclose_add.className += ' order1';

        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");
        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('block-title');

        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal_child .modal-body').html(data);
                jQuery('#mymodal_child').modal('show');

                var model_el = document.getElementById('mymodal_child');
                var mod_content = model_el.getElementsByClassName('modal-content');
                var agreement_view = model_el.getElementsByClassName('additional-agreements-view');
                if(agreement_view.item(0).className === "additional-agreements-view"){
                    mod_content.item(0).className += ' map_child';
                }

                jQuery('#modalHeader_child').append('<h4 class="block_title">' + _title + '</h4>');
                jQuery('#mymodal_child').removeAttr('tabindex');
            }
        });
        return false;
    });




    jQuery(document).on('click', '.plans', function (e) {
        e.preventDefault();
        var model_el = document.getElementById('mymodal_calendar');
        var bclose = model_el.querySelector('.btn-close');
        bclose.className += ' order';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal_calendar .modal-body').html(data);
                jQuery('#mymodal_calendar').modal('show');

                var mod_content = model_el.getElementsByClassName('modal-content');
                var agreement_view = model_el.getElementsByClassName('calendar-plans-view');
                if(agreement_view.item(0).className === "calendar-plans-view"){
                    mod_content.item(0).className += ' map_plans';
                }

                jQuery('#modalHeader_calendar').append('<h4 class="_title">' + _title + '</h4>');
                jQuery('#mymodal_calendar').removeAttr('tabindex');
            }
        });
        return false;
    });


    jQuery(document).on('click', '.plans_block', function (e) {
        e.preventDefault();
        var model_el = document.getElementById('mymodal_child');
        var bclose_plan = model_el.querySelector('.btn-close');
        console.log(model_el);
        bclose_plan.className += ' order1';
        jQuery("tr.last-record").removeClass("last-record");
        var _tr = jQuery(this).closest('tr');
        _tr.addClass("last-record");

        var _url = jQuery(this).closest('a').data('url')
        var _title = jQuery(this).closest('a').data('block-title');
        jQuery.ajax({
            type: "GET",
            url:_url,
            error: function (xhr, status, error) {
                alertModal(xhr.responseText, "Предупреждение");
            },
            success: function (data) {
                jQuery('#mymodal_child .modal-body').html(data);
                jQuery('#mymodal_child').modal('show');

                var mod_content = model_el.getElementsByClassName('modal-content');
                var agreement_view = model_el.getElementsByClassName('calendar-plans-view');
                if(agreement_view.item(0).className === "calendar-plans-view"){
                    mod_content.item(0).className += ' map_child';
                }
                jQuery('#modalHeader_child').append('<h4 class="block-title">' + _title + '</h4>');
                jQuery('#mymodal_child').removeAttr('tabindex');
            }
        });
        return false;
    });


// удаление выбранной записи с помощью pjax
    jQuery(document).on('click', '.ajaxDelete', function (e) {
        e.preventDefault();
        var deleteUrl = jQuery(this).attr('delete-url');
        var pjaxContainer = jQuery(this).attr('pjax-container');
        var _title = "Предупреждение";

        confirmModal('Вы действительно хотите удалить элемент?', _title, function (confirm) {
            if (confirm) {
                jQuery.ajax({
                    url: deleteUrl,
                    type: 'POSt',
                }).done(function (data) {
                    jQuery.pjax.reload({container: '#' + jQuery.trim(pjaxContainer), async: false});
                    if (pjaxContainer == 'list') {
                        jQuery.pjax.reload({container: '#request-work'});
                    }
                });
                return false;
            } else {
                return false;
            }
        });
        return false;
    });

    function alertModal(message, title) {
        if (!message.includes("h3")) {
            message = "<h3>" + message + "</h3>";
        }
        jQuery('#mymodalmessage .modal-body').html(message);
        jQuery("#mymodalmessage #modalHeader div").remove();
        jQuery("#messageHeader h4").replaceWith(function () {
            return "<h4>" + title + "</h4>";
        });

        jQuery('#mymodalmessage').modal('show');
    }

    function confirmModal(message, title, callback) {
        var confirmIndex = true;
        jQuery('#modal-confirm .modal-body .message').html("<h3>" + message + "</h3>");
        jQuery('#modal-confirm #messageHeader h4').remove();
        jQuery('#modal-confirm #messageHeader').prepend("<h4 class='warming'>" + title + "</h4>");

        jQuery('#modal-confirm').modal('show');

        jQuery('#confirm_cancle').on("click", function (event) {
            event.preventDefault();
            if (confirmIndex) {
                callback(false);
                jQuery('#modal-confirm').modal('hide');
                confirmIndex = false;
            }
        });

        jQuery('#confirm_ok').on("click", function (event) {
            event.preventDefault();
            if (confirmIndex) {
                callback(true);
                jQuery('#modal-confirm').modal('hide');
                confirmIndex = false;
            }
        });

        jQuery('#modal-confirm .close').on("click", function (event) {
            event.preventDefault();
            if (confirmIndex) {
                callback(false);
                jQuery('#modal-confirm').modal('hide');
                confirmIndex = false;
            }
        });
    };

    jQuery("#mymodal").on("beforeSubmit", "form", function (event) {
        const form = jQuery(this);
        console.log(form);
        var _tr_key = jQuery("tr.last-record").data("key");
        jQuery.ajax({
            type: "POST",
            url: form.attr("action"),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            cache: false,
            ifModified: false,
            error: function (xhr, status, error) {
                alert('There was an error with your request.'
                    + xhr.responseText);
            },
            success: function (message) {
                if(message){
                    jQuery("div.modal-body", "#mymodal").html(message);
                    return;
                }
                jQuery("#mymodal").modal("hide");
                var pjaxContainer = form.attr('pjax-container');
                jQuery.pjax.reload({container: '#' + jQuery.trim(pjaxContainer), async: false});

                var _str = '[data-key="'+ _tr_key+'"]';
                jQuery(_str).addClass("last-record");
            }
        });
        return false;
    });

    jQuery("#mymodal_child").on("beforeSubmit", "form", function (event) {
        const form = jQuery(this);
        console.log(form);
        var _tr_key = jQuery("tr.last-record").data("key");
        jQuery.ajax({
            type: "POST",
            url: form.attr("action"),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            cache: false,
            ifModified: false,
            error: function (xhr, status, error) {
                alert('There was an error with your request.'
                    + xhr.responseText);
            },
            success: function (message) {
                if(message){
                    jQuery("div.modal-body", "#mymodal_child").html(message);
                    return;
                }
                jQuery("#mymodal_child").modal("hide");
                var pjaxContainer = form.attr('pjax-container');
                jQuery.pjax.reload({container: '#' + jQuery.trim(pjaxContainer), async: false});

                var _str = '[data-key="'+ _tr_key+'"]';
                jQuery(_str).addClass("last-record");
            }
        });
        return false;
    });

    jQuery("#mymodal_agreements").on("beforeSubmit", "form", function (event) {
        const form = jQuery(this);
        console.log(form);
        var _tr_key = jQuery("tr.last-record").data("key");
        jQuery.ajax({
            type: "POST",
            url: form.attr("action"),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            cache: false,
            ifModified: false,
            error: function (xhr, status, error) {
                alert('There was an error with your request.'
                    + xhr.responseText);
            },
            success: function (message) {
                if(message){
                    jQuery("div.modal-body", "#mymodal_agreements").html(message);
                    return;
                }
                jQuery("#mymodal_agreements").modal("hide");
                var pjaxContainer = form.attr('pjax-container');
                jQuery.pjax.reload({container: '#' + jQuery.trim(pjaxContainer), async: false});

                var _str = '[data-key="'+ _tr_key+'"]';
                jQuery(_str).addClass("last-record");
            }
        });
        return false;
    });

    function removeDuplicates(ref, elements = ref) {
        if (ref = document.querySelector(ref)) {
            const txt = ref.textContent.trim().toLowerCase();
            for (let el of document.querySelectorAll(elements)) {
                if (el !== ref && el.textContent.trim().toLowerCase() === txt)
                    el.remove();
            }
        }
        return true;
    }



    function matchCustom(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
            return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.indexOf(params.term) > -1) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.text += ' (matched)';

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }


});

