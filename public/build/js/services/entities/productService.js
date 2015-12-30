'use strict';

angular.module('app')
    .service('product', ['$resource', 'config',
    function($resource, config){
        return $resource(config.baseUrl + '/admin/product/:id', {id: '@id'},{
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