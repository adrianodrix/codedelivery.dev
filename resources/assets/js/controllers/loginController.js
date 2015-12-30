'use strict';

angular.module('app')
    .controller('loginController',
        [       '$rootScope', '$scope', '$location', '$cookies', '$mdDialog', 'OAuth', 'user',
        function($rootScope,   $scope,   $location,   $cookies,   $mdDialog,   OAuth,   user){
            $scope.isDisabled = false;

            $scope.user = {
                username: '',
                password: '',
                email:    '',
                name:     '',
            };

            $scope.login = function () {
                $scope.isDisabled = true;
                if ($scope.form.$valid) {
                    OAuth.getAccessToken($scope.user).then(function(){
                            user.authenticated({}, {}, function(data){
                                $cookies.putObject('user', data);
                                $rootScope.userActive = data;
                                $location.path('/dashboard');
                            });
                        },
                        function(){
                            $mdDialog
                                .show( $mdDialog.alert({
                                    title: 'Woops!',
                                    content: 'Acesso negado. Email e/ou senha estão inválidos!',
                                    ok: 'Ok'
                                }) );
                        }
                    );
                };
                $scope.isDisabled = false;
            };

            $scope.register = function() {
                $scope.isDisabled = true;
                if ($scope.form.$valid) {
                    var userService = new user();

                    userService.name     = $scope.user.name;
                    userService.email    = $scope.user.email;
                    userService.password = $scope.user.password;

                    userService.$save(
                        function(data){
                            $scope.user = {
                                username: data.email,
                                password: $scope.user.password,
                            };
                            $scope.login();
                        },
                        function(error){
                            var errorMsg = '<ul>';
                            angular.forEach(error.data.message, function(o1) {
                                angular.forEach(o1, function(o2) {
                                    errorMsg = errorMsg.concat('<li>');
                                    errorMsg = errorMsg.concat(o2);
                                    errorMsg = errorMsg.concat('</li>');
                                });
                            });
                            errorMsg = errorMsg.concat('</ul>');
                            $mdDialog
                                .show( $mdDialog.alert({
                                    title: 'Woops!',
                                    content: errorMsg,
                                    ok: 'Ok'
                                }) );
                        }
                    );
                };
                $scope.isDisabled = false;
            };

            $scope.forgotPassword = function(){
                user.forgotPassword($scope.user, {}, function(data){
                    $location.path('/conta/entrar');
                }, function(error){
                    $mdDialog
                        .show( $mdDialog.alert({
                            title: 'Woops!',
                            content: error.data.message,
                            ok: 'Ok'
                        }) );
                });
            };
        }]);
