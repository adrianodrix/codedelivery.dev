'use strict';

/**
 * @ngdoc function
 * @name app.config:uiRouter
 * @description
 * # Config
 * Config for the router
 */
angular.module('app')
  .run(
    [           '$rootScope', '$state', '$stateParams',
      function ( $rootScope,   $state,   $stateParams ) {
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;
      }
    ]
  )
  .config(
    [          '$stateProvider', '$urlRouterProvider', 'MODULE_CONFIG',
      function ( $stateProvider,   $urlRouterProvider,  MODULE_CONFIG ) {

          $urlRouterProvider.otherwise('/404');

          $stateProvider
              .state('app', {
                  abstract: true,
                  url: '',
                  views: {
                      '': {
                          templateUrl: '/build/html/layout.html'
                      },
                      'aside': {
                          templateUrl: '/build/html/aside.html'
                      },
                      'content': {
                          templateUrl: '/build/html/content.html'
                      }
                  }
              })
              .state('app.dashboard', {
                  url: '/dashboard',
                  templateUrl: '/build/html/pages/dashboard.html',
                  data : { title: 'Dashboard', folded: true },
                  //resolve: load(['scripts/controllers/chart.js','scripts/controllers/vectormap.js'])
              })
              .state('app.categories', {
                  url: '/categorias',
                  templateUrl: '/build/html/pages/categories/index.html',
                  controller: 'categoryController',
                  data : { title: 'Categorias', folded: true },
              })
              .state('app.products', {
                  url: '/produtos',
                  templateUrl: '/build/html/pages/products/index.html',
                  controller: 'productController',
                  data : { title: 'Produtos', folded: true },
                  resolve: load(['build/js/filters/fromnow.js', 'moment', 'pagination'])
              })
              .state('app.clients', {
                  url: '/clientes',
                  templateUrl: '/build/html/pages/clients/index.html',
                  controller: 'clientController',
                  data : { title: 'Clientes', folded: true },
                  resolve: load(['build/js/filters/fromnow.js', 'moment', 'pagination'])
              })
              //Account
              .state('access', {
                  url: '/conta',
                  template: '<div class="indigo bg-big"><div ui-view class="fade-in-down smooth"></div></div>'
              })
              .state('access.signin', {
                  url: '/entrar',
                  templateUrl: '/build/html/pages/signin.html',
                  controller: 'loginController',
              })
              .state('access.signup', {
                  url: '/cadastre-se',
                  templateUrl: '/build/html/pages/signup.html',
                  controller: 'loginController',
              })
              .state('access.forgot-password', {
                  url: '/lembrar-senha',
                  templateUrl: '/build/html/pages/forgot-password.html',
                  controller: 'loginController',
              })
              //Errors
              .state('404', {
                  url: '/404',
                  templateUrl: '/build/html/pages/404.html'
              })
              .state('505', {
                  url: '/505',
                  templateUrl: '/build/html/pages/505.html'
              })
          ;

          function load(srcs, callback) {
            return {
                deps: ['$ocLazyLoad', '$q',
                  function( $ocLazyLoad, $q ){
                    var deferred = $q.defer();
                    var promise  = false;
                    srcs = angular.isArray(srcs) ? srcs : srcs.split(/\s+/);
                    if(!promise){
                      promise = deferred.promise;
                    }
                    angular.forEach(srcs, function(src) {
                      promise = promise.then( function(){
                        angular.forEach(MODULE_CONFIG, function(module) {
                          if( module.name == src){
                            if(!module.module){
                              name = module.files;
                            }else{
                              name = module.name;
                            }
                          }else{
                            name = src;
                          }
                        });
                        return $ocLazyLoad.load(name);
                      } );
                    });
                    deferred.resolve();
                    return callback ? promise.then(function(){ return callback(); }) : promise;
                }]
            }
          }
      }
    ]
  );
