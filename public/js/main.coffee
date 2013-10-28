requirejs.config({
  baseUrl: window.jsBase
  paths: {
    jquery: '../packages/jquery/jquery.min'
    bootstrap: '../packages/bootstrap/dist/js/bootstrap.min'
    knockout: 'vendor/knockoutjs/knockout-3.0.0'
    'jquery.ui.widget': '../packages/jquery-file-upload/js/vendor/jquery.ui.widget'
    'jquery.iframe.transport': '../packages/jquery-file-upload/js/jquery.iframe-transport'
    'jquery.fileupload': '../packages/jquery-file-upload/js/jquery.fileupload'
    humanize: '../packages/humanize/humanize'
  },
  shim: {
    'bootstrap': ['jquery']
    'jquery.fileupload': ['jquery', 'jquery.ui.widget', 'jquery.iframe.transport']
  }
})