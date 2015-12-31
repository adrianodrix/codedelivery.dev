'use strict';

angular.module('app')
    .service('client', ['$resource', 'config',
    function($resource, config){
        return $resource(config.baseUrl + '/admin/client/:id', {id: '@id'},{
            update: {
                method: 'PUT'
            },
            query: {
                isArray: false,
            },
            search: {
                method:'GET',
                isArray:false
            },
        });
    }]);