'use strict';

angular.module('app')
    .service('order', ['$resource', 'config',
    function($resource, config){
        return $resource(config.baseUrl + '/admin/order/:id', {id: '@id'},{
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