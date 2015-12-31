'use strict';

angular.module('app')
    .controller('couponController',
        [       '$rootScope', '$scope', '$location', '$cookies', '$mdDialog', 'OAuth', 'coupon',
        function($rootScope,   $scope,   $location,   $cookies,   $mdDialog,   OAuth,   coupon){

            $scope.totalcoupons = 0;
            $scope.couponsPerPage = 5;
            $scope.isDisabled = false;
            $scope.coupons = [];

            $scope.coupon = {
                name: '',
            };

            $scope.pagination = {
                current: 1
            };

            function getAll(pageNumber){
                if (!pageNumber){
                    pageNumber = $scope.pagination.current;
                };
                coupon.query({
                    page: pageNumber,
                    limit: $scope.couponsPerPage,
            }, function(result){
                    $scope.coupons = result.data;
                    $scope.totalcoupons = result.meta.pagination.total;
                });
            };

            $scope.pageChanged = function(newPage) {
                getAll(newPage);
            };

            $scope.update = function(obj, ev) {
                var reg = new Object();
                reg.id = obj.id;
                reg.code = obj.code;
                reg.value = obj.value;

                $mdDialog.show({
                        templateUrl: '/build/html/pages/coupons/form.tmpl.html',
                        controller: DialogControllercoupon,
                        targetEvent: ev,
                        locals: {
                            obj: reg,
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            coupon.update(data)
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
                        templateUrl: '/build/html/pages/coupons/form.tmpl.html',
                        controller: DialogControllercoupon,
                        targetEvent: ev,
                        locals: {
                            obj: {},
                        },
                    })
                    .then(function(data) {
                        if(typeof data != 'undefined'){
                            coupon.save(data)
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
                    coupon.delete({id: obj.id})
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

function DialogControllercoupon($scope, $mdDialog, $q, obj) {
    $scope.coupon         = obj;
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