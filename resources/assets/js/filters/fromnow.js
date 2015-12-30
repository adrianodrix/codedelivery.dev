'use strict';

/* Filters */
// need load the moment.js to use this filter. 
angular.module('app')
  .filter('fromNow', function() {
    return function(date) {
        moment.locale('pt-br');
        return moment(date).fromNow();
    }
  });
