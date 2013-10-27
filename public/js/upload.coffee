define ['jquery', 'knockout', 'jquery.fileupload'], ($, ko, jf) ->
  ->
    $('#fileupload').fileupload
      basic: true
      maxNumberOfFiles: 1
      dataType: 'json'
      done: (e, data) ->
        $.each(data.files, (index, file) ->
          console.log file.name
        )


