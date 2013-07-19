var IP = angular.module('issuepress', [
  'header',
  'dashboard',
  'sections',
  'repo',
  'issue',
  'create-issue',
  'components.message',
  'components.breadcrumbs',
  'components.recentActivity',
  'components.ticketList',
  'components.issueThread',
]);


IP.config(function($routeProvider, $locationProvider) {
  $routeProvider
    .when('/dashboard', {
      templateUrl: IP_PATH + '/app/dashboard/dashboard.tpl.html',
    })
    .when('/sections', {
      templateUrl: IP_PATH + '/app/sections/sections.tpl.html',
    })
    .when('/:repo', {
      templateUrl: IP_PATH + '/app/repo/repo.tpl.html',
    })
    .when('/:repo/:issue', {
      templateUrl: IP_PATH + '/app/issue/issue.tpl.html',
    })
    .when('/:repo/issue/new', {
      templateUrl: IP_PATH + '/app/create-issue/create-issue.tpl.html',
    })
    .otherwise({
      redirectTo: "/dashboard"
    });

});

IP.run(function($rootScope, $templateCache) {
  $rootScope.$on('$viewContentLoaded', function() {
    $templateCache.removeAll();
  });
});