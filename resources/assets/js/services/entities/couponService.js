'use strict';

angular.module('app')
    .service('coupon', ['$resource', 'config',
    function($resource, config){
        return $resource(config.baseUrl + '/admin/coupon/:id', {id: '@id'},{
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