
            var webPage = require('webpage');
            var page = webPage.create();

            phantom.addCookie({
                'name'     : '_veracross_session',
                'value'    : 'eHZXZ0g2dGxCbG1BaDZ5elNNUGgxenJYTTlxOFJoUFpETGV4QXlVaVJYcE5PZXJYL2FwSlBWMGdJcG00Vno5bHEyZ2t2U1VvNjlYaW5SMTVzUThsb3ViVytpaVo2TlAvbmU5bko3d25PY2VOK0FndGNyaUw5NHFadHNrdFZ3Rnkvd1NCQ0ZVRVh0SDdJc3p3S2tucjJBdVlUWm0rTG9Yd2R1U2pDYVZYWWl6MVhhV01EMzRucFhjVGJkRUorQVAra2lQS0RwZzhwWDZGcGZHbng4VWdNM1M3WHBJQnREQkhHQTJzcDVBS2QzRT0tLXFOTmViS2NOaStZcmlKeEZvMnhFTmc9PQ%3D%3D--ff0dac0f9ed3c8b8aa63617797154d89c8d3a0bb',
                'domain'   : '.veracross.com',
                'path'     : '/',           
                'httponly' : true,
                'secure'   : true,
                'expires'  : (new Date()).getTime() + (1000 * 60 * 60)
            });

            page.open('https://portals-app.veracross.com/pinewood/student/classes/72649', function(status) {
                var content = page.content;
                console.log(content);
                phantom.exit();
            });
            