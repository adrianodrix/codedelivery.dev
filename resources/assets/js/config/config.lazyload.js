// lazyload config
angular.module('app')
  .constant('MODULE_CONFIG', [
      {
          name: 'ui.select',
          module: true,
          files: [
              '../../build/libs/angular/angular-ui-select/dist/select.min.js',
              '../../build/libs/angular/angular-ui-select/dist/select.min.css'
          ]
      },
      {
          name: 'textAngular',
          module: true,
          files: [
              '../../build/libs/angular/textAngular/dist/textAngular-sanitize.min.js',
              '../../build/libs/angular/textAngular/dist/textAngular.min.js'
          ]
      },
      {
          name: 'vr.directives.slider',
          module: true,
          files: [
              '../../build/libs/angular/venturocket-angular-slider/build/angular-slider.min.js',
              '../../build/libs/angular/venturocket-angular-slider/angular-slider.css'
          ]
      },
      {
          name: 'angularBootstrapNavTree',
          module: true,
          files: [
              '../../build/libs/angular/angular-bootstrap-nav-tree/dist/abn_tree_directive.js',
              '../../build/libs/angular/angular-bootstrap-nav-tree/dist/abn_tree.css'
          ]
      },
      {
          name: 'angularFileUpload',
          module: true,
          files: [
              '../../build/libs/angular/angular-file-upload/angular-file-upload.js'
          ]
      },
      {
          name: 'ngImgCrop',
          module: true,
          files: [
              '../../build/libs/angular/ngImgCrop/compile/minified/ng-img-crop.js',
              '../../build/libs/angular/ngImgCrop/compile/minified/ng-img-crop.css'
          ]
      },
      {
          name: 'smart-table',
          module: true,
          files: [
              '../../build/libs/angular/angular-smart-table/dist/smart-table.min.js'
          ]
      },
      {
          name: 'ui.map',
          module: true,
          files: [
              '../../build/libs/angular/angular-ui-map/ui-map.js'
          ]
      },
      {
          name: 'ngGrid',
          module: true,
          files: [
              '../../build/libs/angular/ng-grid/build/ng-grid.min.js',
              '../../build/libs/angular/ng-grid/ng-grid.min.css',
              '../../build/libs/angular/ng-grid/ng-grid.bootstrap.css'
          ]
      },
      {
          name: 'ui.grid',
          module: true,
          files: [
              '../../build/libs/angular/angular-ui-grid/ui-grid.min.js',
              '../../build/libs/angular/angular-ui-grid/ui-grid.min.css',
              '../../build/libs/angular/angular-ui-grid/ui-grid.bootstrap.css'
          ]
      },
      {
          name: 'xeditable',
          module: true,
          files: [
              '../../build/libs/angular/angular-xeditable/dist/js/xeditable.min.js',
              '../../build/libs/angular/angular-xeditable/dist/css/xeditable.css'
          ]
      },
      {
          name: 'smart-table',
          module: true,
          files: [
              '../../build/libs/angular/angular-smart-table/dist/smart-table.min.js'
          ]
      },
      {
          name: 'dataTable',
          module: false,
          files: [
              '../../build/libs/jquery/datatables/media/js/jquery.dataTables.min.js',
              '../../build/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js',
              '../../build/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css'
          ]
      },
      {
          name: 'footable',
          module: false,
          files: [
              '../../build/libs/jquery/footable/dist/footable.all.min.js',
              '../../build/libs/jquery/footable/css/footable.core.css'
          ]
      },
      {
          name: 'easyPieChart',
          module: false,
          files: [
              '../../build/libs/jquery/jquery.easy-pie-chart/dist/jquery.easypiechart.fill.js'
          ]
      },
      {
          name: 'sparkline',
          module: false,
          files: [
              '../../build/libs/jquery/jquery.sparkline/dist/jquery.sparkline.retina.js'
          ]
      },
      {
          name: 'plot',
          module: false,
          files: [
              '../../build/libs/jquery/flot/jquery.flot.js',
              '../../build/libs/jquery/flot/jquery.flot.resize.js',
              '../../build/libs/jquery/flot/jquery.flot.pie.js',
              '../../build/libs/jquery/flot.tooltip/js/jquery.flot.tooltip.min.js',
              '../../build/libs/jquery/flot-spline/js/jquery.flot.spline.min.js',
              '../../build/libs/jquery/flot.orderbars/js/jquery.flot.orderBars.js'
          ]
      },
      {
          name: 'vectorMap',
          module: false,
          files: [
              '../../build/libs/jquery/bower-jvectormap/jquery-jvectormap-1.2.2.min.js',
              '../../build/libs/jquery/bower-jvectormap/jquery-jvectormap.css', 
              '../../build/libs/jquery/bower-jvectormap/jquery-jvectormap-world-mill-en.js',
              '../../build/libs/jquery/bower-jvectormap/jquery-jvectormap-us-aea-en.js'
          ]
      },
      {
          name: 'moment',
          module: false,
          files: [
              '../../build/libs/jquery/moment/moment.js'
          ]
      }
    ]
  )
  .config(['$ocLazyLoadProvider', 'MODULE_CONFIG', function($ocLazyLoadProvider, MODULE_CONFIG) {
      $ocLazyLoadProvider.config({
          debug: false,
          events: false,
          modules: MODULE_CONFIG
      });
  }]);
