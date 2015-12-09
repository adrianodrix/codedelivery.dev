'use strict';
var app =
    angular.module('app')
    .config(
        [        '$controllerProvider', '$compileProvider', '$filterProvider', '$provide',
            function ($controllerProvider,   $compileProvider,   $filterProvider,   $provide) {

                // lazy controller, directive and service
                app.controller = $controllerProvider.register;
                app.directive  = $compileProvider.directive;
                app.filter     = $filterProvider.register;
                app.factory    = $provide.factory;
                app.service    = $provide.service;
                app.constant   = $provide.constant;
                app.value      = $provide.value;
            }
        ]);

angular.module('app')
    .config(
    ['$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'configProvider',
        function($httpProvider, OAuthProvider, OAuthTokenProvider, configProvider){
            $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
            $httpProvider.defaults.headers.put['Content-Type']  = 'application/x-www-form-urlencoded;charset=utf-8';

            $httpProvider.defaults.transformResponse = configProvider.config.utils.transformReponse;
            $httpProvider.defaults.transformRequest = configProvider.config.utils.transformRequest;

            OAuthProvider.configure({
                baseUrl: configProvider.config.domain,
                clientId: 'appid1',
                clientSecret: 'secret',
                grantPath: '/oauth/access_token',
            });

            OAuthTokenProvider.configure({
                name: 'token',
                options: {
                    secure: false
                }
            });

        }]);

angular.module('app')
    .provider('config', ['$httpParamSerializerProvider', function($httpParamSerializerProvider){
        var config = {
            baseUrl: 'http://codedelivery.dev/api/v1',
            domain: 'http://codedelivery.dev',
            user: {},
            utils: {
                transformRequest: function(data){
                    if(angular.isObject(data)){
                        return $httpParamSerializerProvider.$get()(data);
                    }
                    return data;
                },
                transformReponse: function(data, headers){
                    var headersGetter = headers();
                    if(headersGetter['content-type'] == 'application/json' ||
                        headersGetter['content-type'] == 'text/json'){
                        var dataJson = JSON.parse(data);
                        if(dataJson.hasOwnProperty('data')  && Object.keys(dataJson).length == 1){
                            dataJson = dataJson.data;
                        }
                        return dataJson;
                    }
                    return data;
                }
            },
        };

        return {
            config: config,
            $get: function(){
                return config;
            }
        }
    }]);