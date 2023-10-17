@if(Session::has('success'))
    <script src="plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script>
        // Bootstrap Notify Generator
        $(document).ready(function() {
            var content = {},
                elemURL = false,
                elemSpacing = 10,
                elemOffsetX = 30,
                elemOffsetY = 30,
                elemMouseOver = true,
                elemType = 'success',
                elemAllowDismiss = true,
                elemTimer = 2000,
                elemNewestOnTop = true,
                elemPorgressBar = false,
                elemDelay = 1000,
                elemZindex = 10000,
                elemAnimateEnter = 'animate__fadeInDown',
                elemAnimateExit = 'animate__fadeOutDown';
            content.message = '{{ Session::get('success') }}';
            content.title = '¡Operación éxitosa!';
            content.icon = '';
            var notify = $.notify(content, {
                spacing: 10,
                mouse_over: true,
                type: 'success',
                allow_dismiss: true,
                timer: 2000,
                newest_on_top: true,
                showProgressbar: false,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                template: '<div data-notify="container" class="bootstrap-notify col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                    '<div class="p-progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>',
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animate__animated ' + 'animate__fadeInDown',
                    exit: 'animate__animated ' + 'animate__fadeOutDown'
                }
            });
        });
    </script>
@endif

@if(Session::has('error'))
    <script src="plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script>
        // Bootstrap Notify Generator
        $(document).ready(function() {
            var content = {},
                elemURL = false,
                elemSpacing = 10,
                elemOffsetX = 30,
                elemOffsetY = 30,
                elemMouseOver = true,
                elemType = 'danger',
                elemAllowDismiss = true,
                elemTimer = 2000,
                elemNewestOnTop = true,
                elemPorgressBar = false,
                elemDelay = 1000,
                elemZindex = 10000,
                elemAnimateEnter = 'animate__fadeInDown',
                elemAnimateExit = 'animate__fadeOutDown';
            content.message = '{{ Session::get('success') }}';
            content.title = '¡Operación éxitosa!';
            content.icon = '';
            var notify = $.notify(content, {
                spacing: 10,
                mouse_over: true,
                type: 'success',
                allow_dismiss: true,
                timer: 2000,
                newest_on_top: true,
                showProgressbar: false,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                template: '<div data-notify="container" class="bootstrap-notify col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                    '<div class="p-progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>',
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animate__animated ' + 'animate__fadeInDown',
                    exit: 'animate__animated ' + 'animate__fadeOutDown'
                }
            });
        });
    </script>
@endif