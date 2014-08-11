<?php

	echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new'
		)
	);

?>

<div class="sticky">
	<nav class="top-bar" data-topbar data-options="sticky_on: large">
	  <ul class="title-area">
	    <li class="name">
	      <h1><a href="#">My Site</a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right">
	      <li class="active"><a href="#">Right Button Active</a></li>
	      <li class="has-dropdown">
	        <a href="#">Right Button Dropdown</a>
	        <ul class="dropdown">
	          <li><a href="#">First link in dropdown</a></li>
	        </ul>
	      </li>
	    </ul>

	    <!-- Left Nav Section -->
	    <ul class="left">
	      <li><a href="#">Left Nav Button</a></li>
	    </ul>
	  </section>
	</nav>
</div>

<div class="row row-full-width">
  <div class="large-2 columns padding-left-0">
	  <div class = "menu-column">
	  	I'm coming home
	  </div>
  </div>
  <div class="large-10 columns">

	<ul class="small-block-grid-3">
	  <li>
	  	<!-- Missions Table --> 
	  	<table class="paginated">
		  <thead>
		    <tr>
		      <th><?= _('Missions') ?></th>
		      <th width="25"><i class="fa fa-plus fa-lg"></i></th>
		      <th width="25"><i class="fa fa-cog fa-lg"></i></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($missions_issues as $m): ?>
		  		<tr>
			      <td><?= $m['Mission']['title'] ?></td>
			      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
			      <td><i class="fa fa-times fa-lg"></i></td>
			      <!-- <td>Content Goes Here</td> -->
			    </tr>
			<?php endforeach; ?>	
		  </tbody>
		</table>
	  </li>
	  <li>
	  	<table class="paginated">
		  <thead>
		    <tr>
		      <th><?= _('Missions Issues') ?></th>
		      <th width="25"><i class="fa fa-plus fa-lg"></i></th>
		      <th width="25"><i class="fa fa-cog fa-lg"></i></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($issues as $i): ?>
		  		<tr>
			      <td><?= $i['Issue']['name'] ?></td>
			      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
			      <td><i class="fa fa-times fa-lg"></i></td>
			      <!-- <td>Content Goes Here</td> -->
			    </tr>
			<?php endforeach; ?>	
		  </tbody>
		</table>
	  </li>
	  <li>
	  	<table class="paginated">
		  <thead>
		    <tr>
		      <th><?= _('Missions') ?></th>
		      <th width="25"><i class="fa fa-plus fa-lg"></i></th>
		      <th width="25"><i class="fa fa-cog fa-lg"></i></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($missions_issues as $m): ?>
		  		<tr>
			      <td><?= $m['Mission']['title'] ?></td>
			      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
			      <td><i class="fa fa-times fa-lg"></i></td>
			      <!-- <td>Content Goes Here</td> -->
			    </tr>
			<?php endforeach; ?>	
		  </tbody>
		</table>
	  </li>
	</ul>

  </div>
</div>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');
?>

<script>

	$('table.paginated').each(function() {
	    var currentPage = 0;
	    var numPerPage = 10;
	    var $table = $(this);
	    $table.bind('repaginate', function() {
	        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
	    });
	    $table.trigger('repaginate');
	    var numRows = $table.find('tbody tr').length;
	    var numPages = Math.ceil(numRows / numPerPage);
	    var $pager = $('<div class="pager"></div>');
	    for (var page = 0; page < numPages; page++) {
	        $('<span class="page-number"></span>').text(page + 1).bind('click', {
	            newPage: page
	        }, function(event) {
	            currentPage = event.data['newPage'];
	            $table.trigger('repaginate');
	            $(this).addClass('active').siblings().removeClass('active');
	        }).appendTo($pager).addClass('clickable');
	    }
	    $pager.insertAfter($table).find('span.page-number:first').addClass('active');
	});

</script>