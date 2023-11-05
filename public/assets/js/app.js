((JQuery) => {
    'use strict'
    $('.navbar-nav li a').on('click', (event) => {
        event.preventDefault();
        let href = event.target.href;
        let targetNode = $('#app-workspace');
        let segments = href.split('/');
        let logout = segments.find((value, index) => {
            if (value === 'logout') {
                return true;
            }
            return false;
        });
        $.ajax({
            async: true,
            url: href,
            dataType: 'html',
            success: (data, textStatus, xhr) => {
                let headers = xhr.getAllResponseHeaders();
                targetNode.html(data);
                if (logout) {
                    window.location = '/';
                }
            }
        });
    });
    $('#app-workspace').on('click', '#auto-manager-sidebar > a', (event) => {
        //alert('found');
        event.preventDefault();
        let href = event.target.href;
        let targetNode = $('#manager-form');
        let segments = href.split('/');
        // let logout = segments.find((value, index) => {
        //     if (value === 'logout') {
        //         return true;
        //     }
        //     return false;
        // });
        $.ajax({
            async: true,
            url: href,
            dataType: 'html',
            success: (data, textStatus, xhr) => {
                let headers = xhr.getAllResponseHeaders();
                targetNode.html(data);
                // if (logout) {
                //     window.location = '/';
                // }
            }
        });
    });
    // attach a .on to the app-workspace so we can listen for the submit
    $('#app-workspace').on('submit', function(event) {
        //alert('found');
        event.preventDefault();
        let form    = $(event.target);
        let href    = $(form).attr('action');
        // refactor this to use a static id for the target node
        let domTrgt = $(form).attr('id');
        let d       = $(form).serialize();
        let p       = $(form).attr('method');
        let request = $.ajax({
            url: href,
            method: p,
            data: d
        });
        request.done(function(response, textStatus, jqXHR) {
            $('#manager-form').html(response);
        });
        request.fail(function() {
        });
        request.always(function() {
            //console.log(request.getResponseHeader('systemMessage'));
            if (request.getResponseHeader('successMessage') !== null) {
                $.publish(
                    'system/message',
                    ['success', request.getResponseHeader('successMessage')]
                );
            } else if (request.getResponseHeader('exceptionMessage') !== null) {
                $.publish(
                    'system/message',
                    ['danger', request.getResponseHeader('exceptionMessage')]
                );
            }
        });
    });
})();