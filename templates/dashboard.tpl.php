<div ng-app="Dashboard">
  <div ng-view></div>

  <script type="text/ng-template" id="listView.html">
    <table class="dashboard-grid">
      <thead>
        <tr>
          <td>Name</td>
          <td>Alias</td>
          <td>Luggage Version</td>
          <td>Drupal Version</td>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="node in data.nodes" ng-click="goto(node.nid)">
          <td>{{ node.title }}</td>
          <td>{{ node.field_site_alias.und[0].value }}</td>
          <td>{{ node.field_site_status.und[0].value.luggage_version }}</td>
          <td>{{ node.field_site_status.und[0].value.drupal_version }}</td>
        </tr>
      </tbody>
    </table>
  </script>

  <script type="text/ng-template" id="detailView.html">
    <a href="#/">&#8592;</a>&nbsp;</a><h2>{{ node.title }}</h2>
  </script>

</div>