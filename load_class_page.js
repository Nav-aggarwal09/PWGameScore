
            var webPage = require('webpage');
            var page = webPage.create();

            phantom.addCookie({
                'name'     : '_veracross_session',
                'value'    : 'd3AvcWFSY3hQR2FkcFYzaXFwQXY0dHR1eVRPWkdLMEQyYUhMMkg1VWh3WFhsaUJEcWxYS1p5MlFhVkRYZFVoc3J2WUFsN3g4NmdZbTYwSVNYdDhLVzYyaDRYcnhiNnVHbzBGTVJZME9qZVRTaksrQkZXRDFrbmxNV1RxTHp3dExnNlgrMm1rOG4zbE45RlpKVUJOckREZDNqalF5RTNtYzc0dDJxNG53V3RoQWlpQmNaMjhBTW5OaWdnOGVxREFDVDR2YkZDeGl6cnlQcG0rK3VHTVU0L2RwTjRydTNpSUdjald6RHZsY2lwYz0tLVJ3cUhFY01pWHgyNFpFMEJCWjdiSVE9PQ%3D%3D--73e5d54d6d563bea6f5794b48a4e30576e4662d4',
                'domain'   : '.veracross.com',
                'path'     : '/',           
                'httponly' : true,
                'secure'   : true,
                'expires'  : (new Date()).getTime() + (1000 * 60 * 60)
            });

            page.open('https://portals-app.veracross.com/pinewood/student/classes/72564', function(status) {
                var content = page.content;
                console.log(content);
                phantom.exit();
            });
            