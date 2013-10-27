// Generated by CoffeeScript 1.6.3
(function() {
  define(['jquery', 'knockout', 'jquery.fileupload'], function($, ko, jf) {
    return function() {
      return $('#fileupload').fileupload({
        basic: true,
        maxNumberOfFiles: 1,
        dataType: 'json',
        done: function(e, data) {
          return $.each(data.files, function(index, file) {
            return console.log(file.name);
          });
        }
      });
    };
  });

}).call(this);
