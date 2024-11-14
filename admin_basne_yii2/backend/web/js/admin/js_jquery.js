jQuery.noConflict();

jQuery(document).ready(function() {
    jQuery('#icon li.menu_block').click(function() {
        jQuery(this).find('ul.submenu').toggle();
    });
    jQuery.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: 'MM',
            nextText: 'MM',
            navigationAsDateFormat: true,
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false
    };
    jQuery.datepicker.setDefaults(jQuery.datepicker.regional['ru']); 
    jQuery('.date_picker').each(function(){
        jQuery(this).datepicker({
            showAnim: "drop",
            dateFormat: "yy-mm-dd",
            showOn: "both",
            buttonImage: "/images/calendar.gif",
            buttonImageOnly: true,
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
        });
    });
    jQuery('.from').each(function(){
        jQuery(this).datepicker({
            showAnim: "drop",
            dateFormat: "yy-mm-dd",
            showOn: "both",
            buttonImage: "/images/calendar.gif",
            buttonImageOnly: true,
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            onClose: function( selectedDate ) {
                jQuery('.to').datepicker( "option", "minDate", selectedDate );
            }
        });
    });
    jQuery('.to').each(function(){
        jQuery(this).datepicker({
            showAnim: "drop",
            dateFormat: "yy-mm-dd",
            showOn: "both",
            buttonImage: "/images/calendar.gif",
            buttonImageOnly: true,
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            onClose: function( selectedDate ) {
                jQuery( ".from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
    
    jQuery('.new-pass').dialog({
        modal: true,
        autoOpen: true,
        draggable: false,
        resizable: false,
        position: ['center'],
        show: {
            effect: "fade",
            duration: 500
            },
        width: 500,
        zIndex: 100000,
        dialogClass: 'ui-dialog-osx',
        buttons: {
            "Закрыть": function() { 
                jQuery(this).dialog("close"); 
                location.replace(BASE_URL + '/admin/congressparticipant/index/'); 
            }
        }
    });
    jQuery('.new-pass7').dialog({
        modal: true,
        autoOpen: true,
        draggable: false,
        resizable: false,
        position: ['center'],
        show: {
            effect: "fade",
            duration: 500
            },
        width: 500,
        zIndex: 100000,
        dialogClass: 'ui-dialog-osx',
        buttons: {
            "Закрыть": function() { 
                jQuery(this).dialog("close"); 
                location.replace(BASE_URL + '/admin/congressparticipant7/index/'); 
            }
        }
    });
    jQuery(".ui-dialog-titlebar").hide();
    jQuery(".ui-dialog-titlebar-close").hide(); 
});