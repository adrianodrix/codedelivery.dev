'use strict';

angular.module('app')
    .service('category', ['$resource', 'config',
    function($resource, config){
        return $resource(config.baseUrl + '/admin/category/:id', {id: '@id'},{
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