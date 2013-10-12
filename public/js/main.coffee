requirejs.config({
  baseUrl: 'js'
  paths: {
    jquery: '../packages/jquery/jquery.min'
    bootstrap: '../packages/bootstrap/dist/js/bootstrap.min'
  },
  shim: {
    'bootstrap': ['jquery']
  }
})

deps = ['require', 'jquery', 'bootstrap']
requirejs(deps, (require) ->
  'use strict'
  $ = require('jquery')
)