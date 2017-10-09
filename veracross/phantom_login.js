
   var webPage = require('webpage');
   var page = webPage.create();
   var postData = 'utf8=%E2%9C%93&authenticity_token=&account=eyJwZXJzb25faWQiOjEzNjYsInVzZXJuYW1lIjoiYWxleC5kYWdtYW4iLCJkaXNwbGF5X3VzZXJuYW1lIjoiYWxleC5kYWdtYW4iLCJpbXBlcnNvbmF0b3IiOm51bGwsImlzX2JyZXVlciI6ZmFsc2UsImlzX2ltcGVyc29uYXRpbmciOmZhbHNlLCJpc19kYXRhYmFzZV91c2VyIjpmYWxzZSwiY2FuX2ltcGVyc29uYXRlIjpmYWxzZSwic2VjdXJpdHlfcm9sZXMiOiJTdHVkZW50Iiwic3RhdHVzIjoxLCJzdWNjZXNzIjp0cnVlLCJtZXNzYWdlIjoiU3VjY2VzcyIsInBhc3N3b3JkX3N5bmNpbmdfZW5hYmxlZCI6ZmFsc2UsImxvZ2luX2xvZ19pZCI6MTUyODI1MSwiY29ubmVjdGlvbl9pZCI6ImYyMzljZTliLTdlMDItNDM3MC04OTRlLTBhMzFkOTgzNDQ1NCIsImV4cGlyZXMiOiIyMDE3LTEwLTAxVDIzOjQwOjM1KzAwOjAwIiwiaG1hYyI6ImYwMzYzY2YyZjZkYjcwMDI5YjFjMWYxYzhkYTM3ZWNlYTAyN2Q5NmUifQ==;'

   phantom.addCookie()

   page.open('https://portals.veracross.com/pinewood/session', 'POST', postData,  function(status) {
       var content = page.content;
       console.log(content);
       phantom.exit();
   });
   