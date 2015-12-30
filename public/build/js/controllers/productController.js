'use strict';

angular.module('app')
    .controller('productController',
        [       '$rootScope', '$scope', '$location', '$cookies', '$mdDialog', 'OAuth', 'product',
        function($rootScope,   $scope,   $location,   $cookies,   $mdDialog,   OAuth,   product){

            $scope.totalProducts = 0;
            $scope.productsPerPage = 5;
            $scope.isDisabled = false;
            $scope.products = [];

            $scope.product = {
                name: '',
            };

            $scope.pagination = {
                current: 1
            };

            function getAll(pageNumber){
                if (!pageNumber){
                    pageNumber = $scope.pagination.current;
                };

                product.query({
                    orderBy: 'name',
                    sortedBy: 'asc',
                    page: pageNumber,
                    limit: $scope.productsPerPage,
            }, function(result){
                    $scope.products = result.data;
                    $scope.totalProducts = result.meta.pagination.total;
                });
            };

            $scope.pageChanged = function(newPage) {
                getAll(newPage);
            };

            $scope.update = function(obj, ev) {
                var reg         = new Object();
                reg.id          = obj.id;
                reg.name        = obj.name;
                reg.description = obj.description;
                reg.price       = obj.price;
                reg.category    = (typeof obj.category != 'undefined') ? obj.category.data : null;

                $mdDialog.show({
                        templateUrl: '/build/html/pages/products/form.tmpl.html',
                        controller: DialogController,
                        targetEvent: ev,
                        locals: {
                            obj: reg,
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            product.update(data)
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
                        templateUrl: '/build/html/pages/products/form.tmpl.html',
                        controller: DialogController,
                        targetEvent: ev,
                        locals: {
                            obj: {},
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            product.save(data)
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
                    product.delete({id: obj.id})
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

function DialogController($scope, $mdDialog, $q, category, obj) {
    $scope.product       = obj;
    $scope.selectedItem  = obj.category;
    $scope.searchText    = null;

    $scope.setCategory = function(category){
        if (!category) {
            return;
        } else {
            $scope.product.category_id = category.id;
        }
    };

    $scope.getCategories = function (name){
        var deffered = $q.defer();
        category.search({
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