define ['jquery', 'knockout', 'jquery.fileupload', 'humanize'], ($, ko, jf, humanize) ->
  ->
    # ViewModel definitions
    UploadViewModel = ->
      self = @
      @entries = ko.observableArray()
      @cancel = (entry) ->
        if entry.jqXHR
          entry.jqXHR.abort()
          entry.status 'cancelled'
      return

    FileViewModel = (file) ->
      self = @
      @filename = file.name
      @size = humanize.filesize file.size
      @status = ko.observable('pending')
      @progress = ko.observable(0)
      @progressPercent = ko.computed(->
        return '100%' if self.status isnt 'working'
        "#{self.progress()}%"
      )
      return

    $(->
      uploadViewModel = new UploadViewModel()
      $('#fileupload').fileupload
        basic: true
        maxNumberOfFiles: 1
        dataType: 'json'
        add: (e, data) ->
          file = data.files[0]
          entry = new FileViewModel(file)
          uploadViewModel.entries.push entry
          data.context = entry
          entry.jqXHR = data.submit()
          entry.status 'working'

        progress: (e, data) ->
          progress = parseInt(data.loaded / data.total * 100, 10)
          data.context.progress(progress)

        done: (e, data) ->
          data.context.status 'success'

        fail: (e, data) ->
          data.context.status 'error'

      ko.applyBindings uploadViewModel
    )

    return




