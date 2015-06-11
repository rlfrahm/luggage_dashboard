<div ng-app="Dashboard">
  <div ng-view></div>

  <script type="text/ng-template" id="listView.html">
    <div class="dashboard-grid-controls">
      <input type="text" placeholder="Search.." ng-model="search">
    </div>
    <table class="dashboard-grid">
      <thead>
        <tr>
          <td ng-click="sortby('title')" class="orderby">Name<span class="caret"></span></td>
          <td ng-click="sortby('field_site_alias.und[0].value')" class="orderby">Alias<span class="caret"></span></td>
          <td ng-click="sortby('field_site_status.und[0].value.luggage_version')" class="orderby">Luggage Version<span class="caret"></span></td>
          <td ng-click="sortby('field_site_status.und[0].value.drupal_version')" class="orderby">Drupal Version<span class="caret"></span></td>
          <td ng-click="sortby('field_site_head.und[0].value')" class="orderby">Head<span class="caret"></span></td>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="node in data.nodes | filter:search | orderBy:orderby" ng-click="goto(node.nid)" class="clickable">
          <td><a href>{{ node.title }}</a></td>
          <td><a href>{{ node.field_site_alias.und[0].value }}</a></td>
          <td><a href>{{ node.field_site_status.und[0].value.luggage_version }}</a></td>
          <td><a href>{{ node.field_site_status.und[0].value.drupal_version }}</a></td>
          <td><a href>{{ node.field_site_head.und[0].value }}</a></td>
        </tr>
      </tbody>
    </table>
  </script>

  <script type="text/ng-template" id="detailView.html">
    <a href="#/">&#8592;</a>&nbsp;</a><h2>{{ node.title }} <small>{{ node.field_site_alias.und[0].value }}</small></h2>
    <dl>
      <dt><label>Environments</label></dt>
      <dd>
        <table class="dashboard-grid">
          <thead>
            <tr>
              <td>Url</td>
              <td>Luggage Version</td>
              <td>Drupal Version</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ node.field_site_status.und[0].value.url }}</td>
              <td>{{ node.field_site_status.und[0].value.luggage_version }}</td>
              <td>{{ node.field_site_status.und[0].value.drupal_version }}</td>
            </tr>
          </tbody>
        </table>
      </dd>
    </dl>
  </script>

</div>