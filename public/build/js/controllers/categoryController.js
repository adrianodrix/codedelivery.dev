'use strict';

angular.module('app')
    .controller('categoryController',
        [       '$rootScope', '$scope', '$location', '$cookies', '$mdDialog', 'OAuth', 'category',
        function($rootScope,   $scope,   $location,   $cookies,   $mdDialog,   OAuth,   category){

            var ord = {
                orderBy: 'name',
                sortedBy: 'desc',
            };

            $scope.isDisabled = false;
            $scope.categories = [];
            $scope.category = {
                name: '',
            };

            function getAll(order){
                ord.orderBy = (typeof order == 'undefined') ? 'name' : order;
                ord.sortedBy = (ord.sortedBy == 'asc') ? 'desc': 'asc';
                category.query(ord, function(result){
                    $scope.categories = result.data;
                });
            };

            $scope.orderBy = function(order){
                getAll(order);
            }

            $scope.update = function(obj, ev) {
                var reg = new Object();
                reg.id = obj.id;
                reg.name = obj.name;

                $mdDialog.show({
                        templateUrl: '/build/html/pages/categories/form.tmpl.html',
                        controller: DialogControllerCategory,
                        targetEvent: ev,
                        locals: {
                            obj: reg,
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            category.update(data)
                                .$promise
                                .then(
                                    function () {
                                        getAll(ord.orderBy);
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
                        templateUrl: '/build/html/pages/categories/form.tmpl.html',
                        controller: DialogControllerCategory,
                        targetEvent: ev,
                        locals: {
                            obj: {},
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            var service = new category();
                            service.name = data.name;
                            service.$save()
                                .then(
                                    function (data) {
                                        getAll(ord.orderBy);
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
                    category.delete({id: obj.id})
                        .$promise
                        .then(function(){
                            getAll(ord.orderBy);
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
            getAll();
        }]);

function DialogControllerCategory($scope, $mdDialog, obj) {
    $scope.category = obj;

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