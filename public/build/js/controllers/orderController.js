'use strict';

angular.module('app')
    .controller('orderController',
        [       '$rootScope', '$scope', '$location', '$cookies', '$mdDialog', 'OAuth', 'order',
        function($rootScope,   $scope,   $location,   $cookies,   $mdDialog,   OAuth,   order){

            $scope.totalorders = 0;
            $scope.ordersPerPage = 5;
            $scope.isDisabled = false;
            $scope.orders = [];

            $scope.order = {
                name: '',
            };

            $scope.pagination = {
                current: 1
            };

            function getAll(pageNumber){
                if (!pageNumber){
                    pageNumber = $scope.pagination.current;
                };
                order.query({
                    page: pageNumber,
                    limit: $scope.ordersPerPage,
            }, function(result){
                    $scope.orders = result.data;
                    $scope.totalorders = result.meta.pagination.total;
                });
            };

            $scope.pageChanged = function(newPage) {
                getAll(newPage);
            };

            $scope.update = function(obj, ev) {
                var reg         = new Object();
                reg.id          = obj.id;
                reg.deliveryMan = (typeof obj.deliveryMan != 'undefined') ? obj.deliveryMan.data : null;
                reg.client = (typeof obj.client != 'undefined') ? obj.client.data : null;
                reg.total = obj.total;
                reg.status = obj.status;
                reg.created_at = obj.created_at;

                $mdDialog.show({
                        templateUrl: '/build/html/pages/orders/form.tmpl.html',
                        controller: DialogControllerorder,
                        targetEvent: ev,
                        locals: {
                            obj: reg,
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            order.update(data)
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
                        templateUrl: '/build/html/pages/orders/form.tmpl.html',
                        controller: DialogControllerorder,
                        targetEvent: ev,
                        locals: {
                            obj: {},
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            order.save(data)
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
                    order.delete({id: obj.id})
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

function DialogControllerorder($scope, $mdDialog, $q, user, obj) {
    $scope.order         = obj;
    $scope.selectedItem  = obj.deliveryMan;
    $scope.searchText    = null;

    $scope.setDeliveryMan = function(user){
        if (!user) {
            return;
        } else {
            $scope.order.user_deliveryman_id = user.id;
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