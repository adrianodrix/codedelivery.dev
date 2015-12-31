'use strict';

angular.module('app')
    .service('user', ['$resource', 'config',
    function($resource, config){
        return $resource(config.baseUrl + '/user', {},{
            authenticated: {
                url: config.baseUrl + '/user/authenticated',
                method: 'GET'
            },
            forgotPassword: {
                url: config.baseUrl + '/user/forgot-password',
                method: 'POST'
            },
            search: {
                url: config.baseUrl + '/user/search',
                method:'GET',
                isArray:false
            },
        });
    }]);
