angular.module('Dashboard', ['ngResource','ngRoute'])

.config(['$routeProvider', '$locationProvider',
  function($routeProvider,$locationProvider) {
    $locationProvider.hashPrefix('!');
    $routeProvider.
      when('/:siteId', {
        templateUrl: 'detailView.html',
        controller: 'DetailController'
      }).
      when('/', {
        templateUrl: 'listView.html',
        controller: 'ListController'
      }).
      otherwise({
        redirectTo: '/'
      });
  }
])

// Factory for the ngResource service.
.factory('Node', function($resource) {
  return $resource(Drupal.settings.basePath + 'api/node/:param', {}, {
    'search' : {method : 'GET', isArray : false},
    'query' : {method: 'GET', isArray: false}
  });
})

.run(['$rootScope','Node',function($rootScope,Node) {
  $rootScope.data = {};
  Node.query(function (res) {
    $rootScope.data.nodes = res.nodes;
    $rootScope.data.nodes.forEach(function(e) {
      if(!e.field_site_status['und']) return false;
      e.field_site_status['und'][0]['value'] = JSON.parse(e.field_site_status['und'][0]['value']);
    });
    console.log(res.nodes);
  });
}])

.controller('ListController', ['$scope', '$location', 'Node', function($scope, $location, Node) {
  // List of nodes

  // Callback for performing the search using a param from the textfield.
  $scope.doSearch = function() {
    $scope.nodes = Node.search({param: $scope.search});
  };

  $scope.sortby = function(o) {
    if($scope.orderby && $scope.orderby.charAt(0) == '-')
      $scope.orderby = o;
    else
      $scope.orderby = '-' + o;
  };

  // Callback to load the node info in the modal
  $scope.open = function(nid) {
    $scope.loadedNode = Node.get({param: nid});
  };

  $scope.goto = function(nid) {
    $location.path('/' + nid);
  };

}])

.controller('DetailController', ['$scope', '$routeParams', 'Node', function($scope, $routeParams, Node) {
  // List of nodes
  if(!$scope.data.nodes) {
    $scope.$watch('data.nodes', function(nodes) {
      if(nodes)
        assignNode(nodes);
    });
  } else {
    assignNode($scope.data.nodes);
  }

  function assignNode(nodes) {
    $scope.node = nodes.filter(function(e) {
      return (e.nid == $routeParams.siteId);
    })[0];
  }
  //Node.get({param: $routeParams.siteId},function(node) {
  //  console.log(node);
  //  $scope.node = node;
  //  SiteStatus($scope.node['field_site_dev_url']['und'][0]['value'] + '/files/status/status.json')
  //    .success(function(res) {
  //      console.log(res);
  //    });
  //},function(e) {
  //  console.log(e);
  //});
}])

.directive('lugListing',['Node',function(Node) {
  return {
    link: function(scope) {

    }
  };
}]);