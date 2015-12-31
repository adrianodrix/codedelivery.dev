'use strict';

angular.module('app')
    .controller('clientController',
        [       '$rootScope', '$scope', '$location', '$cookies', '$mdDialog', 'OAuth', 'client',
        function($rootScope,   $scope,   $location,   $cookies,   $mdDialog,   OAuth,   client){

            $scope.totalClients = 0;
            $scope.clientsPerPage = 5;
            $scope.isDisabled = false;
            $scope.clients = [];

            $scope.client = {
                name: '',
            };

            $scope.pagination = {
                current: 1
            };

            function getAll(pageNumber){
                if (!pageNumber){
                    pageNumber = $scope.pagination.current;
                };
                client.query({
                    page: pageNumber,
                    limit: $scope.clientsPerPage,
            }, function(result){
                    $scope.clients = result.data;
                    $scope.totalClients = result.meta.pagination.total;
                });
            };

            $scope.pageChanged = function(newPage) {
                getAll(newPage);
            };

            $scope.update = function(obj, ev) {
                var reg         = new Object();
                reg.id          = obj.id;
                reg.user        = (typeof obj.user != 'undefined') ? obj.user.data : null;
                reg.address = obj.address;
                reg.phone = obj.phone;
                reg.city = obj.city;
                reg.state = obj.state;
                reg.postcode = obj.postcode;

                $mdDialog.show({
                        templateUrl: '/build/html/pages/clients/form.tmpl.html',
                        controller: DialogControllerClient,
                        targetEvent: ev,
                        locals: {
                            obj: reg,
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            client.update(data)
                                .$promise
                                .then(
                                    function () {
                                        getAll();
                                    },
                                    function(error){
                                        showError(error.data.message);
                                    });
                        };
                    }, function() {
                        console.log('You cancelled the dialog.');
                    });
            };

            $scope.new = function(ev) {
                $mdDialog.show({
                        templateUrl: '/build/html/pages/clients/form.tmpl.html',
                        controller: DialogControllerClient,
                        targetEvent: ev,
                        locals: {
                            obj: {},
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            client.save(data)
                                .$promise
                                .then(
                                    function (data) {
                                        getAll();
                                },
                                    function(error){
                                        showError(error.data.message);
                                    });
                        };
                    }, function() {
                        console.log('You cancelled the dialog.');
                    });
            };

            $scope.delete = function(obj) {
                var confirm = $mdDialog.confirm()
                    .title('Pense bem!')
                    .content('Você deseja realmente excluir este registro?')
                    .ok('Sim!')
                    .cancel('Ops! Não');
                $mdDialog.show(confirm).then(function() {
                    client.delete({id: obj.id})
                        .$promise
                        .then(function(){
                            getAll();
                        });
                });
            };

            function showError(error){
                if( typeof error != 'string') {
                    var errorMsg = '<ul>';
                    angular.forEach(error, function(o1) {
                        angular.forEach(o1, function(o2) {
                            errorMsg = errorMsg.concat('<li>');
                            errorMsg = errorMsg.concat(o2);
                            errorMsg = errorMsg.concat('</li>');
                        });
                    });
                    errorMsg = errorMsg.concat('</ul>');
                } else {
                    errorMsg = error;
                }

                $mdDialog
                    .show( $mdDialog.alert({
                        title: 'Woops!',
                        content: errorMsg,
                        ok: 'Ok'
                    }) );
            };

            getAll(1);
        }]);

function DialogControllerClient($scope, $mdDialog, $q, user, obj) {
    $scope.client       = obj;
    $scope.selectedItem  = obj.user;
    $scope.searchText    = null;

    $scope.setUser = function(user){
        if (!user) {
            return;
        } else {
            $scope.client.user_id = user.id;
        }
    };

    $scope.getUsers = function (name){
        var deffered = $q.defer();
        user.search({
                search: name,
                searchFields: 'name:like',
                limit:10,
            },
            function(data){
                deffered.resolve(data.data);
            },
            function(error){
                deffered.reject(error);
            }
        );

        return deffered.promise;
    };

    $scope.hide = function() {
        $mdDialog.hide();
    };
    $scope.cancel = function() {
        $mdDialog.cancel();
    };
    $scope.save = function(answer) {
        $mdDialog.hide(answer);
    };
};